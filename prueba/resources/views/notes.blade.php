<head>
	<meta charset="utf-8">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<script type="text/javascript" src="{{asset('js/app.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/checkConsultores.js') }}"></script>
	<style>
		.state-icon {
			left: -5px;
		}
		.list-group-item-primary {
			color: rgb(255, 255, 255);
			background-color: rgb(66, 139, 202);
		}

		/* DEMO ONLY - REMOVES UNWANTED MARGIN */
		.well .list-group {
			margin-bottom: 0px;
		}
	</style>
</head>
<body>

	<div class="container" style="margin-top:20px;">
		<div class="row">
			<div class="col-xs-6">
				<h3 class="text-center">Colorful Example</h3>
				<div class="well" style="max-height: 300px;overflow: auto;">
					<ul id="check-list-box" class="list-group checked-list-box">
						<li class="list-group-item">Cras justo odio</li>
						<li class="list-group-item" data-color="success">Dapibus ac facilisis in</li>
						<li class="list-group-item" data-color="info">Morbi leo risus</li>
						<li class="list-group-item" data-color="warning">Porta ac consectetur ac</li>
						<li class="list-group-item" data-color="danger">Vestibulum at eros</li>
					</ul>
					<br />
					<button class="btn btn-primary col-xs-12" id="get-checked-data">Get Checked Data</button>
				</div>
				<pre id="display-json"></pre>
			</div>
		</div>
	</div>


	<!--<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Notas Modificadas</div>

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
	</div>-->


</body>
