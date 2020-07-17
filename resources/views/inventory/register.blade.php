@extends('template')

@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>


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
    $(document).ready(function()
{
     $("#money").maskMoney({
         prefix: "R$ ",
         decimal: ",",
         thousands: "."
     });
});
</script>

@endpush

@section('main')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registrar nova entrada no estoque</h4>
                <br>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif
                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Nova entrada cadastrado com sucesso!</div>
                @endif

                @if (session('save-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado nos dados, verificar as
                    informações e tentar novamente.</div>
                @endif

                @if (session('save-status') == "exist" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado com o produto, verificar as
                    informações e tentar novamente.</div>
                @endif


                <form action="{{route('save_inventory')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">

                            <div class="col-md-10">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Produto</label>
                                            <select class="custom-select mr-sm-2" id="category" name="id_prod">
                                                <option selected value="">Escolha..</option>
                                                @foreach ($prod as $p2 )
                                                <option value="{{$p2['id']}}">{{$p2['nome']}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Fornecedor</label>
                                            <select class="custom-select mr-sm-2" id="category" name="fornecedor">
                                                <option selected value="">Escolha..</option>
                                                @foreach ($pes as $p2 )
                                                <option value="{{$p2['id']}}">{{$p2['nome']}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Valor de custo</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a quantidade comprada" class="form-control"
                                                placeholder="Valor de custo" id="money" name="valor_custo">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Quantidade</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a quantidade comprada" class="form-control"
                                                placeholder="Quantidade" id="quantity" name="quantidade">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Data de entrada:</label>
                                            <input type="date" class="form-control" value="" data-toggle="tooltip"
                                                data-placement="top" title="Informe a data de compra do produto"
                                                id="date" name="dt_entrada">
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Registrar Entrada</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection