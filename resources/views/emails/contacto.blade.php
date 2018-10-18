<html>
	<head>
    	<meta charset="utf-8">
        <meta name="description" content="CIUM">
        <meta name="author" content="CIUM">
        <meta name="keyword" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{url('images/logomi.png')}}">
        
		<title>CIUM</title>
		<style type="text/css">
		<?php require_once(public_path()."/css/app.min.1.css") ?>

		</style>
		
    </head>
    <body>
	
		<div class="card">
		    <div class="card-header">
		        <h1>Nuevo Mensaje:</h1>

		    </div>

		    <div class="card-body card-padding" >
		        <p class="lead">Motivo de Contacto: {{$tipo}}</p>
		        <p>{{$mensaje}}</p>		       		        
		    </div>
		</div>
	</body>
</html>