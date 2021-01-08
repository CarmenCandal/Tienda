<?php
require_once('ModeloBase.php');
require_once('Usuario.php');
class ModeloUsuario extends ModeloBase{
    const TABLA = 'usuario';
    const OBJ = 'Usuario';

    public function __construct(){
        parent::__construct(self::TABLA, self::OBJ);
    }
    public function createUsuario($usuario){
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("INSERT INTO usuario (rol, login, pwd, tipo_usuario, email, nombre, apellido1, apellido2, direccion,telefono) 
        VALUES ('$usuario->getId_rol()','$usuario->getLogin()','$usuario->getPwd()','$usuario->getTipo()','$usuario->getEmail()','$usuario->getNombre()','$usuario->getApellido1()','$usuario->getApellido2()','$usuario->getDireccion()','$usuario->getTelefono()')")){          
          
           return $result;

        }else{ 
            echo "Error: " . $result . "<br>" . mysqli_error(parent::link);
        }
    }
    public function updateUsuario($usuario){
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("UPDATE usuario 
                                        SET rol='$usuario->getId_rol()', 
                                        SET login='$usuario->getLogin()', 
                                        SET pwd='$usuario->getPwd()', 
                                        SET tipo_usuario='$usuario->getTipo()', 
                                        SET email='$usuario->getEmail()', 
                                        SET nombre='$usuario->getNombre()', 
                                        SET apellido1='$usuario->getApellido1()', 
                                        SET apellido2='$usuario->getApellido2()', 
                                        SET direccion='$usuario->getDireccion()',
                                        SET telefono='$usuario->getTelefono()'
                                        WHERE id='$usuario->getId()'")){ 
            return $result;

        }else{ 
            echo "Error: " . $result . "<br>" . mysqli_error(parent::getLink());
        }
    }
    public function validaUsuario($user,$pwd){
        
        // La siguiente consulta devuelve un objeto mysqli_result
        if ($result=parent::getLink()->query("SELECT * FROM usuario WHERE login='$user' AND pwd='$pwd'")){
            // Devolvemos la lista de objetos que cumplen con la condición
            while($row = $result->fetch_object(self::OBJ)) {  
                return $row;
            }            
            
        }else{
            return null;
        }
    }
}
   
    
?>