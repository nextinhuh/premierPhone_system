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
                <h4 class="card-title">Fornecedores cadastrados</h4>
                <br>
                @if (session('del-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Fornecedor deletado com sucesso!</div>
                @endif
                @if (session('del-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor tentar novamente.</div>
                @endif
                @if (session('del-status') == "exist" )
                <div class="alert alert-danger"><b>Ops!</b> O fornecedor que está tentando deletar está fornecendo produtos no estque,
                favor verificar e tentar novamente!</div>
                @endif
                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Fornecedor editado com sucesso!</div>
                @endif

                @if (session('save-status') == "fail_end" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado no endereço, favor verificar as informações
                    e tentar novamente.</div>
                @endif

                @if (session('save-status') == "fail_fun" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado nos dados do Fornecedor, favor verificar as
                    informações e tentar novamente.</div>
                @endif

                @if (session('save-status') == "fail_pes" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor recomeçe o procedimento.</div>
                @endif
            </div>

            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">CNPJ</th>
                            <th scope="col">Contato</th>
                            <th scope="col">Email</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>


                        

                        @foreach ($list as $emp2 )
                        <tr>
                            <td>{{$emp2['nome']}}</td>
                            <td>{{$emp2['cnpj']}}</td>
                            <td>{{$emp2['telefone']}}</td>
                            <td>{{$emp2['email']}}</td>
                            <td>
                                <form method="get" action="{{route('supplier_del', ['id' => $emp2['id'] ])}}"
                                    onsubmit="return confirm('Tem certeza que deseja excluir?')">

                                    <button type="button" class="btn btn-primary btn-circle"
                                        onclick="location.href='{{route('supplier_edit', ['id' => $emp2['id']])}}';" data-toggle="tooltip"
                                        data-placement="top" title="Editar Fornecedor"><i class="fa fa-list"></i>
                                    </button>

                                    <button type="submit" class="btn btn-danger btn-circle" title="Excluir Cliente">
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



    @endsection