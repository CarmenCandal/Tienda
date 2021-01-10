<?php
require_once('ModeloBase.php');
class ModeloPedido extends ModeloBase {
    const TABLA = "pedido";
    const OBJ = "Pedido";

    public function __construct() {
        parent::__construct(self::TABLA, self::OBJ);
    }

    public function insertaPedido($pedido) {
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("INSERT INTO pedido (id_usuario, fecha, total, estado) 
            VALUES ('".$pedido->getId_usuario()."','".$pedido->getFecha()."','".$pedido->getTotal()."','".$pedido->getEstado()."')"))
        {
           return $result;
        } else { 
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }

    public function insertaPedidoId($pedido) {
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("INSERT INTO pedido (id_usuario, fecha, total, estado) 
            VALUES ('".$pedido->getId_usuario()."','".$pedido->getFecha()."','".$pedido->getTotal()."','".$pedido->getEstado()."')"))
        {
           return parent::getLink()->insert_id;
        } else { 
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }

    public function updatePedido($pedido) {
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("UPDATE pedido SET estado='".$pedido->getEstado()."' WHERE ID='".$pedido->getId()."'"))
        { 
            return $result;
        } else {
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }

    public function updatePedidoTotal($pedido) {
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("UPDATE pedido SET total=".$pedido->getTotal()." WHERE ID=".$pedido->getId()))
        { 
            return $result;
        } else { 
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }

    public function getPedidosCompletados($idUsuario) {
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("SELECT * FROM pedido WHERE id_usuario=$idUsuario AND estado='Completado'"))
        {
            // Devolvemos la lista de objetos que cumplen con la condición
            while($row = $result->fetch_object("Pedido")) {
                $resultSet[]=$row;
            }
            return $resultSet;
        } else {
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }

    public function getCarrito($idUsuario) {
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("SELECT * FROM pedido WHERE estado='Pendiente' AND id_usuario=$idUsuario"))
        {
            return $result;
        } else {
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }
}
?>