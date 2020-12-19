<?php
	session_start();// Se inicializa la sesión

 if (!isset($_SESSION['total'])) {  // Compruebe si una variable está vacía. También verifique si la variable está establecida / declarada:
    	$_SESSION['total']=0; //Definimos una variable de sesión para la variable total de prendas para que sea igual 0
    }

    if (!isset($_SESSION['items'])) { 
    	 $_SESSION['items']=array(); //Definimos una variable de sesión para un array nuevo
    }

 	if (isset($_GET['add'])){ // Compruebe si una variable está vacía. También verifique si la variable está establecida / declarada

      if($_GET['add'] == 'Jeans'){ // Compruebe si la varaible add es igual a Jeans
        $_SESSION['total'] = $_SESSION['total'] + 1;  // Añade 1 al número total de elementos de la lista
        array_push($_SESSION['items'], "Pantalón"); // Añade Pantalón al array items
      }

      if($_GET['add'] == 'WomanDress'){
        $_SESSION['total']= $_SESSION['total'] + 1; // Añade 1 al número total de elementos de la lista
        array_push($_SESSION['items'], "Vestido de mujer"); // Añade Vestido mujer al array items
      }

       if($_GET['add'] == 'T-Shirt'){
       $_SESSION['total']= $_SESSION['total'] + 1;  // Añade 1 al número total de elementos de la lista
       array_push($_SESSION['items'], "Camiseta"); // Añade Camiseta al array items
      }

       if($_GET['add'] == 'Hoodie'){
       $_SESSION['total']= $_SESSION['total'] + 1; // Añade 1 al número total de elementos de la lista
       array_push($_SESSION['items'], "Sudadera"); // Añade Sudadera al array items
      }

       if($_GET['add'] == 'delete'){ //Si la variable add es igual a delete entonces ejecuta la función borrar carro
    	$resultado = borrar_carro();
      }      


  	}

  	if(isset($_GET['deleteElement'])){ // Compruebe si una variable está vacía. También verifique si la variable está establecida / declarada
    	$Element = deleteElement($_GET['deleteElement']); //Ejecuta la función deleteElement con el numero de elemento selecciónado
      }

    function deleteElement($id){
    	unset($_SESSION['items'][$id]);
    	$_SESSION['items']=array_values($_SESSION['items']);    // Eso lo que hace es que dice que el array sea igual a los valores que si tienen datos del array eliminando aquellos que ya no tienen datos
    	if ($_SESSION['total'] > 0){ //Con este condicionamos a eliminar el elemento siempre que en la lista todavia queden elementos.
    	    $_SESSION['total'] = $_SESSION['total'] - 1;  //Restamos 1 al numero total de la lista
    	}

    }


    function borrar_carro(){ //la función Borrar_Carro
    	session_destroy(); // Destuimos la sesión
    	session_start(); // Se inicializa la sesión de nuevo
    	$_SESSION['total']=0;  //Reseteamos el valor del número total de prendas
    	unset($_SESSION['items']); //La función destruye la variable items donde contiene los arrays
    	$_SESSION['items']=array(); //los 
    	$texto = "Carro Borrado";
    	return $texto;
    	//echo "Carro Borrado";
    }


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

		</div>
	</header>
	<div class="container">

		<div class="row">

			<div class="color2 col-md-3">
				<a href="index.php?add=Jeans" class="thumbnail">
					<img src="img/clothes/Jeans.svg" alt="" width="200" height="200" title="Bootstrap">
				</a>	
			</div>
			<div class="color2 col-md-3">	
				<a href="index.php?add=T-Shirt" class="thumbnail">
					<img src="img/clothes/T-Shirt.svg" alt="" width="200" height="200" title="Bootstrap">
				</a>
			</div>
			<div class="color2 col-md-3">
				<a href="index.php?add=WomanDress" class="thumbnail">	
					<img src="img/clothes/Woman’s Dress.svg" alt="" width="200" height="200" title="Bootstrap">
				</a>
			</div>
			<div class="color2 col-md-3">
				<a href="index.php?add=Hoodie" class="thumbnail">	
					<img src="img/clothes/Hoodie.svg" alt="" width="200" height="200" title="Bootstrap">
				</a>
			</div>
		</div>

		<div>
		</div>
		<section class="main row">
			<article class="col-xs-12 col-sm-8 col-md-9 cold-lg-3">
				<p>
					<br>
					Presiona sobre la imagen del producto que desees añadir al carrito de compra. Para eliminar un Item, presiona el icono con la siguiente forma <img class="icons" src="img/x.svg" alt="Borrar elemento" width="32" height="32" title="Borrar elemento">.<br>De lo contrario si lo que deseas es eliminar todo el contenido del carrito, presiona el botón que encontrarás a continuación.
					<br><br>
					<a href="index.php?add=delete"><button type="button" id="1" class="btn btn-danger">Borrar Cesta</button></a>
					<br>
				</p>
			</article>

			<aside class="col-xs-12 col-sm-4 col-md-3 cold-lg-3">
				<p>
					<br>
					<strong>Tu cesta de la compra:</strong>
				    <?php for ($i =0; $i < count($_SESSION['items']); $i++) { ?>
				        <li><?php echo $_SESSION['items'][$i]; ?> <a href="index.php?deleteElement=<?php echo $i; ?>"> <img class="icons" src="img/x.svg" alt="Borrar elemento" width="32" height="32" title="Borrar elemento"></a></li>
				        				<?php } ?>
				<br>Nº total de artículos: <strong> <?php echo $_SESSION['total']; ?> </strong>
 				<br><strong><?php if (isset($resultado)){echo strtoupper($resultado);} { // This is a one-line c++ style comment
 					# code...
 				} ?> </strong>
				</p>
			</aside>
		</section>
	</div>



	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>