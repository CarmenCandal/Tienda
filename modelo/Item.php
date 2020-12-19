<?php
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