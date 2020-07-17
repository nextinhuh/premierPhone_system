@extends('template')

@push('script')
<script src="{{asset('/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
@endpush

@section('main')

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <h4 class="card-title">Vendas Realizadas</h4>
        </div>


        <div class="table-responsive">
            <table id="zero_config3" class="table table-striped table-bordered no-wrap" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Total da compra</th>
                        <th scope="col">Comprovante</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($list as $l)
                    <tr>
                        <td>{{$l['dt_venda']}}</td>
                        <td>{{$l['nome']}}</td>
                        <td>R$ {{$l['valor_venda']}}</td>
                        <td><a href="{{route('order_pdf', ['id' => $l['id']])}}" target="__blank"><button
                            type="button" class="btn btn-success btn-circle" formatarget="_blank"
                            title="Visualizar Ordem"><i class="fas fa-eye"></i>
                        </button></a>
                    
                </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection