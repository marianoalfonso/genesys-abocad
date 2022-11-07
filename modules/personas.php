<?php

require("connDB.php");

$conexion = regresarConexion();
$consulta = "select dni,apellido,nombre from personas order by apellido,nombre";
$personas = mysqli_query($conexion,$consulta);


?>