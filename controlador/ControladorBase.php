<?php
    // Clase padre de los controladores donde se definen las funciones comunes
   class ControladorBase{
        public function __construct(){
           //Incluir todos los modelos
            foreach(glob("../modelo/*.php") as $file){
                print $file;
                require_once $file;
            }

        }

        // Se carga la vista pasándole todos los datos que necesite:
        // vista: a la que se quiere navegar
        // datos: información que se quiere pasar a la vista, por ejemplo: "login"=>"carmen", "rol"=>"admin"
        public function view($vista,$datos){
            // Datos del controlador en forma de array
            foreach ($datos as $id_assoc => $valor) {
                ${$id_assoc}=$valor;
            }
         
            require_once 'vista/'.$vista.'.php';
        }
        
         // Redirecciona según el controlador y la acción
         // Si no recibe ese dato usará los definidos como constantes en index.php
         public function redirect($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
            header("Location:index.php?controlador=".$controlador."&accion=".$accion);
        }
    
   }
    

    

?>