@extends('template')


@push('css')
<link href="{{asset('/assets/dist/css/css_custom/modal_prod.css')}}" rel="stylesheet">
@endpush

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
    const modal = document.querySelector("#modal")
const close = document.querySelector("#modal .header #teste")
const in1 = document.querySelector("#modal #row #prod_name")
const in2 = document.querySelector("#modal #row #prod_marca")
const in5 = document.querySelector("#modal #row #money")
const in3 = document.getElementById("category")
const in4 = document.getElementById("indent")



function exibirValoresLinha(e){

var linha = e.parentNode.parentNode.children;
in1.value = linha[1].textContent;
in2.value = linha[3].textContent;
in3.value = linha[2].textContent;
in4.value = linha[0].textContent;
in5.value = linha[5].textContent;

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
                <h4 class="card-title">Produtos Cadastrados</h4>
                <br>
                @if (session('edit-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Produto editado com sucesso!</div>
                @endif
                @if (session('edit-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado na edição do produto, favor tentar
                    novamente.</div>
                @endif
            </div>


            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Valor de venda</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>




                        @foreach ($list as $p2 )


                        <tr>
                            <td>{{$p2['id']}}</td>
                            <td>{{$p2['nome']}}</td>
                            <td>{{$p2['nome_categoria']}}</td>
                            <td>{{$p2['marca']}}</td>
                            <td>@if ($p2['soma'] == null) 0 @else {{$p2['soma']}} @endif</td>
                            <td>R$ {{$p2['vlr_unitario']}}</td>

                            <td>
                                <button type="button" class="btn btn-primary btn-circle"
                                    onclick="location.href='{{route('product_edit', ['id' => $p2['id'] ])}}';"
                                    data-toggle="tooltip" data-placement="top" title="Editar Produto"><i
                                        class="fa fa-list"></i>
                                </button>

                            </td>
                        </tr>

                        @endforeach





                    </tbody>
                </table>
            </div>
        </div>
    </div>




    @endsection