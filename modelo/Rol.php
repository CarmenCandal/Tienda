<?php
/**
 * Página php con la clase Rol
 * 
 * Estructura del perfil de usuario o Rol, se corresponde con la tabla Rol de la Base de Datos. Será manejado por la clase ModeloUsuario
 * 
 * @author Gerard Herrera Sague
 * @author Paul Morrison Aguiar
 * @author Jesús Pérez Melero
 * @author Carmen María Candal alonso
 */
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