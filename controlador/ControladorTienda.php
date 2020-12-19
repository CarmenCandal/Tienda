<?php
// incluimos el modelo
require_once ('modelo/ModeloItem.php');
// incluimos el modelo
require_once ('modelo/ModeloCategoriaItem.php');


class ControladorTienda extends ControladorBase{
    public $item_modelo;
    public $categoria_item_modelo;

    public function __construct(){
        $this->item_modelo= new ModeloItem(); 
        $this->categoria_item_modelo= new ModeloCategoriaItem(); 
    }
    public function accionXXXXX(){
        print_r($_SESSION);
        //Obtenemos todos los items
        if (($result=$this->categoria_item_modelo->readAll())!=null)
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