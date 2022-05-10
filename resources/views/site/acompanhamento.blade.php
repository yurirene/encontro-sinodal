<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Acompanhamento: {{$inscricao->primeiro_nome}}</title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="/site/assets/css/style.css" rel="stylesheet">

</head>
<body>
   
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	@if(is_null($inscricao))
	<div class="page-header">
		<h1 id="timeline">Inscrição Cancelada</h1>
	</div>
	@endif
	<div class="page-header">
		<h1 id="timeline">Olá, {{$inscricao->nome}}</h1>
	</div>
	<ul class="timeline">
		@foreach($inscricao->timeline as $key => $timeline)

		@if($key%2==0)
		<li>
			<div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>
			<div class="timeline-panel">
				<div class="timeline-heading">
					<h4 class="timeline-title">{{$timeline->texto}}</h4>
					<p>
						<small class="text-muted">
							<i class="glyphicon glyphicon-time"></i> 
							{{ $timeline->horario }}
						</small>
					</p>
				</div>
			</div>
		</li>
		@else
		<li class="timeline-inverted">
			<div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>
			<div class="timeline-panel">
				<div class="timeline-heading">
					<h4 class="timeline-title">{{$timeline->texto}}</h4>
					<p>
						<small class="text-muted">
							<i class="glyphicon glyphicon-time"></i> 
							{{ $timeline->horario }}
						</small>
					</p>
				</div>
			</div>
		</li>
		@endif
		

		@endforeach
		
		
		<li>
	</ul>
</div>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>