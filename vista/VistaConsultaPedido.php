
<?php
/**
 * Página php con la vista para la consulta de la cesta y realización del pedido. 
 * 
 * Vista se presentan los productos de la cesta y los pedidos anteriormente realizados.
 * 
 * @author Gerard Herrera Sague
 * @author Paul Morrison Aguiar
 * @author Jesús Pérez Melero
 * @author Carmen María Candal alonso
 */
?>
<!DOCTYPE html>

<html>
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

<div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2>Tu carrito</h2>
            </div>
            <div class="col-sm-2">
                <?php
                if(isset($_SESSION['idPedido'])) {
                ?>
                <button type="button" class="btn btn-success" onclick="location.href='index.php?controlador=ControladorConsultaPedido&accion=confirmarPedido'">
                    Confirmar pedido</button>
                <?php
                }
                ?>
            </div>
            <div class="col-sm-2">
                <?php
                if(isset($_SESSION['idPedido'])) {
                ?>
                <button type="button" class="btn btn-danger" onclick="location.href='index.php?controlador=ControladorConsultaPedido&accion=vaciarCarrito'"
                >Vaciar carrito</button>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">

        <?php

        
        $imgs = $_SESSION['imgs'];
        if(isset($_SESSION['carrito'])) {
            $carrito = $_SESSION['carrito'];
            foreach ($carrito as $item) {
                ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <img id="productImage" class="card-img-top"
                             src="img/clothes/<?php echo $imgs[$item->getId_categoria()]; ?>"
                             alt="<?php echo $item->getNombre(); ?>">
                        <div class="card-body">
                            <h4 class="card-title">
                                <?php echo $item->getNombre(); ?>
                            </h4>
                            <h5><?php echo $item->getPrecio(); ?>€ - <?php echo $item->getColor(); ?> - <?php echo $item->getTalla(); ?></h5>
                            <p class="card-text"><?php echo $item->getDescripcion(); ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="index.php?controlador=ControladorConsultaPedido&accion=remove&args=<?php echo $item->getId(); ?>">QUITAR DEL CARRITO</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?>
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                <h5>Carrito vacío</h5>                  
                </div>
            <?php
        }
        ?>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2>Tus pedidos completados</h2>
            </div>
            <div class="col-sm-6">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                         if(isset($_SESSION['idPedidoActual'])) {
                            $idPedidoAct = $_SESSION['idPedidoActual'];
                            if (isset($idPedidoAct))
                                echo "Pedido #" . $idPedidoAct;
                            else
                                echo "Selecciona un pedido...";
                         }else
                            echo "Selecciona un pedido...";
                        ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php
                        if(isset($_SESSION['pedidosCompletados'])) {
                            $pedidos = $_SESSION['pedidosCompletados'];
                            if (!is_null($pedidos)) {
                                foreach ($pedidos as $pedido) {
                                    echo "<a class=\"dropdown-item\" href=index.php?controlador=ControladorConsultaPedido&&accion=obtenerPedido&args=" . $pedido->getId() . " \">Pedido #" . $pedido->getId() . "</a>";
                                }
                            } else {
                                echo "No hay pedidos ";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">

        <?php
        
        $imgs = $_SESSION['imgsPedidoActual'];
        if(isset($_SESSION['pedidoActual'])) {
            $pedidoActual = $_SESSION['pedidoActual'];
            foreach ($pedidoActual as $item) {
                ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <img id="productImage" class="card-img-top"
                             src="img/clothes/<?php echo $imgs[$item->getId_categoria()]; ?>"
                             alt="<?php echo $item->getNombre(); ?>">
                        <div class="card-body">
                            <h4 class="card-title">
                                <?php echo $item->getNombre(); ?>
                            </h4>
                            <h5><?php echo $item->getPrecio(); ?>€ - <?php echo $item->getColor(); ?> - <?php echo $item->getTalla(); ?></h5>
                            <p class="card-text"><?php echo $item->getDescripcion(); ?></p>
                        </div>
                        <div class="card-footer">
                            Has comprado este artículo
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>

    </div>


</div>
</div>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Computación en Servidor Web - Actividad 2 - Grupo 1</p>
    </div>
    <!-- /.container -->
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

</body>
</html>
