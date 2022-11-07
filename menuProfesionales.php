<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <!-- <a href="verCalendario?p=1">profesional 1</a><br>
    <a href="verCalendario?p=2">profesional 2</a> -->


    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav navbar-right">
    <li class="nav-item">
    <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class='dropdown'>
    <span class='label label-pill count'></span>
        <?php
        $conexion = regresarConexion();
        $query = "SELECT id,nombre FROM profesionales order by nombre"; 
        $res = mysqli_query($conexion, $query);
        while($row = mysqli_fetch_array($res))
            { 
            ?>
            <li><a href="#"><?php echo $row["nombre"] ?></a>
            </li> 
            <?php 
            } 
        ?>     
    </ul>
    </li>
    <li>
    <i class="glyphicon glyphicon-user">
    </i>&nbsp;Contact Us</a>
    </li></ul></div> 

</body>
</html>