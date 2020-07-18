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



@endpush

@section('main')

@foreach($list as $p)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Editar cliente</h4>
                <br>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif

                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Cliente editado com sucesso!</div>
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
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor recomeçe o procedimento.</div>
                @endif
                <form action="{{route('save_edit_cos', ['id' => $p['id']])}}" method="POST" enctype="multipart/form-data">
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
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Nome do cliente</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o nome do cliente" class="form-control"
                                                placeholder="Nome do Produto" id="nome_cli" name="nome_cli" value="{{$p['nome']}}">
                                        </div>
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Email</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o valor de compra" class="form-control"
                                                placeholder="Valor Unitário" id="price" name="email" value="{{$p['email']}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Telefone</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a quantidade comprada" class="form-control"
                                                placeholder="Quantidade" id="quantity" name="telefone" value="{{$p['telefone']}}">
                                        </div>
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">CPF</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a marca do produto" class="form-control"
                                                placeholder="Marca" id="brand" name="cpf" value="{{$p['cpf']}}">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">RG</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a marca do produto" class="form-control"
                                                placeholder="Marca" id="brand" name="rg" value="{{$p['rg']}}">
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
                                                onblur="pesquisacep(this.value);" value="{{$p['cep']}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Complemento</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o complemento do endereço" class="form-control"
                                                placeholder="Complemento" id="complemento" name="complemento" value="{{$p['complemento']}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Logradouro</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o logradouro" class="form-control"
                                                placeholder="Logradouro" id="rua" name="rua" value="{{$p['logradouro']}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Número</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o número do endereço" class="form-control"
                                                placeholder="Número" id="rua" name="num_casa" value="{{$p['num_casa']}}">
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Bairro</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe bairro do endereço" class="form-control"
                                                placeholder="Bairro" id="bairro" name="bairro" value="{{$p['bairro']}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Cidade</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a cidade do endereço" class="form-control"
                                                placeholder="Cidade" id="cidade" name="cidade" value="{{$p['cidade']}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">UF</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a UF do endereço" class="form-control" placeholder="UF"
                                                id="uf" name="uf" value="{{$p['uf']}}">
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Editar Cliente</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection