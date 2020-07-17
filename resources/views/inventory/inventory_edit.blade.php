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

@endpush

@section('main')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registrar nova entrada</h4>
                <br>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif
                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Produto cadastrado com sucesso!</div>
                @endif

                @if (session('save-status') == "fail_for" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado nos dados do Produto, verificar as
                    informações e tentar novamente.</div>
                @endif

                @if (session('save-status') == "exist" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, já existe um produto com esse nome,
                    favor verificar as informações e tentar novamente.</div>
                @endif
                @if (session('del-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Produto deletado, com sucesso!</div>
                @endif
                @if (session('del-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor tentar novamente.</div>
                @endif

                <form action="{{route('save_product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        
                        
                        <div class="form-group row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Nome do produto</label>
                                    <input type="text" data-toggle="tooltip" data-placement="top"
                                        title="Informe a quantidade comprada" class="form-control"
                                placeholder="Quantidade" id="quantity" name="quantidade" disabled value="{{$p1['nome_prod']}}">
                                </div>
                                
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Preço</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o valor de compra" class="form-control"
                                                placeholder="Valor Unitário" id="money" name="preco" value="{{$p1['vlr_unitario']}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Quantidade</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a quantidade comprada" class="form-control"
                                                placeholder="Quantidade" id="quantity" name="quantidade" value="{{$p1['qtd_prod']}}">
                                        </div>
                                        
                                    </div>
                                    @foreach ($list as $p1 )
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Fornecedor 1</label>
                                            <select class="custom-select mr-sm-2" id="category" name="fornecedor1">
                                                <option selected value="">Escolha..</option>
                                                @foreach ($pes as $p2 )
                                                <option value="{{$p2['id']}}"@if ($p2['nome'] == $p1['nome']) selected  @endif>{{$p2['nome']}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Data de entrada:</label>
                                            <input type="date" class="form-control" value="" data-toggle="tooltip"
                                                data-placement="top" title="Informe a data de compra do produto"
                                                id="date" name="dt_entrada" value="{{$p1['dt_entrada']}}">
                                        </div>
                                    </div>


                                    

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Fornecedor 2</label>
                                            <select class="custom-select mr-sm-2" id="category" name="fornecedor2">
                                                <option selected value="">Escolha..</option>
                                                @foreach ($pes as $p2 )
                                                <option value="{{$p2['id']}}"@if ($p2['nome'] == $p1['nome']) selected  @endif>{{$p2['nome']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Data de entrada:</label>
                                            <input type="date" class="form-control" value="" data-toggle="tooltip"
                                                data-placement="top" title="Informe a data de compra do produto"
                                                id="date" name="dt_entrada" value="{{$p1['dt_entrada']}}">
                                        </div>
                                    </div>
                                    

                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="form-actions">
                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Salvar Produto</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection