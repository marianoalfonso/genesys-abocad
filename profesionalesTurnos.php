
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="personas.css">  

</head>
<body>
    <?php session_start() ?>
    <?php include 'assets/header.php' ?>
    <?php include 'turno.php' ?>
    <?php include 'estadoTurno.php' ?>

    <div class="form-group">
        <br/>
            <a href="#modalEstadoTurnos" class="btn btn-warning" data-toggle="modal">cerrar</a>
        <br/><br/>
    </div>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <td>id</td>
                <td>apellido</td>
                <td>nombre</td>
                <td>fecha/hora inicio</td>
                <td>fecha/hora fin</td>
                <td>cobertura</td>
                <td>n_socio</td>
                <td>estado</td>
                <td>.</td>
                <td>.</td>
                <td>.</td>
                <td>.</td>
            </tr>
        </thead>
        <tbody>

        <?php
            require("connDB.php");
            $id_profesional = $_GET['p'];
            $_SESSION['idProfesional'] = $id_profesional;
            $sql = "SELECT
            eventos.id,personas.apellido,personas.nombre,eventos.start as inicio,eventos.end as fin,
            coberturas.nombre as cobertura,personas.c1numero as n_socio, eventos.estado
                FROM eventos
                inner join personas ON
                eventos.dni = personas.dni
                left join coberturas ON
                personas.cobertura1 = coberturas.id
            where profesional = '$id_profesional' order by start";
            $conexion = regresarConexion();
            $respuesta = mysqli_query($conexion,$sql);
            $i = 0;
            while($fila = mysqli_fetch_array($respuesta)) {
                $id = $fila['id'];
                $apellido = $fila['apellido'];
                $nombre = $fila['nombre'];
                $start = $fila['inicio'];
                $end = $fila['fin'];
                $cobertura = $fila['cobertura'];
                $n_socio = $fila['n_socio'];
                $estado = $fila['estado'];
                $i++; ?>
            <tr>
                <td><font color="red"><?php echo $id ?></td>
                <td><?php echo $apellido ?></td>
                <td><?php echo $nombre ?></td>
                <td><?php echo $start ?></td>
                <td><?php echo $end ?></td>
                <td><?php echo $cobertura ?></td>
                <td><?php echo $n_socio ?></td>
                <td><?php echo $estado ?></td>

                <!-- <td><button id="btnCerrarTurno" type="button" class="btn btn-warning" data-toggle="modal">cerrar</button></td>  -->

                <td><a href="modulos/turnoCerrar.php?id=<?php echo $id ?>"><img src="assets/icons/cerrar.png" alt="cerrar"></a></td>
                <td><a href="modulos/turnoModificar.php?id=<?php echo $id ?>"><img src="assets/icons/modificar.png" alt="modificar"></a></td>
                <td><a href="modulos/turnoReplicar.php?replicar=<?php echo $id ?>"><img src="assets/icons/replicar.png" alt="replicar"></a></td>
                <td><a href="modulos/turnoBorrar.php?id=<?php echo $id ?>"><img src="assets/icons/borrar.png" alt="borrar"></a></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>


    <script src="//code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="turnos.js"></script>  
    <script>
        // $(document).ready(function () {
        //     $('#example').DataTable();
        // });

        $(document).ready(function() {
            $('#example').DataTable( {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-AR.json'
                }
            } );
        } );
    </script>

    <script>
        $(document).ready(function(){
        $("#btnCerrarTurno").click(function(){
            $("#modalEstadoTurnos").modal('show');
        });
        });
    </script>

</body>
</html>