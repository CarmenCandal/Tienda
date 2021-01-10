<?php
/**
 * Controlador para el manejo de la pantalla de generación y administración de productos
 *
 * Clase php que hereda de ControladorBase añadiendo funcionalidad concreta para el manejo de la generación de categorías de producto
 * Recibe los eventos que se producen en la vista de administración, los gestiona y realiza las peticiones correspondientes 
 * a los modelos de producto y de item.
 * 
 * @author Gerard Herrera Sague
 * @author Paul Morrison Aguiar
 * @author Jesús Pérez Melero
 * @author Carmen María Candal alonso
*/
// incluimos el modelo
require_once('modelo/ModeloItem.php');
// incluimos el modelo
require_once('modelo/ModeloProduct.php');


class ControladorAdmin extends ControladorBase{
    public $item_modelo;
    public $products_modelo;

    public function __construct(){
        $this->item_modelo= new ModeloItem(); 
        $this->products_modelo= new ModeloProduct(); 
    }

    // Función para la eliminación de una categoría de producto
    // id: Identificador de la categoría de producto que se quiere eliminar.
    // Como resultado se recargará la vista de administración con la nueva lista de productos modificada.
    public function delete($id){
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
   
    // Función para la creación de una categoría de producto
    // Como resultado se recargará la vista de administración con la nueva lista de productos modificada.
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

    // Función para la consulta de todas las categorías de producto
    // Como resultado se recargará la vista de administración con la lista de productos.
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