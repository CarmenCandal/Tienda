<?php
/**
 * Controlador para el manejo de la tienda
 * Clase php que hereda de ControladorBase añadiendo funcionalidad concreta para el manejo de la tienda
 * Recibe los eventos que se producen en la vista de la tienda (pantalla principal), los gestiona y realiza las peticiones correspondientes 
 * a los modelos de producto, item, pedido e items del pedido.
 * 
 * @author Gerard Herrera Sague
 * @author Paul Morrison Aguiar
 * @author Jesús Pérez Melero
 * @author Carmen María Candal alonso
*/

// incluimos modelos
require_once('modelo/ModeloItem.php');
require_once('modelo/ModeloProduct.php');
require_once('modelo/ModeloPedido.php');
require_once('modelo/ModeloItemsPedido.php');


class ControladorTienda extends ControladorBase {
    public $item_modelo;
    public $product_modelo;
    public $pedido_modelo;
    public $itemsPedido_modelo;

    public function __construct() {
        $this->item_modelo = new ModeloItem(); 
        $this->product_modelo = new ModeloProduct(); 
        $this->pedido_modelo = new ModeloPedido(); 
        $this->itemsPedido_modelo = new ModeloItemsPedido();
    }

    //Operación de muestra de todos los productos, el usuario debe estar auténticado
    public function mostrarItems() {
        if (!isset($_SESSION["user"]) || !isset($_SESSION["rol"])) {
            require('vista/VistaLogin.php');
            return;
        }

        //Obtenemos todos los items y categorías
        $items=$this->item_modelo->readAll();
        $products=$this->product_modelo->readAll();

        // Forzamos que la clave de cada elemento del array se corresponde con la id de la categoría
        foreach ($products as $product) {
            $categorias[$product->getId()] = $product;
        }

        if ($categorias != null && $items != null)
        {       // incluimos la vista        
                require('vista/VistaTienda.php');
        }                           
        else{
            echo "No hay resultados";
        }
    }

    // Operación que muestra los productos filtrados según la categoría a la que pertenezcan
    // categoriaId: Identificador de la categoría del producto por el que se quiere filtrar
    public function filter($categoriaId) {
        if (!isset($categoriaId)) return;

        if ($categoriaId == 0) unset($_SESSION["filtroId"]);
        else $_SESSION["filtroId"] = $categoriaId;

        $this->mostrarItems();
    }

     // Operación que añade un item al pedido
     // idItem: Identificador del item que se quiere añadir al pedido
    public function add($idItem) {
        if (!isset($idItem)) return;

        $item = $this->item_modelo->readById($idItem);
        if (isset($item)) {
            if (!isset($_SESSION["idPedido"])) {
                $pedido = new Pedido();
                $pedido->setId_usuario($_SESSION['userId']);
                $pedido->setFecha(date("Y/m/d"));
                $pedido->setTotal($item->getPrecio());
                $pedido->setEstado("Pendiente");
    
                $pedidoId = $this->pedido_modelo->insertaPedidoId($pedido);
    
                if ($pedidoId > 0) {
                    $pedido->setId($pedidoId);
                    $_SESSION["idPedido"] = $pedidoId;
                    $_SESSION["numItemsPedido"] = 0;
                }
            }
            else {
                $pedido = $this->pedido_modelo->readById($_SESSION["idPedido"]);
                $pedido->setTotal($pedido->getTotal() + $item->getPrecio());
                $this->pedido_modelo->updatePedidoTotal($pedido);
            }

            $_SESSION["numItemsPedido"]++;
            $_SESSION["totalPedido"] = $pedido->getTotal();

            $itemsPedido = new ItemsPedido();
            $itemsPedido->setId_pedido($pedido->getId());
            $itemsPedido->setId_item($item->getId());
            $itemsPedido->setCantidad(1);
            $this->itemsPedido_modelo->insertaItemsPedido($itemsPedido);
        }

        $this->mostrarItems();
    }

    //Operación de cierre de sesión
    public function cerrarSesion() {
        unset($_SESSION["user"]);
        unset($_SESSION["rol"]);
        unset($_SESSION['userId']);
        unset($_SESSION["filtroId"]);
        unset($_SESSION['idPedido']);
        unset($_SESSION["numItemsPedido"]);
        unset($_SESSION["totalPedido"]);
        unset($_SESSION['idPedido']);
        unset($_SESSION['numItemsPedido']);
        unset($_SESSION['totalPedido']);
        unset($_SESSION['carrito']);
        unset($_SESSION['pedidoActual']);
        unset($_SESSION['idPedidoActual']);
        require('vista/VistaLogin.php');
    }
}

?>