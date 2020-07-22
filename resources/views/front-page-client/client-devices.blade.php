<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Skeleton 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130902

-->
<html xmlns="http://www.w3.org/1999/xhtml">

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

	<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

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
					<li class="current_page_item"><a href="{{route('client_device')}}" accesskey="2" title="">Meus
						Aparelhos</a></li>
					<li class=""><a href="{{route('client_main')}}" accesskey="1" title="">Dados Cliente</a></li>
					<li class=""><a href="{{route('client_order')}}" accesskey="3" title="">Ordens de Serviços</a></li>
					<li class=""><a href="{{route('deslogando')}}" accesskey="4" title="">Log Out</a></li>
				</ul>
			</div>
		</div>
		<div id="main">

			<div class="profile-container">

				<ul class="">
					@foreach($equip as $e)
					<li>
						<img src="{{$e['historico']}}" alt="teste">
						<h3>{{$e['marca']}} {{$e['modelo']}} - {{$e['cor']}}</h3>
					</li>
					@endforeach


				</ul>
			</div>
			<div id="copyright">
				<span>&copy; Untitled. All rights reserved. | Photos by <a
						href="http://fotogrph.com/">Fotogrph</a></span>
				<span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</span>
			</div>
		</div>
	</div>
</body>

</html>