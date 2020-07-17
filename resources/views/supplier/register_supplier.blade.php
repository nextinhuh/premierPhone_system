@extends('template')

@push('script')

<script>
    function previewImagem(){
        var imagem = document.querySelector('input[name=file]').files[0];
        var preview = document.querySelector('img[name=prod_img]');
        
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
                <h4 class="card-title">Registrar novo fornecedor</h4>
                <br>
                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Fornecedor cadastrado com sucesso!</div>
                @endif

                @if (session('save-status') == "fail_end" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado no endereço, favor verificar as informações
                    e tentar novamente.</div>
                @endif

                @if (session('save-status') == "fail_fun" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado nos dados do cliente, favor verificar as
                    informações e tentar novamente.</div>
                @endif

                @if (session('save-status') == "fail_pes" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, já existe um cliente com esse CNPJ,
                    favor verificar as informações e tentar novamente.</div>
                @endif
                <form action="{{route('save_supplier')}}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">

                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Nome do
                                                fornecedor</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o nome do fornecedor" class="form-control"
                                                placeholder="Nome do Fornecedor" id="prod_name" name="nome_for">
                                        </div>
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Email</label>
                                            <input type="text" class="form-control" placeholder="Email" id="price"
                                                name="email">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Telefone</label>
                                            <input type="text" class="form-control" placeholder="Telefone"
                                                id="quantity" name="telefone">
                                        </div>
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">CNPJ</label>
                                            <input type="text"  class="form-control"
                                                placeholder="CNPJ" id="brand" name="cnpj">
                                        </div>
                                    </div>

                                    <div class="col-md-6"></div>

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
                            <button type="submit" class="btn btn-info">Cadastrar fornecedor</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection