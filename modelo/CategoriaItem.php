<?php
    class CategoriaItem {
        private $id;
        private $nombre;
        private $descripcion;
        private $colores_disponibles;
        private $tallas_disponibles;
        private $img;

        
        function getId(){
            return $this->id;
        }
        function setId($_id){
            $this->id =$_id;
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
        
        function getColores(){
            return $this->colores_disponibles;
        }
        function setColores($_colores){
            $this->colores_disponibles =$_colores;
        }
        function getTallas(){
            return $this->tallas_disponibles;
        }
        function setTallas($_tallas){
            $this->tallas_disponibles =$_tallas;
        }
        function getImg(){
            return $this->img;
        }
        function setImg($_img){
            $this->img =$_img;
        }
    } 
?>