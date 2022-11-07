<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <div class="col-2">
        <div id="external-events" style="margin-bottom:1em; height:350px; border:1px solid #000; overflow:auto; padding:1em">
            <h4 class="text-center">eventos predefinidos</h4>
            <div id="listaEventosPredefinidos">
                <?php
                require_once('connDB.php');
                $conexion = regresarConexion();
                
                $consulta = "select id,titulo,horaInicio,horaFin,colorTexto,colorFondo from eventospredefinidos";
                $datos = mysqli_query($conexion,$consulta);
                $ep = mysqli_fetch_all($datos, MYSQLI_ASSOC);
                foreach($ep as $fila){
                    echo"<div class='fc-event' data-titulo='$fila[titulo]' data-horaInicio='$fila[horaInicio]' data-horaFin='$fila[horaFin]' data-colorFondo='$fila[colorFondo]' data-colorTexto='$fila[colorTexto]'
                    style='border-color:$fila[colorFondo]; color:$fila[colorTexto]; background-color:$fila[colorFondo]; margin:10px'>
                    $fila[titulo] [" . substr($fila['horaInicio'],0,5) . " a " .substr($fila['horaFin'],0,5) . "]</div>";
                }
                ?>
            </div>
        </div>
        <hr>
        <div class="" style="text-align:center">
            <button type="button" id="botonEventosPredefinidos" class="btn btn-success">
            administrar eventos predefinidos
            </button>
        </div>
    </div>

</body>
</html>