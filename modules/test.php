<?php
// require_once("db/dbConnection.php");
require_once("../assets/clases/profesional.php");

echo 'testeando la clase profesional';
echo '<br>nombre del profesional: ';
echo profesional::obtenerNombreProfesional(2);
?>