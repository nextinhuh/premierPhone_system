@extends('template')


@push('css')
<link href="{{asset('/assets/dist/css/css_custom/modal_os.css')}}" rel="stylesheet">
@endpush

@push('script')

<script>
    const modal = document.querySelector("#modal")
const close = document.querySelector("#modal .header #teste")
const status = document.querySelector("#modal #row #status")
const id = document.querySelector("#modal #row #id_ordem")

function exibirValoresLinha(e){

var linha = e.parentNode.parentNode.children;
status.value = linha[5].textContent;
id.value = linha[0].textContent;

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
                <h4 class="card-title">Ordens Geradas:</h4>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif

                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Ordem de serviço foi registrada com sucesso!</div>
                @endif
                @if (session('edit-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Ordem de serviço foi editada com sucesso!</div>
                @endif
                @if (session('del-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Ordem de serviço foi excluída com sucesso!</div>
                @endif

                @if (session('save-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor verificar as informações
                    e tentar novamente.</div>
                @endif
                @if (session('edit-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor verificar as informações
                    e tentar novamente.</div>
                @endif
                @if (session('del-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor verificar as informações
                    e tentar novamente.</div>
                @endif
            </div>


            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                    <thead>
                        <tr>
                            <th scope="col">Número da OS</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Data de Entrada</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Status</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach($list as $l)
                        <tr>

                            <td>{{$l['id']}}</td>
                            <td>{{$l['nome']}}</td>
                            <td>{{$l['dt_realizada']}}</td>
                            <td>{{$l['marca']}}</td>
                            <td>{{$l['modelo']}}</td>
                            <td>{{$l['status']}}</td>
                            <td><a href="{{route('order_pdf', ['id' => $l['id']])}}" target="__blank"><button
                                        type="button" class="btn btn-success btn-circle" formatarget="_blank"
                                        title="Visualizar Ordem"><i class="fas fa-eye"></i>
                                    </button></a>
                                <button type="button" class="btn btn-primary btn-circle"
                                    onclick="exibirValoresLinha(this);" title="Editar Ordem"><i class="fa fa-list"></i>
                                </button>
                                <form method="get" action="{{route('order_del', ['id' => $l['id'] ])}}"
                                    onsubmit="return confirm('Tem certeza que deseja excluir?')" >
                                    <button type="submit" class="btn btn-danger btn-circle" title="Excluir Produto">
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

    <div id="modal" class="hide">
        <div class="content">
            <div class="header">
                <h4>Editar Ordem:</h4>
                <button type="button" class="btn btn-outline-secondary" id="teste"><i class="fas fa-window-close"></i>
                    Fechar</button>
                </button>
            </div>
            <form action="{{route('order_edit')}}" method="POST">
                @csrf
                <div class="form-body">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <div class="row" id="row">

                                <input type="text" hidden id="id_ordem" name="id_ordem">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Status</label>
                                        <select class="custom-select mr-sm-2" id="status" name="status">
                                            <option selected>Escolha..</option>
                                            <option value="Em Aberto">Em Aberto</option>
                                            <option value="Concluído">Concluído</option>
                                            <option value="Aguardando peças">Aguardando peças</option>
                                            <option value="Bloqueado">Bloqueado</option>
                                        </select>
                                    </div>
                                </div>



                            </div>

                            <div class="form-actions">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-info">Salvar Edição</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>




    @endsection