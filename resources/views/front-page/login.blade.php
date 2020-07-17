<!DOCTYPE HTML>
<html>

<head>
    <title>PREMIER PHONE login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{asset('/assets/front-page/css/main.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/front-page/css/bootstrap-4.5.0-dist/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/front-page/css/bootstrap-4.5.0-dist/css/bootstrap-reboot.css')}}" />
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@1,700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header id="header">
        <div class="inner">
            <a href="{{route('index')}}" class="logo">Premier Phone</a>
            <nav id="nav">
                <a href="{{route('index')}}">Inicio</a>
                <a class="singup" href="{{route('login')}}">Sing In</a>
            </nav>
        </div>
    </header>
    <a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>


    <div class="row">
        <div class="col-sm-4 offset-md-4 container2">
            <div class="admin-form ">
                <div class="admin-form-title align-center txtLogin">Log In</div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif
                @if (session('login-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Usuário ou senha incorretos, favor tentar novamente!</div>
                @endif
                <div class="admin-form-body">
                    <form method="POST" action="{{route('logando')}}">
                        @csrf
                        <input type="text" id=usuario class="form-control" placeholder="Usuário" name="login"><br>
                        <input type="password"  id=senha class="form-control" placeholder="Senha" name="senha"><br>
                        <select class="mb-4"  id="demo-category " name="tp_usuario">
                            <option value="">Tipo de usuario</option>
                            <option value="Funcionário">Funcionário</option>
                            <option value="Cliente">Cliente</option>
                        </select>
                        <button type="submit " value="Entrar " name="autenticar " class="btn btn-outline-orange  btn-block">Entrar</button>

                    </form>
                </div>
            </div>



            <!-- Scripts -->
            </body>

</html>