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
		        <h1>Estimado: Administrador</h1>

		    </div>

		    <div class="card-body card-padding" >
		        <p class="lead">Hay una nueva cuenta esperando ser activada.</p>
		        <p>Por favor, tenga en cuenta la siguiente información</p>		       
                <p></p>
                <p>ID: {{$usuario->id}}</p>
                <p>Correo: {{$usuario->email}}</p>
                <p>Usuario: {{$usuario->username}}</p>
                <p>Nombre: {{$usuario->nombre}}</p>
		        <p><a href="{{ $ruta }}" class=" btn btn-success btn-lg"><i class="zmdi zmdi-check"></i> Click aqui para ver el registro (Solo si tiene iniciada la sesión en CIUM) </a></p>
		        <p></p>
		        <p></p>
		        <p><strong>No es posible enviar respuestas a esta dirección de correo electrónico. </strong></p>
		        
		    </div>
		</div>
	</body>
</html>

