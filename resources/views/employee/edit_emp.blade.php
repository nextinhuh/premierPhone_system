@extends('template')

@push('script')

<script>
    function previewImagem(){
        var imagem = document.querySelector('input[name=foto]').files[0];
        var preview = document.querySelector('img[name=foto]');
        
        var reader = new FileReader();
        
        reader.onloadend = function () {
            preview.src = reader.result;
        }
        
        if(imagem){
            reader.readAsDataURL(imagem);
        }else{
            preview.src = "";
        }
    }
  

</script>

<script>
    var todayDate = new Date().toISOString().slice(0,10);

    var pes = [
@foreach ($list as $tes)
    [ "{{ $tes['dt_admissao'] }}", "{{ $tes['dt_demissao'] }}"], 
@endforeach
];
pes.forEach(myFunction);


function myFunction(item, index, arr) {
    arr[index] = item;

 document.getElementById('date_a').value = item[0];  
 document.getElementById('date_d').value = item[1];  
}
</script>

<script type="text/javascript">
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

</script>

@endpush

@section('main')




@foreach($pes as $p)
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Editar funcionário</h4>
            <br>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif

                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Funcionário editado com sucesso!</div>
                @endif

                @if (session('save-status') == "fail_end" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado no endereço, favor verificar as informações
                    e tentar novamente.</div>
                @endif

                @if (session('save-status') == "fail_fun" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado nos dados do funcionário, favor verificar as
                    informações e tentar novamente.</div>
                @endif

                @if (session('save-status') == "fail_pes" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor recomeçe o procedimento.</div>
                @endif


            <form action="{{route('save_edit', ['id' => $p['id']])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="form-group row">

                        <div class="card" style="width: 10rem; height: 250px;">
                            <img name="foto" style="width: 150px; height: 150px;" src="{{ asset("storage/".$path) }}">
                            <div class="card-body">
                                <input type="file" id="file" name="foto" accept="image/*" class="inputfile"
                                    onchange="previewImagem()">
                                <label for="file" class="btn btn-primary">Enviar Foto</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Nome do
                                            funcionário</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe o nome do produto" class="form-control"
                                            placeholder="Nome do Funcionário" id="prod_name" name="nome_fun"
                                            value="{{$p['nome']}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">CPF</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe o valor de compra" class="form-control"
                                            placeholder="Valor Unitário" id="cpf" name="cpf" value="{{$p['cpf']}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Telefone</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe a quantidade comprada" class="form-control"
                                            placeholder="Quantidade" id="quantity" name="telefone"
                                            value="{{$p['telefone']}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Email</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe a marca do produto" class="form-control" placeholder="Marca"
                                            id="brand" name="email" value="{{$p['email']}}">
                                    </div>
                                </div>

                                
                                @endforeach
                                @foreach($list as $a)


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">RG</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe o valor de compra" class="form-control"
                                            placeholder="RG" id="rg" name="rg" value="{{$a['rg']}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Raça</label>
                                        <select class="custom-select mr-sm-2" id="category" name="raca">
                                            <option @if ($a['raca']=='' ) selected @endif>Escolha..</option>
                                            <option value="Branco" @if ($a['raca']=='Branco' ) selected @endif>Branco
                                            </option>
                                            <option value="Pardo" @if ($a['raca']=='Pardo' ) selected @endif>Pardo
                                            </option>
                                            <option value="Negro" @if ($a['raca']=='Negro' ) selected @endif>Negro
                                            </option>
                                            <option value="Indígena" @if ($a['raca']=='Indígena' ) selected @endif>
                                                Indígena</option>
                                            <option value="Amarelo" @if ($a['raca']=='Amarelo' ) selected @endif>Amarelo
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Data de
                                            admissão:</label>
                                        <input type="date" class="form-control" value="" data-toggle="tooltip"
                                            data-placement="top" title="Informe a data de compra do produto" id="date_a"
                                            name="dt_admissao">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Data de
                                            demissão:</label>
                                        <input type="date" class="form-control" value="" data-toggle="tooltip"
                                            data-placement="top" title="Informe a data de compra do produto" id="date_d"
                                            name="dt_demissao">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Função</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe a quantidade comprada" class="form-control"
                                            placeholder="Quantidade" id="quantity" value="{{$a['funcao']}}"
                                            name="funcao">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Nome do pai</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe a quantidade comprada" class="form-control"
                                            placeholder="Quantidade" id="quantity" value="{{$a['nome_pai']}}"
                                            name="nome_pai">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Nome da mãe</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe a marca do produto" class="form-control" placeholder="Marca"
                                            id="brand" value="{{$a['nome_mae']}}" name="nome_mae">
                                    </div>
                                </div>

                                @endforeach

                                <div class="col-md-12">

                                    <br>
                                    <h5 class="card-title">Endereço</h5>

                                </div>
                                @foreach($end as $e)


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">CEP</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe o CEP do endereço" class="form-control" placeholder="CEP"
                                            id="cep" name="cep" size="10" maxlength="9"
                                            onblur="pesquisacep(this.value);" value="{{$e['cep']}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Complemento</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe o complemento do endereço" class="form-control"
                                            placeholder="Complemento" id="complemento" name="complemento"
                                            value="{{$e['complemento']}}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Logradouro</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe o logradouro" class="form-control" placeholder="Logradouro"
                                            id="rua" name="rua" value="{{$e['logradouro']}}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Número</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe o número do endereço" class="form-control"
                                            placeholder="Número" id="rua" name="num_casa" value="{{$e['num_casa']}}">
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Bairro</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe bairro do endereço" class="form-control" placeholder="Bairro"
                                            id="bairro" name="bairro" value="{{$e['bairro']}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Cidade</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe a cidade do endereço" class="form-control"
                                            placeholder="Cidade" id="cidade" name="cidade" value="{{$e['cidade']}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">UF</label>
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                            title="Informe a UF do endereço" class="form-control" placeholder="UF"
                                            id="uf" name="uf" value="{{$e['uf']}}">
                                    </div>
                                </div>

                                @endforeach

                            </div>

                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Editar funcionário</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection