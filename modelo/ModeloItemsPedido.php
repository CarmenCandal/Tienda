<?php
require_once ('ModeloBase.php');
class ModeloItemsPedido extends ModeloBase{
    const TABLA = "items_pedido";
    const OBJ = "ItemsPedido";
    public function __construct(){
        parent::__construct(self::TABLA, self::OBJ);
    }

    public function insertaItemsPedido($itemsPedido){
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=$this->link->query("INSERT INTO items_pedido (id_pedido, id_item, cantidad) 
        VALUES ('$itemsPedido->getId_pedido','$itemsPedido->getId_item','$itemsPedido->getCantidad')")){          
          
           return $result;

        }else{ 
            echo "Error: " . $result . "<br>" . mysqli_error($this->link);
        }
    }
    public function updateItemsPedido($itemsPedido){
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=$this->link->query("UPDATE items_pedido 
                                        SET id_pedido='$itemsPedido->getId_pedido', 
                                        SET id_item='$itemsPedido->getId_item', 
                                        SET cantidad='$itemsPedido->getCantidad'
                                        WHERE id='$itemsPedido->getId'")){ 
            return $result;

        }else{ 
            echo "Error: " . $result . "<br>" . mysqli_error($this->link);
        }
    }
    
?>