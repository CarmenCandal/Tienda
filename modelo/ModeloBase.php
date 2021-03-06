<?php
/**
 * Clase de la que heredan el resto de modelos
 *
 * Se realiza la conexión y se especifican aquellas funciones que son genéricas a todas las tablas, como son la lectura o el borrado.
 * El constructor recibe como parámetros la tabla y el objeto en el que se cargarán los elementos de la tabla. De esta forma podemos 
 * hacer uso de la función fetch_object para que el resultado se devuelva ya parseado al objeto correspondiente. 
 * 
 * @author Gerard Herrera Sague
 * @author Paul Morrison Aguiar
 * @author Jesús Pérez Melero
 * @author Carmen María Candal alonso
*/
require_once('bd/conexion.php');
require_once('Product.php');
require_once('Item.php');
require_once('ItemsPedido.php');
require_once('Pedido.php');
require_once('Rol.php');
require_once('Usuario.php');

class ModeloBase{
    private $conexion;
    private $tabla;
    private $link;
    private $obj;
    
    public function __construct($_tabla, $_obj){
        $this->tabla = $_tabla;
        $this->obj=$_obj;
        $this->conexion = new Conexion();
        $this->link = $this->conexion->getConexion();
        
    }

    public function getLink(){
        return $this->link;
    }
    public function readAll(){
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=$this->link->query("SELECT * FROM $this->tabla ORDER BY id DESC")){          
            //Devolvemos un array de objetos
            while ($row = $result->fetch_object($this->obj)) {
            $resultSet[]=$row;
            }         
            return $resultSet;
        }
    }
    public function readById($id){
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=$this->link->query("SELECT * FROM $this->tabla WHERE id=$id")){
            // Obtenemos el objeto correspondiente (usuario, item, rol...)
            return $result->fetch_object($this->obj);
        }
    }
    public function readBy($column,$value){
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=$this->link->query("SELECT * FROM $this->tabla WHERE $column='$value'")){
            // Devolvemos la lista de objetos que cumplen con la condición
            while($row = $result->fetch_object($this->obj)) {
                $resultSet[]=$row;
            }            
            return $resultSet;
        }
    }     
    public function deleteById($id){
        // devolverá true si la consulta se ha realizado con éxito
        if ($result=$this->link->query("DELETE FROM $this->tabla WHERE id=$id")){
            return $result;
        }
    }     
    public function deleteBy($column,$value){
        // devolverá true si la consulta se ha realizado con éxito
        if ($result=$this->link->query("DELETE FROM $this->tabla WHERE $column='$value'")){            
            return $result;
        }
    }
    public function close(){
        $this->link->close();
    }


}

?>