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
			<div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i></div>
			<div class="timeline-panel">
				<div class="timeline-heading">
					<h4 class="timeline-title">Mussum ipsum cacilds</h4>
				</div>
				<div class="timeline-body">
					<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
					<p>Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis. Pellentesque laoreet mé vel lectus scelerisque interdum cursus velit auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac mauris lectus, non scelerisque augue. Aenean justo massa.</p>
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