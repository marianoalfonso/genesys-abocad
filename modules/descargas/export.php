<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

        <!-- bootstrap css -->
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

</head>
<body>
    
</body>
</html>
<?php

    require_once('../navBar.php');
    require_once("../../modules/db/dbConnection.php");

    echo 'exportando datos de turnos . . .';

    $tables=array();
    $sql="select 
            eventos.id,
            profesionales.nombre,eventos.dni,eventos.title,eventos.description,eventos.start,eventos.end,
            coberturas.nombre,
            tratamientos.descTratamiento
            from eventos
            inner join profesionales ON
            eventos.profesional = profesionales.id
            inner join coberturas ON
            eventos.cobertura = coberturas.id
            inner join tratamientos ON
            eventos.tratamiento = tratamientos.idTratamiento";
    $d = db::conectar()->prepare($sql);
    $d->execute();
    $resultados = $d->fetchAll(PDO::FETCH_ASSOC);
    if($resultados){
        $fh = fopen('data.txt', 'w');
        foreach($resultados as $resultado) {
            $linea = (string)$resultado;
            fwrite($fh, $linea);
            fwrite($fh, "\t");
        }
        fwrite($fh, "\n");
        fclose($fh);
    }



?>