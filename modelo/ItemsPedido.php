<?php
/**
 * Página php con la clase ItemsPedido
 * 
 * Cada elemento de la lista de la compra, 
 * se corresponde con la tabla ItemsPedido de la Base de Datos. Será manejado por la clase ModeloItemsPedido
 * 
 * @author Gerard Herrera Sague
 * @author Paul Morrison Aguiar
 * @author Jesús Pérez Melero
 * @author Carmen María Candal alonso
 */
    class ItemsPedido{
        private $id;
        private $id_pedido;
        private $id_item;
        private $cantidad;
               
        function getId(){
            return $this->id;
        }
        function setId($_id){
            $this->id =$_id;
        }

        function getId_pedido(){
            return $this->id_pedido;
        }
        function setId_pedido($_id_pedido){
            $this->id_pedido =$_id_pedido;
        }
        function getId_item(){
            return $this->id_item;
        }
        function setId_item($_id_item){
            $this->id_item =$_id_item;
        }
        function getCantidad(){
            return $this->cantidad;
        }
        function setCantidad($_cantidad){
            $this->cantidad =$_cantidad;
        }
       
    } 
?>