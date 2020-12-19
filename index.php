<?php
// Controlador y acción por defecto 
define("CONTROLADOR_DEFECTO", "ControladorLogin");
define("ACCION_DEFECTO", "login");

session_start();

//Base para los controladores (para cargar las vistas y redireccionar)
require_once 'controlador/ControladorBase.php';
 
// Función que recibe por parámetro el nombre del controlador que se debe cargar
// Devuelve un objeto de ese controlador
function cargarControlador($controlador){
    $strFileController='controlador/'.$controlador.'.php';
     
    if(!is_file($strFileController)){
        $strFileController='controlador/'.$controlador.'.php';
    }
     
    require_once $strFileController;
    $controllerObj=new $controlador();
    return $controllerObj;
}
 
// Función que recibe como parámetro el objeto del controlador y la acción que se quiere llevar a cabo en ese controlador
// Se ejecuta la acción.
function cargarAccion($controllerObj,$_accion){
    $accion=$_accion;
    $controllerObj->$accion();
}
 
// Función que decide qué acción del controlador se va a ejecutar. Si recibe por GET el parámetro acción será ese el que ejecute
function lanzarAccion($controllerObj){
    if(isset($_GET["accion"]) && method_exists($controllerObj, $_GET["accion"])){
        cargarAccion($controllerObj, $_GET["accion"]);
    }else{
        cargarAccion($controllerObj, ACCION_DEFECTO);
    }
}
 
//Cargamos controladores y acciones
//Si llega el parámetro controlador lo cargamos, sino vamos al controlador por defecto
if(isset($_GET["controlador"])){
    $controllerObj=cargarControlador($_GET["controlador"]);
    lanzarAccion($controllerObj);
}else{
    $controllerObj=cargarControlador(CONTROLADOR_DEFECTO);
    lanzarAccion($controllerObj);
}
?>
