@extends('template')

@push('css')
<link href="{{asset('/assets/dist/css/css_custom/modal_fun.css')}}" rel="stylesheet">
<link href="{{asset('/assets/dist/css/css_custom/modal_cos.css')}}" rel="stylesheet">
@endpush

@push('script')

<script src="{{asset('/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>


<script>
    var todayDate = new Date().toISOString().slice(0,10);
    document.getElementById('date').value = todayDate; 
    
    var prod = [
@foreach ($list as $tes)
        [ "{{ $tes['soma'] }}", "{{ $tes['vlr_unitario'] }}", "{{$tes['id']}}", "{{$tes['nome']}}", "{{$tes['img_prod']}}"], 
    @endforeach
    ];

    var linkUrl = '{{ URL::asset('/storage/prod/') }}';
</script>

<script src="{{asset('/assets/dist/js/js-custom/register-sale.js')}}">

</script>


@endpush

@section('main')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registrar venda</h4>
                <br>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif

                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Venda registrada com sucesso!</div>
                @endif

                @if (session('save-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor verificar as informações
                    e tentar novamente.</div>
                @endif

                <form action="{{route('save_sale')}}" method="POST" id="form_venda">
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">

                            <div class="card" style="width: 151px; height: 151px;">
                                <img name="prod_img" id="prod_img" style="width: 150px; height: 150px;" >
                            </div>

                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <input type="text" hidden name="id_cli" id="cos_id">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Nome do cliente</label>
                                            <input type="text" class="form-control" id="cos_name" name="nome_cli">
                                        </div>

                                    </div>

                                    <div class="col-md-1">
                                        <br>
                                        <button type="button" class="btn btn-primary btn-circle" data-toggle="tooltip"
                                            data-placement="top" title="Pesquisar Cliente" onclick="abre2();">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <input type="text" hidden name="id_fun" id="tec_id">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Nome do
                                                funcionário</label>
                                            <input type="text" class="form-control" id="tec_name" name="nome_fun">
                                        </div>

                                    </div>

                                    <div class="col-md-1">
                                        <br>
                                        <button type="button" class="btn btn-primary btn-circle" data-toggle="tooltip"
                                            data-placement="top" title="Pesquisar Funcionário" onclick="abre();">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Data</label>
                                            <input type="date" class="form-control" value="" data-toggle="tooltip"
                                                data-placement="top" title="Informe a data da venda" id="date"
                                                name="dt_venda">
                                        </div>

                                    </div>

                                    <div class="col-md-10">
                                        <br>
                                        <h5 class="card-title">Produtos <h5>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Produto</label>
                                            <select class="custom-select mr-sm-2" id="produto" onchange="selectProd();">
                                                <option selected value="0">Escolha..</option>
                                                @foreach($list as $l)
                                                <option value="{{$l['nome']}}">{{$l['nome']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Preço unitário</label>
                                            <input type="text" class="form-control" id="vlr_unitario" disabled>
                                        </div>

                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Em estoque</label>
                                            <input type="text" class="form-control" id="qtd_estoque" disabled>
                                        </div>

                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Desconto(%)</label>
                                            <input type="number" class="form-control" id="desconto">
                                        </div>

                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Quantidade</label>
                                            <input type="text" class="form-control" id="quantidade">
                                        </div>

                                    </div>

                                    <div class="col-md-1">
                                        <br>
                                        <button type="button" class="btn btn-success btn-circle" data-toggle="tooltip"
                                            data-placement="top" title="Adicionar produto" id="btn_Adc">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Produto</th>
                                                        <th scope="col">Preço Unitário</th>
                                                        <th scope="col">Quantidade</th>
                                                        <th scope="col">Desconto(%)</th>
                                                        <th scope="col">Preço Final</th>
                                                        <th scope="col">Remover</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="5" style="text-align:right">Valor Total:</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="text-right">
                            <button type="submit" class="btn btn-info" id="sub_btn">Registrar venda</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_fun" class="hide">
    <div class="content">
        <div class="header">
            <h4>Buscar funcionário:</h4>
            <button type="button" class="btn btn-outline-secondary" id="close_fun"><i class="fas fa-window-close"></i>
                Fechar</button>
            </button>
        </div>
        <form action="/search">
            <div class="form-body">

                <table id="zero_config1" class="table table-striped table-bordered no-wrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Função</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list_fun as $k)

                        <tr>
                            <td>{{$k['id_fun']}}</td>
                            <td>{{$k['nome']}} <button type="button" class="btn btn-success btn-circle"
                                    onclick="exibirValoresLinha(this);"><i class="fa fa-check"></i>
                                </button></td>
                            <td>{{$k['funcao']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<div id="modal_cos" class="hide">
    <div class="content">
        <div class="header">
            <h4>Buscar clientes:</h4>
            <button type="button" class="btn btn-outline-secondary" id="close_cos"><i class="fas fa-window-close"></i>
                Fechar</button>
            </button>
        </div>
        <form action="/search">
            <div class="form-body">

                <table id="zero_config2" class="table table-striped table-bordered no-wrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list_cli as $k)
                        <tr>
                            <td>{{$k['id_cli']}}</td>
                            <td>{{$k['nome']}} <button type="button" class="btn btn-success btn-circle"
                                    onclick="exibirValoresLinha2(this);"><i class="fa fa-check"></i>
                                </button></td>
                            <td>{{$k['cpf']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </form>
    </div>
</div>

@endsection