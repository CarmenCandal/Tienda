<?php
    class Pedido{
        private $id;
        private $id_usuario;
        private $fecha;
        private $total;
        private $estado;
        
        function getId(){
            return $this->id;
        }
        function setId($_id){
            $this->id =$_id;
        }

        function getId_usuario(){
            return $this->id_usuario;
        }
        function setId_usuario($_id_usuario){
            $this->id_usuario =$_id_usuario;
        }
        function getFecha(){
            return $this->fecha;
        }
        function setFecha($_fecha){
            $this->fecha =$_fecha;
        }
        function getTotal(){
            return $this->total;
        }
        function setTotal($_total){
            $this->total =$_total;
        }
        function getEstado(){
            return $this->estado;
        }
        function setEstado($_estado){
            $this->estado =$_estado;
        }
    } 
?>