<?php
/**
 * Controlador para el manejo de la pantalla de consulta de pedido y carrito
 *
 * Clase php que hereda de ControladorBase añadiendo funcionalidad concreta para el manejo de la consulta de pedidos y carrito de la compra
 * Recibe los eventos que se producen en la vista de consulta de pedido (carrito), los gestiona y realiza las peticiones correspondientes 
 * a los modelos de producto, item, pedido e items del pedido.
 * 
 * @author Gerard Herrera Sague
 * @author Paul Morrison Aguiar
 * @author Jesús Pérez Melero
 * @author Carmen María Candal alonso
*/
// incluimos los modelos a utilizar
require_once('modelo/ModeloPedido.php');
require_once('modelo/ModeloItem.php');
require_once('modelo/ModeloItemsPedido.php');
require_once('modelo/ModeloProduct.php');

class ControladorConsultaPedido extends ControladorBase
{

    private $pedidoRepository;
    private $itemRepository;
    private $itemsPedidoRepository;
    private $product_modelo;

    //Construccion del controlador, incializa los repositorios de acceso a datos.
    public function __construct()
    {
        $this->pedidoRepository = new ModeloPedido();
        $this->itemRepository = new ModeloItem();
        $this->itemsPedidoRepository = new ModeloItemsPedido();
        $this->product_modelo = new ModeloProduct();

    }

    //Obtiene la información de un pedido
    // idPedido: identificador del pedido 
    // Se carga la vista de consulta del pedido.
    public function obtenerPedido($idPedido)
    {

        if(isset($idPedido)) {

            $carrito = $this->pedidoRepository->readById($idPedido);

            //Obtenemos los items del carrito
            $itemsCarrito = array();
            $i = 0;
            $itemsPedido = $this->itemsPedidoRepository->readBy("id_pedido", $carrito->getId());
            foreach($itemsPedido as $itemPedido) {

                $item = $this->itemRepository->readById($itemPedido->getId_item());
                $product = $this->product_modelo->readById($item->getId_categoria());
                $imgs[$product->getId()] = $product->getImg();
                $itemsCarrito[$i++] = $item;

            }
            $_SESSION['pedidoActual'] = $itemsCarrito;
            $_SESSION['idPedidoActual'] = $idPedido;
            $_SESSION['imgs'] = $imgs;
        }

        //Antes de cargar la vista obtenemos de nuevo la info de pedidos
        $this->cargarDatosPedidos();
        $this->view("VistaConsultaPedido", array());
    }

    //Obtiene la lista de pedidos realizados por ese usuario 
    // Se carga la vista de consulta de pedido con esa información
    public function obtenerPedidos() {

        if (isset($_SESSION['pedidoActual'])) unset($_SESSION['pedidoActual']);
        if (isset($_SESSION['idPedidoActual'])) unset($_SESSION['idPedidoActual']);
        $this->cargarDatosPedidos();
        $this->view("VistaConsultaPedido", array());
    }

    //Carga los datos de los pedidos de un usuario
    private function cargarDatosPedidos() {

        $imgs = array();        
        $idUsuario = $_SESSION['userId'];
        if (isset($_SESSION['idPedido'])){
            $idPedidoCarrito = $_SESSION['idPedido'];

            //Obtenemos los pedidos
            $pedidosCompletados = $this->pedidoRepository->getPedidosCompletados($idUsuario);

            if(isset($pedidosCompletados) && (!$pedidosCompletados=="")) {
                $_SESSION['pedidosCompletados'] = $pedidosCompletados;
            } else {
                $_SESSION['pedidosCompletados'] = null;
            }

            if(isset($idPedidoCarrito)) {

                $carrito = $this->pedidoRepository->readById($idPedidoCarrito);

                //Obtenemos los items del carrito
                $itemsCarrito = array();
                $i = 0;
                $itemsPedido = $this->itemsPedidoRepository->readBy("id_pedido", $carrito->getId());
                foreach($itemsPedido as $itemPedido) {

                    $item = $this->itemRepository->readById($itemPedido->getId_item());
                    $product = $this->product_modelo->readById($item->getId_categoria());
                    $imgs[$product->getId()] = $product->getImg();
                    $itemsCarrito[$i++] = $item;

                }
                $_SESSION['carrito'] = $itemsCarrito;
                $_SESSION['imgs'] = $imgs;
            }
        }
    }

    //Elimina un item del pedido
    // idItem: identificador único de un item de un pedido
    public function remove($idItem)
    {
        if (!isset($idItem)) return;

        $item = $this->itemRepository->readById($idItem);
        if (isset($item)) {

            $pedido = $this->pedidoRepository->readById($_SESSION["idPedido"]);
            $pedido->setTotal($pedido->getTotal() - $item->getPrecio());
            $this->pedidoRepository->updatePedidoTotal($pedido);

            $_SESSION["numItemsPedido"]--;
            $_SESSION["totalPedido"] = $pedido->getTotal();

            echo $pedido->getId() . "-" . $item->getId();
            $this->itemsPedidoRepository->deleteByIdPedidoAndIdItem($pedido->getId(), $item->getId());
        }

        $this->obtenerPedidos();
    }

    // Confirma el pedido 
    // Modifica el estado del pedido a "completado", limpia los elementos del carrito y recarga la lista de pedidos
    public function confirmarPedido() {
        if (isset($_SESSION['idPedido'])){
            $idPedidoCarrito = $_SESSION['idPedido'];
            $pedido = $this->pedidoRepository->readById($idPedidoCarrito);
            $pedido->setEstado("Completado");
            $this->pedidoRepository->updatePedido($pedido);
            $this->limpiarCarrito();
            $this->obtenerPedidos();
        }

    }

    // Vacía los items del carrito
    public function vaciarCarrito() {

        $this->limpiarCarrito();
        $this->obtenerPedidos();
        if (isset($_SESSION['idPedido'])){
            $idPedidoCarrito = $_SESSION['idPedido'];
            $this->pedidoRepository->deleteById($idPedidoCarrito);
        }
    }

    // Elimina de la sesión la información del pedido actual
    private function limpiarCarrito() {
        if (isset($_SESSION['idPedido'])) unset($_SESSION['idPedido']);
        if (isset($_SESSION['numItemsPedido'])) unset($_SESSION['numItemsPedido']);
        if (isset($_SESSION['totalPedido'])) unset($_SESSION['totalPedido']);
        if (isset($_SESSION['carrito'])) unset($_SESSION['carrito']);
        if (isset($_SESSION['pedidoActual'])) unset($_SESSION['pedidoActual']);
        if (isset($_SESSION['idPedidoActual'])) unset($_SESSION['idPedidoActual']);
    }
}

?>