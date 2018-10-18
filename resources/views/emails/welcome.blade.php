<html>
	<head>
    	<meta charset="utf-8">
        <meta name="description" content="CIUM">
        <meta name="author" content="CIUM">
        <meta name="keyword" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{url('images/logo.png')}}">
        
		<title>CIUM</title>
		<style type="text/css">
		<?php require_once(public_path()."/css/app.min.1.css") ?>
		</style>
    </head>
    <body>
	
		<table border="0px" width="750px" height="auto" cellspacing="5px" padding="8px">
			<tr valign="bottom">
				<td background="{{url('images/head.png')}}" style="background-repeat: no-repeat;">
					<table border="0px" width="100%">
						<tr valign="bottom">
							<td valign="bottom" width="33%" height="120px">
								
							</td>
							<td valign="bottom" width="33%" height="120px">
								<h1>Bienvenido: {{ $name }}</h1>
							</td>
							<td valign="bottom" width="33%" height="120px">
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr valign="middle">
				<td>
					<p class="lead">Te damos la bienvenida a CIUM.</p>
					<p>Es para nosotros un honor que formes parte de la comunidad</p>
					<p></p>
					<p><a href="{{ $ruta }}" class=" btn btn-success btn-lg"><i class="zmdi zmdi-check"></i> Click aqui para activar tu cuenta </a></p>
					<p></p>
					<p></p>
					<p><strong>No es posible enviar respuestas a esta dirección de correo electrónico. </strong></p>
				</td>
			</tr>
			
		</table>
		
	</body>
</html>
