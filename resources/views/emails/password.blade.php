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
		        <h1>Estimado: {{$name}}</h1>

		    </div>

		    <div class="card-body card-padding" >
		        <p class="lead">Ha iniciado el proceso de recuperacion de contraseña.</p>
		        <p>Por favor, si usted no ha iniciado este proceso no hacer caso a este correo</p>		       
		        <p></p>
		        <p><a href="{{ $ruta }}" class=" btn btn-success btn-lg"><i class="zmdi zmdi-check"></i> Click aqui para restablecer tu cuenta </a></p>
		        <p></p>
		        <p></p>
		        <p><strong>No es posible enviar respuestas a esta dirección de correo electrónico. </strong></p>
		        
		    </div>
		</div>
	</body>
</html>

