@extends('template')


@push('css')
<link href="{{asset('/assets/dist/css/css_custom/modal_prod.css')}}" rel="stylesheet">
@endpush

@push('script')

<script>
    const modal = document.querySelector("#modal")
const close = document.querySelector("#modal .header #teste")
const in1 = document.querySelector("#modal #row #prod_name")
const in4 = document.querySelector("#modal #row #price")
const in5 = document.querySelector("#modal #row #quantity")
const in6 = document.querySelector("#modal #row #brand")



function exibirValoresLinha(e){

var linha = e.parentNode.parentNode.children;
in1.value = linha[0].textContent;


in4.value = linha[3].textContent;
in5.value = linha[4].textContent;
in6.value = linha[5].textContent;

modal.classList.remove("hide");

}

close.addEventListener("click", () => {
    modal.classList.add("hide")
})
   
</script>

<script src="{{asset('/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

@endpush

@section('main')





<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <h4 class="card-title">Estoque de produtos</h4>
            </div>


            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                    <thead>
                        <tr>
                            <th scope="col">Fornecedor</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Data de entrada</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Valor de compra</th>
                            <th scope="col">Valor de venda</th>
                            <th scope="col">Gasto total</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($list as $p2 )


                        <tr>
                            <td>{{$p2['nome']}}</td>
                            <td>{{$p2['nome_prod']}}</td>
                            <td>{{$p2['dt_entrada']}}</td>
                            <td>{{$p2['qtd_prod']}}</td>
                            <td>R$ {{$p2['vlr_compra']}}</td>
                            <td>R$ {{$p2['vlr_unitario']}}</td>
                            <td>R$ {{$p2['total_compra']}} </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

   


    @endsection