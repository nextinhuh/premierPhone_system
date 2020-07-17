@extends('template')

@push('script')
<script src="{{asset('/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>


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
    function confirmacao(id) {
     var resposta = confirm("Deseja remover esse registro?");
     if (resposta == true) {
          window.location.href = "remover.php?id="+id;
     }
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registrar novo funcionário</h4>
                <br>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif

                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Funcionário cadastrado com sucesso!</div>
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
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, já existe um funcionário com esse CPF,
                    favor verificar as informações e tentar novamente.</div>
                @endif
                @if (session('del-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Funcionário deletado com sucesso!</div>
                @endif
                @if (session('del-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor tentar novamente.</div>
                @endif
                <form action="{{route('register_employee')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">
                            <div class="card" style="width: 10rem; height: 250px;">
                            <img name="foto" style="width: 150px; height: 150px;" >
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
                                                placeholder="Nome do Funcionário" id="prod_name" name="nome_fun">
                                        </div>
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">CPF</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o valor de compra" class="form-control"
                                                placeholder="Valor Unitário" id="cpf" name="cpf">
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Telefone</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a quantidade comprada" class="form-control"
                                                placeholder="Quantidade" id="quantity" name="telefone">
                                        </div>
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Email</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a marca do produto" class="form-control"
                                                placeholder="Marca" id="brand" name="email">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">RG</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o valor de compra" class="form-control"
                                                placeholder="Valor Unitário" id="rg" name="rg">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Raça</label>
                                        <select class="custom-select mr-sm-2" id="category" name="raca">
                                            <option >Escolha..</option>
                                            <option value="Branco" >Branco
                                            </option>
                                            <option value="Pardo">Pardo
                                            </option>
                                            <option value="Negro">Negro
                                            </option>
                                            <option value="Indígena" >
                                                Indígena</option>
                                            <option value="Amarelo" >Amarelo
                                            </option>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Data de
                                                admissão:</label>
                                            <input type="date" class="form-control" data-toggle="tooltip"
                                                data-placement="top" title="Informe a data de compra do produto"
                                                id="date" name="dt_admissao">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Função</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a quantidade comprada" class="form-control"
                                                placeholder="Quantidade" id="quantity" name="funcao">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Nome do pai</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a quantidade comprada" class="form-control"
                                                placeholder="Quantidade" id="quantity" name="nome_pai">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Nome da mãe</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a marca do produto" class="form-control"
                                                placeholder="Marca" id="brand" name="nome_mae">
                                        </div>
                                    </div>

                                    <div class="col-md-12">

                                        <br>
                                        <h5 class="card-title">Endereço</h5>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">CEP</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o CEP do endereço" class="form-control" placeholder="CEP"
                                                id="cep" name="cep" size="10" maxlength="9"
                                                onblur="pesquisacep(this.value);">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Complemento</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o complemento do endereço" class="form-control"
                                                placeholder="Complemento" id="complemento" name="complemento">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Logradouro</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o logradouro" class="form-control"
                                                placeholder="Logradouro" id="rua" name="rua">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Número</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o número do endereço" class="form-control"
                                                placeholder="Número" id="rua" name="num_casa">
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Bairro</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe bairro do endereço" class="form-control"
                                                placeholder="Bairro" id="bairro" name="bairro">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Cidade</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a cidade do endereço" class="form-control"
                                                placeholder="Cidade" id="cidade" name="cidade">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">UF</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a UF do endereço" class="form-control" placeholder="UF"
                                                id="uf" name="uf">
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Cadastrar funcionário</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>



<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Funcionários cadastrados</h4>
            <br>

            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Função</th>
                            <th scope="col">Contato</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($list as $emp2 )
                        <tr>
                            <td>{{$emp2['nome']}}</td>
                            <td>{{$emp2['cpf']}}</td>
                            <td>{{$emp2['funcao']}}</td>
                            <td>{{$emp2['telefone']}}</td>
                            <td>
                        <form  method="get" action="{{route('del_employee', ['id' => $emp2['id'] ])}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                
                                <button type="button" class="btn btn-primary btn-circle" title="Editar Funcionário"
                                onclick="location.href='{{route('edit_employee', ['id' => $emp2['id'] ])}}';"><i class="fa fa-list"></i>
                                </button>
                                
                                <button type="submit" class="btn btn-danger btn-circle" title="Excluir Funcionário">
                                    <i class="fas fa-trash-alt"></i></button>
                                </form>

                            </td>
                        </tr>
                    
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>

@endsection