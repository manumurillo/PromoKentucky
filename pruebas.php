<?php
error_reporting(E_ALL);
include_once ("assets/AccesoDatosLoc.php");

$oAccesoDatos = new AccesoDatos();
$query = "SELECT tmstmp, descripcion FROM fechas ORDER BY tmstmp DESC";

if ($oAccesoDatos -> conectar()) {
    $result = $oAccesoDatos -> ejecutarConsulta($query);
    $oAccesoDatos -> desconectar();
    if ($result) {
        
        $fecha = $result[0][0];
        $descripcion = $result[0][1];
        echo $descripcion."<br>";
        $now = new DateTime("now");
        $date =new DateTime($fecha);
        $interval = date_diff($date, $now);
        
        $dias = $interval->format('%d');
        
        if($dias<1)
            echo "No puedes votar todavia";
        else
            echo "Es mayor a un dia, por lo tanto, puedes votar.";
        }
    }
    

?>