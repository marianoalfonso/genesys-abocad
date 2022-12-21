<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  

    <link rel="stylesheet" href="seleccionDescarga.css">

</head>
<body>
    
</body>
</html>
<?php

    require_once('../navBar.php');

?>

<div class="container">

    <form action="">
        <div class="titulo">
            <h4>descarga de datos para planillas de asistencia</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="desde">fecha desde</label>
                <input type="date" name="desde">

                <label for="hasta">fecha hasta</label>
                <input type="date" name="hasta">
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="boton">
                <input type="submit" class="btn btn-warning" value="descargar">
            </div>
        </div>
    </form>

</div>