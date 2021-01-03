<?php
require_once ('ModeloBase.php');
// incluimos el modelo
require_once ('modelo/ModeloProduct.php');

class ModeloProduct extends ModeloBase{
    const TABLA = "products";
    const OBJ="Product";
    public function __construct(){
        parent::__construct(self::TABLA, self::OBJ);
    }

    public function insertaProduct($product){
        
        $query = "INSERT INTO `products` (`id`, `nombre`, `descripcion`, `tallas_disponibles`, `colores_disponibles`, `img`) VALUES (NULL, '".$product->getNombre()."', '".$product->getDescripcion()."', '".$product->getTallas()."', '".$product->getColores()."','".$product->getImg()."')";
       
        if ($result=parent::getLink()->query($query)){          
          
           return $result;

        }else{ 
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }

    public function updateProduct($product){
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("UPDATE products 
                                        SET nombre='".$product->getNombre()."', 
                                        SET descripcion='".$product->getDescripcion()."', 
                                        SET tallas_disponibles='".$product->getTallas()."', 
                                        SET colores_disponibles='".$product->getColores()."', 
                                        SET img='".$product->getImg()."'
                                        WHERE id='".$product->getId()."'")){ 
            return $result;

        }else{ 
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }
} 
?>