<?php
class Conexion{

    public $mysql;
    private $host = "localhost";
    private $usuario = "root";
    private $password = "";
    private $bd="tienda";

    public function getConexion(){
        $mysql=new mysqli($this->host, $this->usuario, $this->password, $this->bd);
        if ($mysql->connect_error){
            die("Error de conexión con la Base de Datos (".$mysql->connect_errno.")".$mysql->connect_errno);
        }            
        return $mysql;
    }
    public function close(){
        $mysql->close();
    }
}
?>
