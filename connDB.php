<?php

function regresarConexion(){
    $server = "localhost";
    $usr = "root";
    $pwd = "";
    $db = "appointmentsManager";
    $conexion = mysqli_connect($server,$usr,$pwd,$db) or die ('problemas con la conexion a la DB');
    mysqli_set_charset($conexion, 'utf8');
    return $conexion;
}

?>