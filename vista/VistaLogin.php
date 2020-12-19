<!DOCTYPE html>

<html>
<head>
	<title>Tienda online</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<meta charset="utf-8">
</head>
<body>

	<header>
		<div class="container">

			<h1>UnirShopping</h1>

		</div>
	</header>
	<div class="container text-center">

		<div class="row">
		<form class="form-signin" id="flogon" method="post" action="index.php?controlador=ControladorLogin&&accion=valida">
			<img class="mb-4" src="img/key-svgrepo-com.svg" alt="" width="72" height="72">
			<h1 class="h3 mb-3 font-weight-normal">Introduzca los datos de su cuenta</h1>
			<h1 class="h5 mb-5 text-danger" id="error"><?php if (isset($error) && $error != '') {echo $error;}?></h1>
			<div class="form-group row">
				<div class="col-md-12">
					<label for="login" class="sr-only">Usuario</label>
					<input type="text" id="login" name="login" class="form-control" placeholder="Usuario" required autofocus>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label for="pwd" class="sr-only">Contraseña</label>
					<input type="password" id="pwd" name ="pwd" class="form-control" placeholder="Contraseña" required>
				</div>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Acceder</button>
			<p class="mt-5 mb-3 text-muted">&copy; 2020</p>
		</form>		
	</div>



	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>