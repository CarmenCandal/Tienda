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
      <a class="navbar-brand" href=".">UnirShopping - Tienda</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href=".">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php
            if($_SESSION['rol'] == 1) {
              echo '<li class="nav-item"><a class="nav-link" href="index.php?controlador=ControladorAdmin&accion=consulta">Administración</a></li>';
            }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?controlador=ControladorTienda&accion=cerrarSesion">Cerrar sesión
            </a>
          </li>
          <li class="nav-item">
            <button type="button" class="btn btn-secondary" onclick="location.href='index.php?controlador=ControladorConsultaPedido&accion=obtenerPedidos'" >
              <img src="img/cart.svg"> Carrito<?php if (isset($_SESSION["idPedido"])) echo "(".$_SESSION["numItemsPedido"].") - ".$_SESSION["totalPedido"].'€' ?>
            </button>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div id="cuerpoTienda" class="container">

    <div class="row">

      <div class="col-lg-3">
        <h1 class="my-4">Categorías</h1>
        <div class="list-group">
        <a href="index.php?controlador=ControladorTienda&accion=filter&args=0"
          class="list-group-item <?php if (!isset($_SESSION["filtroId"]) || $_SESSION["filtroId"] == 0) echo 'active' ?>"
        >Todas</a>
        <?php foreach ($categorias as $categoria) { ?>
          <a href="index.php?controlador=ControladorTienda&accion=filter&args=<?php echo $categoria->getId(); ?>"
            class="list-group-item <?php if (isset($_SESSION["filtroId"]) && $_SESSION["filtroId"] == $categoria->getId()) echo 'active' ?>"
          ><?php echo $categoria->getNombre(); ?></a>
        <?php } ?>
        </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div class="row">

        <?php foreach ($items as $item)
          if (!isset($_SESSION["filtroId"]) || $_SESSION["filtroId"] == $item->getId_categoria()) {
        ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <img id="productImage" class="card-img-top"
                src="img/clothes/<?php echo $categorias[$item->getId_categoria()]->getImg(); ?>"
                alt="<?php echo $item->getNombre(); ?>">
              <div class="card-body">
                <h4 class="card-title">
                  <?php echo $item->getNombre(); ?>
                </h4>
                <h5><?php echo $item->getPrecio(); ?>€ - <?php echo $item->getColor(); ?> - <?php echo $item->getTalla(); ?></h5>
                <p class="card-text"><?php echo $item->getDescripcion(); ?></p>
              </div>
              <div class="card-footer">
                <a href="index.php?controlador=ControladorTienda&accion=add&args=<?php echo $item->getId(); ?>">AÑADIR AL CARRITO</a>
              </div>
            </div>
          </div>
        <?php
          }
        ?>

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

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
