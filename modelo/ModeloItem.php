<?php
require_once ('ModeloBase.php');
class ModeloItem extends ModeloBase{
    const TABLA = "item";
    const OBJ="Item";

    public function __construct(){
        parent::__construct(self::TABLA, self::OBJ);
    }

    public function insertaItem($item){
        // La siguiente consulta devuelve un objeto mysqli_result
        
        if ($result=parent::getLink()->query("INSERT INTO item (id_categoria, id_nombre, descripcion, precio, color, talla) 
        VALUES ('".$item->getId_categoria()."','".$item->getId_nombre()."','".$item->getDescripcion()."','".$item->getPrecio()."','".$item->getColor()."','".$item->getTalla()."')")){          
          
           return $result;

        }else{ 
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }

    public function updateItem($item){
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("UPDATE item 
                                        SET id_categoria='".$item->getId_categoria()."', 
                                        SET id_nombre='".$item->getId_nombre()."', 
                                        SET descripcion='".$item->getDescripcion()."', 
                                        SET precio='".$item->getPrecio()."', 
                                        SET color='".$item->getColor()."', 
                                        SET talla='".$item->getTalla()."'
                                        WHERE id='".$item->getId()."'")){ 
            return $result;

        }else{ 
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }
}
?>