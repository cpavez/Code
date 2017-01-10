<head>
	<meta charset="utf-8">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Notas</div>

					<div class="panel-body">
						<ul class="list-group">
							@foreach ($notas as $note)
								<li class="list-group-item">
									{{$note->note}}
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
