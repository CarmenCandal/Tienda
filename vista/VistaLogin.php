<!DOCTYPE html>
<html lang="es">

<head>

  <title>Tienda online</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <meta charset="utf-8">

</head>
<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<a class="navbar-brand" href=".">UnirShopping</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
	</div>
	</nav>
	
	<!-- Page Content -->
	<div id="cuerpoLogin" class="container text-center">
		<div class="row justify-content-center">
			<div class="col-lg-3">
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
		</div>
	</div>
	<!-- /.container -->

	<!-- Footer -->
	<footer class="py-5 bg-dark">
	<div class="container">
		<p class="m-0 text-center text-white">Computación en Servidor Web - Actividad 2 - Grupo 1</p>
	</div>
	<!-- /.container -->
	</footer>

	<!-- Bootstrap core JavaScript -->
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	
</body>
</html>