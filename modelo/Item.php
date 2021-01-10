<?php
/**
 * Página php con la clase Item
 * 
 * Cada una de las posibles productos pertenecientes a una categoría de producto que se pueden comprar, 
 * se corresponde con la tabla Item de la Base de Datos. Será manejado por la clase ModeloItem
 * 
 * @author Gerard Herrera Sague
 * @author Paul Morrison Aguiar
 * @author Jesús Pérez Melero
 * @author Carmen María Candal alonso
 */
    class Item{
        private $id;
        private $id_categoria;
        private $id_nombre;
        private $descripcion;
        private $precio;
        private $color;
        private $talla;

        
        function getId(){
            return $this->id;
        }
        function setId($_id){
            $this->id =$_id;
        }
        function getId_categoria(){
            return $this->id_categoria;
        }
        function setId_categoria($_id_categoria){
            $this->id_categoria =$_id_categoria;
        }
        function getNombre(){
            return $this->nombre;
        }
        function setNombre($_nombre){
            $this->nombre =$_nombre;
        }
        function getDescripcion(){
            return $this->descripcion;
        }
        function setDescripcion($_descripcion){
            $this->descripcion =$_descripcion;
        }
        function getPrecio(){
            return $this->precio;
        }
        function setPrecio($_precio){
            $this->precio =$_precio;
        }
        function getColor(){
            return $this->color;
        }
        function setColor($_color){
            $this->color =$_color;
        }
        function getTalla(){
            return $this->talla;
        }
        function setTalla($_talla){
            $this->talla =$_talla;
        }
    } 
?>