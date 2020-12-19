<?php
    echo "Llego a vista tienda";
?>


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
            <h2><?php echo "Usuario: ".$_SESSION['user'].". Perfil Usuario (Para Boton: admin/consulta pedidos): ".$_SESSION['rol']; ?><h2>

		</div>
	</header>
	<div class="container">

		<div class="row">
            <?php foreach ($result as $categoria) { ?>
                <div class="color2 col-md-3">
                    <a href="index.php?controlador=ControladorTienda&accion=add(<?php echo $categoria->getId(); ?>)" class="thumbnail">
                        <?php echo $categoria->getImg() ?>
                        <!--<img src="img/clothes/Jeans.svg" alt="" width="200" height="200" title="Bootstrap">-->
                    </a>	
                </div>
            <?php } ?>			
		<div>
	</div>
		



	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>