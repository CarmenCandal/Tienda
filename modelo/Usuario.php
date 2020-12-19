<?php
    class Usuario{
        private $id;
        private $id_rol;
        private $login;
        private $pwd;
        private $tipo_usuario;
        private $email;
        private $nombre;
        private $apellido1;
        private $apellido2;
        private $direccion;
        private $telefono;

        function getId(){
            return $this->id;
        }
        function setId($_id){
            $this->id =$_id;
        }
        function getRol(){
            return $this->id_rol;
        }
        function setRol($_rol){
            $this->id_rol =$_rol;
        }
        function getLogin(){
            return $this->login;
        }
        function setLogin($_login){
            $this->login =$_login;
        }
        function getPwd(){
            return $this->pwd;
        }
        function setPwd($_pwd){
            $this->pwd =$_pwd;
        }
        function getTipo(){
            return $this->tipo_usuario;
        }
        function setTipo($_tipo){
            $this->tipo_usuario =$_tipo;
        }
        function getEmail(){
            return $this->email;
        }
        function setEmail($_email){
            $this->email =$_email;
        }
        function getNombre(){
            return $this->nombre;
        }
        function setNombre($_nombre){
            $this->nombre =$_nombre;
        }
        function getApellido1(){
            return $this->apellido1;
        }
        function setApellido1($_apellido1){
            $this->apellido1 =$_apellido1;
        }
        function getApellido2(){
            return $this->apellido2;
        }
        function setApellido2($_apellido2){
            $this->apellido2 =$_apellido2;
        }
        function getDireccion(){
            return $this->direccion;
        }
        function setDireccion($_direccion){
            $this->direccion =$_direccion;
        }
        function getTelefono(){
            return $this->telefono;
        }
        function setTelefono($_telefono){
            $this->telefono =$_telefono;
        }


    }
?>