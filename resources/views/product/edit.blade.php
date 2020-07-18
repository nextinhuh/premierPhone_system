@extends('template')


@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<script>
    $(document).ready(function()
{
     $("#money").maskMoney({
         prefix: "R$ ",
         decimal: ",",
         thousands: "."
     });
});
</script>

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


@foreach($list as $l)

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Editar produto</h4>
                <br>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif
                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Produto editado com sucesso!</div>
                @endif

                @if (session('save-status') == "fail_for" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado nos dados do Produto, verificar as
                    informações e tentar novamente.</div>
                @endif

                @if (session('save-status') == "exist" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, já existe um produto com esse nome,
                    favor verificar as informações e tentar novamente.</div>
                @endif
                

                <form action="{{route('save_product_edit', ['id' => $l['id']])}}" method="POST" enctype="multipart/form-data">
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
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Nome do produto</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o nome do produto" class="form-control"
                                                placeholder="Nome do Produto" id="prod_name" name="nome_prod"
                                                value="{{$l['nome']}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Marca do produto</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o nome do produto" class="form-control"
                                                placeholder="Nome do Produto" id="prod_marca" name="marca"
                                                value="{{$l['marca']}}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Valor de venda</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a quantidade comprada" class="form-control"
                                                placeholder="Quantidade" id="money" name="valor_venda"
                                                value="R$ {{$l['vlr_unitario']}}">
                                        </div>
                                    </div>
                                    @endforeach


                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Categoria</label>
                                            <select class="custom-select mr-sm-2" id="category" name="category">
                                                <option selected>Escolha..</option>
                                                @foreach ($cat as $emp2 )
                                                <option value="{{$emp2['id']}}"
                                                    @if($emp2['id']==$list[0]['id_categoria']) selected @endif>
                                                    {{$emp2['nome_categoria']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Editar Produto</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


























    @endsection