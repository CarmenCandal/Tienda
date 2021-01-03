<?php
// incluimos el modelo
require_once ('modelo/ModeloItem.php');
// incluimos el modelo
require_once ('modelo/ModeloProduct.php');


class ControladorAdmin extends ControladorBase{
    public $item_modelo;
    public $products_modelo;

    public function __construct(){
        $this->item_modelo= new ModeloItem(); 
        $this->products_modelo= new ModeloProduct(); 
    }
    public function delete($id){
        print_r($_SESSION);
        //Obtenemos todos los items
        if (($resultDelete=$this->products_modelo->deleteById($id))!=null)
        {       
            // Se ha eliminado correctamente, volvemos a consultar
            if (($result=$this->products_modelo->readAll())!=null)
            {       // incluimos la vista        
               // incluimos la vista  
               $strResult ="Eliminado";
               require('vista/VistaAdmin.php');               
            }                  
        }                           
        else{
            echo "No hay resultados";
        }
    }
    public function subir(){
        $product = new Product();
        $product->setNombre($_POST["nombre"]);
        $product->setDescripcion($_POST["descripcion"]);
        $product->setTallas(json_encode($_POST["tallasnum"]));
        $product->setImg(addslashes($_POST['image']));
        $product->setColores(json_encode($_POST["colores"]));

        
        if (($resultInsertion=$this->products_modelo->insertaProduct($product))!=null) {
            // incluimos la vista  
            if (($result=$this->products_modelo->readAll())!=null)
            {       // incluimos la vista        
                // incluimos la vista  
                $strResult ="Producto creado";
                require('vista/VistaAdmin.php');               
            }     
        } 
    
    }

    public function consulta(){
        //Obtenemos todos los items
        if (($result=$this->products_modelo->readAll())!=null)
        {       // incluimos la vista        
                require('vista/VistaAdmin.php');
        }                           
        else{
            echo "No hay resultados";
        }
    
    }
}

?>