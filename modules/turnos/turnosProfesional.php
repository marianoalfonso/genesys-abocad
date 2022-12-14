
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <!-- css personalizado -->
    <link rel="stylesheet" href="./turnosProfesional.css">

    <!-- datatables css basico -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css">
    
    <!-- datatables estilo bootstrap -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  

</head>
<body>

    <?php require_once('../navBar.php'); ?>
    <?php require_once("../db/dbConnection.php"); ?>

    <?php
        $id_profesional = $_GET['id'];
        $nombre_profesional = $_GET['nombre'];
    ?>

    <h3>profesional: <?php echo $nombre_profesional ?></h3>
    <!-- <div class="form-group">
        <br/>
            <a href="#modalEstadoTurnos" class="btn btn-warning" data-toggle="modal">cerrar</a>
        <br/><br/>
    </div> -->

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
            // $id_profesional = $_GET['id'];
            $_SESSION['idProfesional'] = $id_profesional;
            $sql = "SELECT
                    eventos.id,pacientes.apellido,pacientes.nombre,eventos.start as inicio,
                    eventos.end as fin,coberturas.nombre as cobertura,pacientes.c1numero as n_socio,eventos.estado
                FROM eventos
                    inner join pacientes ON
                    eventos.dni = pacientes.dni
                    left join coberturas ON
                    pacientes.cobertura1 = coberturas.id
                where profesional = '$id_profesional' order by start";
            $p = db::conectar()->prepare($sql);
            $p->execute();
            $datos = $p->fetchAll(PDO::FETCH_ASSOC);
            foreach($datos as $row){
                $id = $row['id'];
                $apellido = $row['apellido'];
                $nombre = $row['nombre'];
                $start = $row['inicio'];
                $end = $row['fin'];
                $cobertura = $row['cobertura'];
                $n_socio = $row['n_socio'];
                $estado = $row['estado'];
            ?>
                <tr>
                <?php if($estado == 'pre'){ ?>
                    <td><font color="green"><?php echo $id ?></td>
                    <td><font color="green"><?php echo $apellido ?></td>
                    <td><font color="green"><?php echo $nombre ?></td>
                    <td><font color="green"><?php echo $start ?></td>
                    <td><font color="green"><?php echo $end ?></td>
                    <td><font color="green"><?php echo $cobertura ?></td>
                    <td><font color="green"><?php echo $n_socio ?></td>
                    <td><font color="green"><?php echo $estado ?></td>
                <?php } elseif($estado == 'aCa'){ ?>
                    <td><font color="orange"><?php echo $id ?></td>
                    <td><font color="orange"><?php echo $apellido ?></td>
                    <td><font color="orange"><?php echo $nombre ?></td>
                    <td><font color="orange"><?php echo $start ?></td>
                    <td><font color="orange"><?php echo $end ?></td>
                    <td><font color="orange"><?php echo $cobertura ?></td>
                    <td><font color="orange"><?php echo $n_socio ?></td>
                    <td><font color="orange"><?php echo $estado ?></td>                
                <?php } elseif($estado == 'aSa'){ ?>
                    <td><font color="red"><?php echo $id ?></td>
                    <td><font color="red"><?php echo $apellido ?></td>
                    <td><font color="red"><?php echo $nombre ?></td>
                    <td><font color="red"><?php echo $start ?></td>
                    <td><font color="red"><?php echo $end ?></td>
                    <td><font color="red"><?php echo $cobertura ?></td>
                    <td><font color="red"><?php echo $n_socio ?></td>
                    <td><font color="red"><?php echo $estado ?></td>                     
                <?php } else { ?>
                    <td><?php echo $id ?></td>
                    <td><?php echo $apellido ?></td>
                    <td><?php echo $nombre ?></td>
                    <td><?php echo $start ?></td>
                    <td><?php echo $end ?></td>
                    <td><?php echo $cobertura ?></td>
                    <td><?php echo $n_socio ?></td>
                    <td><?php echo $estado ?></td>                      
                    <?php }?>    
                    <td><a href="./turnosClose.php?id=<?php echo $id ?>"><img src="../../assets/icons/cerrar.png" alt="cerrar"></a></td>
                    <td><a href="./turnosEdit.php?id=<?php echo $id ?>"><img src="../../assets/icons/editar.png" alt="modificar"></a></td>
                    <td><a href="./turnosMultiply.php?id=<?php echo $id ?>"><img src="../../assets/icons/replicar.png" alt="replicar"></a></td>
                    <td><a href="./turnosDelete.php?id=<?php echo $id ?>"><img src="../../assets/icons/borrar.png" alt="borrar"></a></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>


    <!-- jquery, popper.js, bootstrap.js -->
    <script src="../../assets/jquery/jquery-3.6.1.min.js"></script>
    <script src="../../assets/popper/popper.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables.js -->
    <script type="text/javascript" src="../../assets/datatables/datatables.min.css"></script>
    <script type="text/javascript" src="../../assets/datatables/DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/datatables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js"></script>
 
    
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