@extends('template')

@push('css')
<link href="{{asset('/assets/dist/css/css_custom/modal_category.css')}}" rel="stylesheet">
@endpush

@push('script')

<script>

const modal = document.querySelector("#modal")
const close = document.querySelector("#modal .header #teste")
const in1 = document.querySelector("#modal #row #cat_name")
const in2 = document.querySelector("#modal #row #cat_id")

function exibirValoresLinha(e){

var linha = e.parentNode.parentNode.children;
in2.value = linha[0].textContent;
in1.value = linha[1].textContent;

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


<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Cadastrar nova categoria</h4>
                <br>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif
                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Categoria cadastrada com sucesso!</div>
                @endif
                @if (session('edit-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Categoria editada com sucesso!</div>
                @endif

                @if (session('save-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor verificar as informações
                    e tentar novamente.</div>
                @endif
                @if (session('save-status') == "exist" )
                <div class="alert alert-danger"><b>Ops!</b> A categoria informada já existe, favor verificar as informações
                    e tentar novamente.</div>
                @endif
                @if (session('del-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Categoria deletada com sucesso!</div>
                @endif
                @if (session('del-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor tentar novamente.</div>
                @endif
                <form action="{{route('save_category')}}" method="POST" >
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">

                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Nome da Categoria</label>
                                            <input type="text" 
                                        class="form-control" placeholder="Nome da categoria" id="prod_name" name="nome">
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Cadastrar Categoria</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-6">
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <h4 class="card-title">Categorias Cadastrados</h4>
        </div>

        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($list as $emp2 )

                        
                        <tr>
                            <td>{{$emp2['id']}}</td>
                            <td>{{$emp2['nome_categoria']}}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-circle"  onclick="exibirValoresLinha(this);"  ><i class="fa fa-list" ></i>
                                </button>
                                <form method="get" action="{{route('del_category', ['id' => $emp2['id'] ])}}"
                                    onsubmit="return confirm('Tem certeza que deseja excluir?')">
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
</div>

<div id="modal" class="hide">
    <div class="content">
        <div class="header">
            <h4>Editar Categoria:</h4>
            <button type="button" class="btn btn-outline-secondary" id="teste"><i
                class="fas fa-window-close"></i> Fechar</button>
            </button>
        </div>
        <form action="{{route('edit_category')}}" method="POST" >
            @csrf
            <div class="form-body">
                <div class="form-group row">
                    <div class="col-md-10">
                        <div class="row" id="row">
                            
                            
                                    <input type="text" id="cat_id" hidden name="cat_id" >
                                

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Nome da categoria</label>
                                    <input type="text"  placeholder="Nome do Produto" id="cat_name" name="cat_name">
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
</div>



@endsection