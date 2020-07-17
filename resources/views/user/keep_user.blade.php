@extends('template')

@push('script')
<script src="{{asset('/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>


<script>
    var URL ='{{ URL::asset('/api/pes/') }}';
    const tpUserRegister = document.querySelector('.row .form-body #tp_usuario_register');
    const tpUserEdit = document.querySelector('.row .form-body #tp_usuario_register2');
    const nomeUserRegister = document.querySelector('.row .form-body #nome_usuario');
    const nomeUserEdit = document.querySelector('.col-6 .form-body #nome_usuario2');

    function buscarPes(id) {
           
        req = URL + '/search/'+id;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", req, false);
        xhttp.send();//A execução do script pára aqui até a requisição retornar do servidor
        var myObject = JSON.parse(xhttp.responseText);
        adcSelect(myObject);
        return myObject;
}
    function buscarPes2(id) {
           
        req = URL + '/search/'+id;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", req, false);
        xhttp.send();//A execução do script pára aqui até a requisição retornar do servidor
        var myObject = JSON.parse(xhttp.responseText);
        adcSelect2(myObject);
        return myObject;
}

tpUserRegister.addEventListener('change', (event) => {
    if(event.target.value == "Funcionário"){
        buscarPes("Funcionário");
    }else if(event.target.value == "Cliente"){
        buscarPes("Cliente");
    }else{

    }
});
tpUserEdit.addEventListener('change', (event) => {
    if(event.target.value == "Funcionário"){
        buscarPes2("Funcionário");
    }else if(event.target.value == "Cliente"){
        buscarPes2("Cliente");
    }else{

    }
});
    
function adcSelect(obj){
    nomeUserRegister.options.length = 0;
    obj.forEach((nome) => {
        option = new Option(nome['nome'], nome['id']);
        nomeUserRegister.options[nomeUserRegister.options.length] = option;
});
}
function adcSelect2(obj){
    nomeUserEdit.options.length = 0;
    obj.forEach((nome) => {
        option = new Option(nome['nome'], nome['id']);
        nomeUserEdit.options[nomeUserEdit.options.length] = option;
});
}

function adcNome (list) {

req = URL + '/list/equip/'+id;
var xhttp = new XMLHttpRequest();
xhttp.open("GET", req, false);
xhttp.send();//A execução do script pára aqui até a requisição retornar do servidor
var myObject = JSON.parse(xhttp.responseText);
myObject.forEach(setParams);
}

</script>


@endpush

@section('main')

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registrar novo usuário</h4>
                <br>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif

                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Usuário cadastrado com sucesso!</div>
                @endif

                @if (session('save-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor verificar as informações
                    e tentar novamente.</div>
                @endif
                <form action="{{route('user_register')}}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">

                            <div class="col-md-10">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Tipo de
                                                usuário</label>
                                            <select class="custom-select mr-sm-2" id="tp_usuario_register"
                                                name="tp_usuario">
                                                <option selected value="">Escolha..</option>
                                                <option value="Cliente">Cliente</option>
                                                <option value="Funcionário">Funcionário</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Nome do usuário</label>
                                            <select class="custom-select mr-sm-2" id="nome_usuario" name="nome_usuario">
                                                <option selected value="">Selecione o tipo de usuário...</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Login</label>
                                            <input type="text" title="Informe o login de usuário" class="form-control"
                                                placeholder="Login" id="login_usuario" name="login_usuario">
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Senha</label>
                                            <input type="password" title="Informe a senha de usuário"
                                                class="form-control" placeholder="Senha" id="senha_usuario"
                                                name="senha_usuario">
                                        </div>
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Confirmar
                                                Senha</label>
                                            <input type="password" title="Confirme a senha de usuário"
                                                class="form-control" placeholder="Confirmar senha" id="senha2_usuario"
                                                name="senha2_usuario">
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="text-right">
                                <button type="submit" class="btn btn-info">Cadastrar usuário</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>







    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Editar Usuário</h4>
                <br>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif

                @if (session('edit-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Usuário editado com sucesso!</div>
                @endif

                @if (session('edit-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Não existe nenhuma conta de usuário para a pessoa
                    selecionada ou, o login está incorreto, favor verificar as informações
                    e tentar novamente.</div>
                @endif
                <form action="{{route('user_edit')}}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">

                            <div class="col-md-10">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Tipo de
                                                usuário</label>
                                            <select class="custom-select mr-sm-2" id="tp_usuario_register2"
                                                name="tp_usuario">
                                                <option selected value="">Escolha..</option>
                                                <option value="Cliente">Cliente</option>
                                                <option value="Funcionário">Funcionário</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Nome do usuário</label>
                                            <select class="custom-select mr-sm-2" id="nome_usuario2"
                                                name="nome_usuario">
                                                <option selected value="">Selecione o tipo de usuário..</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Login</label>
                                            <input type="text" title="Informe o login de usuário" class="form-control"
                                                placeholder="Login" id="login_usuario" name="login_usuario">
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Senha</label>
                                            <input type="password" title="Informe a senha de usuário"
                                                class="form-control" placeholder="Senha" id="senha_usuario"
                                                name="senha_usuario">
                                        </div>
                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Confirmar
                                                Senha</label>
                                            <input type="password" title="Confirme a senha de usuário"
                                                class="form-control" placeholder="Confirmar senha" id="senha2_usuario"
                                                name="senha2_usuario">
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="text-right">
                                <button type="submit" class="btn btn-info">Cadastrar usuário</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Funcionários cadastrados</h4>
                <br>
                @if (session('del-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Usuário excluído com sucesso!</div>
                @endif

                @if (session('del-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor verificar as informações
                    e tentar novamente.</div>
                @endif
                <div class="table-responsive">
                    <table id="zero_config3" class="table table-striped table-bordered no-wrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Tipo de usuário</th>
                                <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $l)
                            <tr>
                                <td>{{$l['nome']}}</td>
                                <td>@if ($l['privilegio'] == 1)Funcionário @else Cliente @endif</td>

                                <td>
                                    <form method="get" action="{{route('user_del', ['id' => $l['id'] ])}}"
                                        onsubmit="return confirm('Tem certeza que deseja excluir?')" >
                                        <button type="submit" class="btn btn-danger btn-circle" title="Excluir Usuário">
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

</div>


@endsection