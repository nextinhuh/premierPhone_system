<!DOCTYPE>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<title>Premier Phone - Cliente</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/assets/images/favicon.png')}}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
		integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
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
					<li class=""><a href="{{route('client_main')}}" accesskey="1" title="">Dados Cliente</a></li>
					
					<li class="current_page_item"><a href="{{route('client_order')}}" accesskey="3" title="">Ordens de
							Serviços</a></li>
					<li class=""><a href="{{route('deslogando')}}" accesskey="" title="">Log Out</a></li>
				</ul>
			</div>
		</div>
		<div id="main">

			<table class="table table-hover table-dark">
				<thead>
					<th>Número OS</th>
					<th>Aparelho</th>
					<th>Data</th>
					<th>Status</th>
				</thead>

				<tbody>
					@foreach($list as $l)
					<tr  class= "@if ($l['status'] == "Em Aberto") table-info @elseif($l['status'] == "Concluído")table-success @elseif($l['status'] == "Aguardando peças")table-warning @else table-danger @endif ">
						<td>{{$l['id']}}</td>
						<td>{{$l['marca']}} {{$l['modelo']}} - {{$l['cor']}}</td>
						<td>{{$l['dt_realizada']}}</td>
						<td>{{$l['status']}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div id="copyright">
				<span>&copy; Untitled. All rights reserved.</a></span>

			</div>
		</div>
	</div>
</body>

</html>