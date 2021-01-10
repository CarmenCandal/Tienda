<?php
/**
 * Gestión de la lista de items del pedido
 *
 * Página php que hereda de ModeloBase añadiendo funcionalidad concreta para el manejo de la clase ItemsPedido
 * 
 * @author Gerard Herrera Sague
 * @author Paul Morrison Aguiar
 * @author Jesús Pérez Melero
 * @author Carmen María Candal alonso
*/
require_once('ModeloBase.php');
class ModeloItemsPedido extends ModeloBase{
    const TABLA = "items_pedido";
    const OBJ = "ItemsPedido";
    public function __construct(){
        parent::__construct(self::TABLA, self::OBJ);
    }

    public function insertaItemsPedido($itemsPedido){
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("INSERT INTO items_pedido (id_pedido, id_item, cantidad) 
        VALUES ('".$itemsPedido->getId_pedido()."','".$itemsPedido->getId_item()."','".$itemsPedido->getCantidad()."')")){          
          
           return $result;

        }else{ 
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }
    public function updateItemsPedido($itemsPedido){
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("UPDATE items_pedido 
                                        SET id_pedido='".$itemsPedido->getId_pedido()."', 
                                        SET id_item='".$itemsPedido->getId_item()."', 
                                        SET cantidad='".$itemsPedido->getCantidad()."'
                                        WHERE id='".$itemsPedido->getId."'")){ 
            return $result;

        }else{ 
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }

    public function deleteByIdPedidoAndIdItem($idPedido, $idItem) {
        // devolverá true si la consulta se ha realizado con éxito
        if ($result=parent::getLink()->query("DELETE FROM items_pedido WHERE id_pedido='$idPedido' AND id_item='$idItem' LIMIT 1")){
            return $result;
        }
    }
}
?>