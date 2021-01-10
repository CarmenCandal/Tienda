<?php
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

    public function obtenerPedidos() {

        unset($_SESSION['pedidoActual']);
        unset($_SESSION['idPedidoActual']);
        $this->cargarDatosPedidos();
        $this->view("VistaConsultaPedido", array());
    }

    private function cargarDatosPedidos() {

        $imgs = array();
        $idUsuario = $_SESSION['userId'];
       

        //Obtenemos los pedidos
        $pedidosCompletados = $this->pedidoRepository->getPedidosCompletados($idUsuario);

        if(isset($pedidosCompletados) && (!$pedidosCompletados=="")) {
            $_SESSION['pedidosCompletados'] = $pedidosCompletados;
        } else {
            $_SESSION['pedidosCompletados'] = null;
        }

        if(isset($_SESSION['idPedido'])) {
            $idPedidoCarrito = $_SESSION['idPedido'];
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

            if ($_SESSION["numItemsPedido"] == 0) {
                $this->eliminarPedidoCarrito();
                $this->limpiarCarrito();
            }
        }

        $this->obtenerPedidos();
    }

    public function confirmarPedido() {

        $idPedidoCarrito = $_SESSION['idPedido'];
        $pedido = $this->pedidoRepository->readById($idPedidoCarrito);
        $pedido->setEstado("Completado");
        $this->pedidoRepository->updatePedido($pedido);
        $this->limpiarCarrito();
        $this->obtenerPedidos();

    }

    public function vaciarCarrito() {
        $this->eliminarPedidoCarrito();
        $this->limpiarCarrito();
        $this->obtenerPedidos();
    }

    private function eliminarPedidoCarrito() {
        $idPedidoCarrito = $_SESSION['idPedido'];
        $this->pedidoRepository->deleteById($idPedidoCarrito);
    }

    private function limpiarCarrito() {

        unset($_SESSION['idPedido']);
        unset($_SESSION['numItemsPedido']);
        unset($_SESSION['totalPedido']);
        unset($_SESSION['carrito']);
        unset($_SESSION['pedidoActual']);
        unset($_SESSION['idPedidoActual']);
    }
}

?>
