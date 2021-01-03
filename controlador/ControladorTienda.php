<?php
// incluimos el modelo
require_once ('modelo/ModeloItem.php');
// incluimos el modelo
require_once ('modelo/ModeloProduct.php');


class ControladorTienda extends ControladorBase{
    public $item_modelo;
    public $product_modelo;

    public function __construct(){
        $this->item_modelo= new ModeloItem(); 
        $this->product_modelo= new ModeloProduct(); 
    }
    public function accionXXXXX(){
        print_r($_SESSION);
        //Obtenemos todos los items
        if (($result=$this->product_modelo->readAll())!=null)
        {       // incluimos la vista        
                require('vista/VistaTienda.php');
        }                           
        else{
            echo "No hay resultados";
        }
    
    }
    public function add($id_categoria){
        
    
    }
}

?>