<?php
// incluimos el modelo
require_once ('modelo/ModeloUsuario.php');

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
                //echo "Obtenemos un resultado".var_dump($result);
                //echo "Obtenemos un resultado".$result->getRol();                
                $_SESSION['user'] = $login;
                $_SESSION['rol'] = $result->getRol();
                session_write_close();
                $this->redirect("ControladorTienda", "accionXXXXX");
               
            }                           
            else{
                unset($_SESSION['user']);
                unset($_SESSION['rol']);
                $this->view("VistaLogin",array(
                    "error"=>"Usuario o contraseña errónea"
                ));
            }
        }
        else
        {
            unset($_SESSION['user']);
            unset($_SESSION['rol']);
            $this->view("VistaLogin",array(
                "error"=>"Error en conexión. Inténtelo más tarde"
            ));   
        }
    }
}

?>