<?php
    class Rol{
        private $id;
        private $nombre;
        private $privilegios;
      
        
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
       function getPrivilegios(){
            return $this->privilegios;
        }
        function setPrivilegios($_privilegios){
            $this->privilegios =$_privilegios;
        }
      
    } 
?>