<!DOCTYPE >

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="keywords" content="" />
<meta name="description" content="" />
<title>Premier Phone - Cliente</title>
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('/assets/images/favicon.png')}}">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('/assets/front-page-client/bootstrap-4.5.0-dist/css/bootstrap.css')}}" />
<link href="{{asset('/assets/front-page-client/default.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{asset('/assets/front-page-client/fonts.css')}}" rel="stylesheet" type="text/css" media="all" />



</head>
<body>
<div id="page" class="container">
	<div id="header">
		<div id="logo">
			<span>Premier Phone </span>
			<img src="{{ asset("storage/".session('cli_foto')) }}" width="80" height="80" /> 
			<h1><a href="#">Olá, {{session('cli_nome')}}</a></h1>	
				
		</div>
		<div id="menu">
			<ul>
				<li class=""><a href="{{route('client_device')}}" accesskey="2" title="">Meus Aparelhos</a></li>
				<li class="current_page_item"><a href="{{route('client_main')}}" accesskey="1" title="">Dados Cliente</a></li>
				<li class=""><a href="{{route('client_order')}}" accesskey="3" title="">Ordens de Serviços</a></li>
				<li class=""><a href="{{route('deslogando')}}" accesskey="4" title="">Log Out</a></li>
			</ul>
		</div>
	</div>
	<div id="main">
		@if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif

				@if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Cliente editado com sucesso!</div>
                @endif

                @if (session('save-status') == "fail_end" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado no endereço, favor verificar as informações
                    e tentar novamente.</div>
                @endif

                @if (session('save-status') == "fail_fun" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado nos dados do cliente, favor verificar as
                    informações e tentar novamente.</div>
                @endif

                @if (session('save-status') == "fail_pes" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor recomeçe o procedimento.</div>
                @endif
		<div class="border-orange">			
			<div class="mb-2">
				<h1>Dados Usuario</h1>
			</div>
		<form action="{{route('save_edit_cos')}}" method="post">
			@csrf
			<div class="form-row ">
				@foreach($list as $l)
				
					<div class="">
						<h3>Nome</h3>
						<div class="form-group col-md-3">
						<input type="text" hidden name="foto">
						<input type="text" hidden name="id" value="{{session('cli_id_pessoa')}}">
						<input  type="text"  id="nome" name="nome_cli" value="{{$l['nome']}}"/>
						</div>
					</div>
					<div>
						<h3>Email</h3>
						<div class= "form-group col-md-3">
							<input type="text"  id="email" name="email" value="{{$l['email']}}"/>
						</div>
					</div>
					<div>
						<h3>Telefone</h3>
						<div class="form-group col-md-3">
							<input type="text"  id="telefone" name="telefone" value="{{$l['telefone']}}"/>
						</div>
					</div>
			</div>
			<div class="form-row ">
					<div>
						<h3>Cpf</h3>
						<div class="form-group col-md-3">
							<input type="text"  id="cpf" name="cpf" value="{{$l['cpf']}}"/>
						</div>
					</div>
					<div>
						<h3>Rg</h3>
						<div class="form-group col-md-3">
							<input type="text"  id="rg" name="rg" value="{{$l['rg']}}"/>
						</div>
					</div>
				</div>
			</div>

		<div class="mt-4 mb-2 border-orange">
			<div>
				<h1>Endereço</h1>
			</div>
			<div class="form-row">
				<div class="">
					<h3>CEP</h3>
					<div class="form-group col-md-6">
						<input  type="text"  id="cep" name="cep" value="{{$l['cep']}}"/>
					</div>
				</div>
				<div>
					<h3>UF</h3>
					<div class="form-group col-md-6">
						<input type="text"  id="estado" name="uf" value="{{$l['uf']}}"/>
					</div>
				</div>
				<div>
					<h3>Cidade</h3>
					<div class="form-group col-md-6">
						<input type="text"  id="cidade" name="cidade" value="{{$l['cidade']}}"/>
					</div>
				</div>
				<div>
					<h3>Bairro</h3>
					<div class="form-group col-md-6">
						<input type="text"  id="bairro" name="bairro" value="{{$l['bairro']}}"/>
					</div>
				</div>
				<div>
					<h3>Logradouro</h3>
					<div class="form-group col-md-6">
						<input type="text"  id="logradouro" name="rua" value="{{$l['logradouro']}}"/>
					</div>
				</div>
				<div>
					<h3>Número Residencial</h3>
					<div class="form-group col-md-6">
						<input type="text"  id="numRes" name="num_casa" value="{{$l['num_casa']}}"/>
					</div>
				</div>
				<div>
					<h3>Complemento</h3>
					<div class="form-group col-md-6">
						<input type="text"  id="complemento" name="complemento" value="{{$l['complemento']}}"/>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="">
			<button type="submit" class=" btn btn-secondary">Salvar edição</button>
		</div>
	</form>
		<br>
			<div id="copyright">
				<span>&copy; Untitled. All rights reserved.</span>
				
			</div>
		</div>
	
		
	</div>

</div>
</body>
</html>
