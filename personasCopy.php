<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">


    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="personas.css">  




</head>
<body>

    <?php require("connDB.php"); ?>
    <?php include 'assets/header.php' ?>
    <?php include 'persona.php' ?>


    <div class="form-group">
        <br/>
        <!-- <input type="submit" id="btn_inser" name="insert" class="btn btn-warning" value="agregar paciente"> -->
            <!-- <button type="button" id="btn_inser" class="btn btn-warning" onclick="cargarPersona()">agregar pInfo.456.ANDISaciente</button> -->


            <button id="btnNuevo" type="button" class="btn btn-warning" data-toggle="modal">agregar paciente</button>    
        <br/><br/>
    </div>



    <table id="datatablePersonas" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <td>id</td>
                <td>apellido</td>
                <td>nombre</td>
                <td>dni</td>
                <td>direccion</td>
                <td>cobertura 1</td>
                <td>socio 1</td>

                <td>accion</td>
            </tr>
        </thead>
        <tbody>

        <?php
            // require("connDB.php");
            $sql = "select personas.id,apellido,personas.nombre,dni,direccion,coberturas.nombre as cobertura,c1numero 
                        from personas inner join coberturas ON
                        personas.cobertura1 = coberturas.id
                        order by apellido,personas.nombre";
            $conexion = regresarConexion();
            $respuesta = mysqli_query($conexion,$sql);
            $i = 0;
            while($fila = mysqli_fetch_array($respuesta)) {
                $id = $fila['id'];
                $apellido = $fila['apellido'];
                $nombre = $fila['nombre'];
                $dni = $fila['dni'];
                $direccion = $fila['direccion'];
                $cobertura = $fila['cobertura'];
                $c1numero = $fila['c1numero'];
                $i++; ?>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $apellido ?></td>
                <td><?php echo $nombre ?></td>
                <td><?php echo $dni ?></td>
                <td><?php echo $direccion ?></td>
                <td><?php echo $cobertura ?></td>
                <td><?php echo $c1numero ?></td>
                <td><a href="pacientes.php?borrar=<?php echo $id ?>">borrar</a></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>

    
    <script src="//code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="personas.js"></script>  
    <script>
        // $(document).ready(function () {
        //     $('#example').DataTable();
        // });

        $(document).ready(function() {
            $('#datatablePersonas').DataTable( {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-AR.json'
                }
            } );
        } );



    </script>



    
</body>
</html>