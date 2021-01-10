<?php
/**
 * Controlador para el manejo del login
 *
 * Clase php que hereda de ControladorBase añadiendo funcionalidad concreta para el manejo del acceso a la aplicación
 * Recibe los eventos que se producen en la vista de login, los gestiona y realiza las peticiones correspondientes 
 * al modelo de usuario según la acción solicitada
 * 
 * @author Gerard Herrera Sague
 * @author Paul Morrison Aguiar
 * @author Jesús Pérez Melero
 * @author Carmen María Candal alonso
*/

// incluimos el modelo
require_once('modelo/ModeloUsuario.php');

class ControladorLogin extends ControladorBase{
    public $user_model;

    public function __construct(){
        $this->user_model= new ModeloUsuario(); 
    }

    //Operación por defecto, carga la vista de login sin pasar argumentos
    public function login(){
        // incluimos la vista        
        require('vista/VistaLogin.php');
    }


    //Operación de validación de usuario, recibe por POST el usuario y la contraseña
    // Si se valida correctamente pasa el control a la vista de tienda.
    // Si no se valida, se pasa a la vista de login.
    public function valida(){
        $login = $_POST['login'];
        $pwd = $_POST['pwd'];
        
        
        if (isset($login) && $login != '' && isset($pwd) && $pwd != '')
        {   
            //Validamos el usuario
            if (($result=$this->user_model->validaUsuario($login, $pwd))!=null)
            {   
                unset($_SESSION['user']);
                unset($_SESSION['rol']);                
                $_SESSION['user'] = $login;
                $_SESSION['rol'] = $result->getRol();
                $_SESSION['userId'] = $result->getId();
                session_write_close();
                $this->redirect("ControladorTienda", "mostrarItems");
               
            }                           
            else{
                unset($_SESSION['user']);
                unset($_SESSION['rol']);
                unset($_SESSION['userId']);
                $this->view("VistaLogin",array(
                    "error"=>"Usuario o contraseña errónea"
                ));
            }
        }
        else
        {
            unset($_SESSION['user']);
            unset($_SESSION['rol']);
            unset($_SESSION['userId']);
            $this->view("VistaLogin",array(
                "error"=>"Error en conexión. Inténtelo más tarde"
            ));   
        }
    }
}

?>