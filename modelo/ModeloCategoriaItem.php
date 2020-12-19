<?php
require_once ('ModeloBase.php');
class ModeloCategoriaItem extends ModeloBase{
    const TABLA = "categoria_item";
    const OBJ="CategoriaItem";
    public function __construct(){
        parent::__construct(self::TABLA, self::OBJ);
    }
} 
?>