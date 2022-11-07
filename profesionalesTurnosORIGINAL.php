<style>
    body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    }

    .topnav {
    overflow: hidden;
    background-color: #333;
    }

    .topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
    }

    .topnav a:hover {
    background-color: #ddd;
    color: black;
    }

    .topnav a.active {
    background-color: #04AA6D;
    color: white;
    }
</style>

<div class="topnav">
        <a class="active" href="profesionales.php">inicio</a>
        <a href="pacientes.php">pacientes</a>
        <a href="profesionales.php">agendas</a>
</div>

<?php

require("connDB.php"); ?>

<div id="tablas" class="col-8">
    <table class="table table-bordered table-responsive" border="1">
        <tr>
            <td>id</td>
            <td>apellido</td>
            <td>nombre</td>
        </tr>
        <?php
            $id_profesional = $_GET['p'];
            $sql = "select id,start,end,title,description from eventos where profesional = '$id_profesional' order by start";
            $conexion = regresarConexion();
            $respuesta = mysqli_query($conexion,$sql);
            $i = 0;
            while($fila = mysqli_fetch_array($respuesta)) {
                $id = $fila['id'];
                $start = $fila['start'];
                $end = $fila['end'];
                $title = $fila['title'];
                $description = $fila['description'];
                $i++;
            ?>
            <tr align="center">
                <td><?php echo $id ?></td>
                <td><?php echo $start ?></td>
                <td><?php echo $end ?></td>
                <td><?php echo $title ?></td>
                <td><?php echo $description ?></td>
                <td><a href="pacientes.php?borrar=<?php echo $id ?>">borrar</a></td>
            </tr>
        <?php } ?>
    </table>
</div>
