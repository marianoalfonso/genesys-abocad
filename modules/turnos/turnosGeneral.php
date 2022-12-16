
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

    <link rel="stylesheet" href="turnosGeneral.css">

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
        $_SESSION['origenCierreTurno'] = "general";
        // $id_profesional = $_GET['id'];
        // $nombre_profesional = $_GET['nombre'];
    ?>
    <div class="container">
        <h3>gestión general de turnos</h3>
        <h6>se muestran turnos sin cerrar y con fecha igual o mayor a hoy</h6>
    </div>
    <div class="container-error">
        <?php
            if(isset($_SESSION['error'])) { ?>
                <h5><?php echo $_SESSION['error']; ?></h5>
                <?php unset($_SESSION['error']);
            }
        ?>
    </div>


    

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <td>id</td>
                <td>profesional</td>
                <td>paciente</td>
                <!-- <td>fecha/hora inicio</td>
                <td>fecha/hora fin</td> -->
                <td>turno</td>
                <td>cobertura</td>
                <td>tratamiento</td>
                <td>estado</td>
                <td>.</td>
                <td>.</td>
                <!-- <td>.</td> -->
                <td>.</td>
            </tr>
        </thead>
        <tbody>

        <?php
            // $id_profesional = $_GET['id'];
            // $_SESSION['idProfesional'] = $id_profesional;
            $sql = "SELECT
                        eventos.id,
                        profesionales.nombre as profesional,
                        concat(pacientes.apellido,', ',pacientes.nombre) as paciente,
                        concat(date_format(eventos.start, '%d/%m/%Y (%H:%i'),' - ', date_format(eventos.end, '%H:%i)')) as horario,
                        coberturas.nombre as cobertura,tratamientos.descTratamiento as tratamiento,eventos.estado
                    FROM eventos
                    inner join pacientes ON
                        eventos.dni = pacientes.dni
                    inner join profesionales on
                        eventos.profesional = profesionales.id
                    left join coberturas ON
                        eventos.cobertura = coberturas.id
                    inner join tratamientos on
                        eventos.tratamiento = tratamientos.idTratamiento
                    where (date(eventos.start) >= curdate() or eventos.estado = '' or eventos.estado = null)
                    order by start";
            $p = db::conectar()->prepare($sql);
            $p->execute();
            $datos = $p->fetchAll(PDO::FETCH_ASSOC);
            foreach($datos as $row){
                $id = $row['id'];
                $profesional = $row['profesional'];
                $paciente = $row['paciente'];
                $horario = $row['horario'];
                // $start = $row['inicio'];
                // $end = $row['fin'];
                $cobertura = $row['cobertura'];
                $tratamiento = $row['tratamiento'];
                $estado = $row['estado'];
            ?>
                <tr>
                <?php if($estado == 'pre'){ ?>
                    <td><font color="green"><?php echo $id ?></td>
                    <td><font color="green"><?php echo $profesional ?></td>
                    <td><font color="green"><?php echo $paciente ?></td>
                    <td><font color="green"><?php echo $horario ?></td>
                    <!-- <td><font color="green"><?//php echo $start ?></td>
                    <td><font color="green"><?//php echo $end ?></td> -->
                    <td><font color="green"><?php echo $cobertura ?></td>
                    <td><font color="green"><?php echo $tratamiento ?></td>
                    <td><font color="green"><?php echo $estado ?></td>
                <?php } elseif($estado == 'aCa'){ ?>
                    <td><font color="orange"><?php echo $id ?></td>
                    <td><font color="orange"><?php echo $profesional ?></td>
                    <td><font color="orange"><?php echo $paciente ?></td>
                    <td><font color="orange"><?php echo $horario ?></td>
                    <!-- <td><font color="orange"><?//php echo $start ?></td>
                    <td><font color="orange"><?//php echo $end ?></td> -->
                    <td><font color="orange"><?php echo $cobertura ?></td>
                    <td><font color="orange"><?php echo $tratamiento ?></td>
                    <td><font color="orange"><?php echo $estado ?></td>                
                <?php } elseif($estado == 'aSa'){ ?>
                    <td><font color="red"><?php echo $id ?></td>
                    <td><font color="red"><?php echo $profesional ?></td>
                    <td><font color="red"><?php echo $paciente ?></td>
                    <td><font color="red"><?php echo $horario ?></td>
                    <!-- <td><font color="red"><?//php echo $start ?></td>
                    <td><font color="red"><?//php echo $end ?></td> -->
                    <td><font color="red"><?php echo $cobertura ?></td>
                    <td><font color="red"><?php echo $tratamiento ?></td>
                    <td><font color="red"><?php echo $estado ?></td>                     
                <?php } else { ?>
                    <td><?php echo $id ?></td>
                    <td><?php echo $profesional ?></td>
                    <td><?php echo $paciente ?></td>
                    <td><?php echo $horario ?></td>
                    <!-- <td><?//php echo $start ?></td>
                    <td><?//php echo $end ?></td> -->
                    <td><?php echo $cobertura ?></td>
                    <td><?php echo $tratamiento ?></td>
                    <td><?php echo $estado ?></td>                      
                    <?php }?>    
                    <?php
                    if($estado == '') { ?>
                        <td><a href="./turnosClose.php?id=<?php echo $id ?>"><img src="../../assets/icons/cerrar.png" alt="cerrar"></a></td>
                        <td><a href="./turnosEdit.php?id=<?php echo $id ?>"><img src="../../assets/icons/editar.png" alt="modificar"></a></td>
                        <!-- <td><a href="./turnosMultiply.php?id=<?//php echo $id ?>"><img src="../../assets/icons/replicar.png" alt="replicar"></a></td> -->
                        <td><a href="./turnosDelete.php?id=<?php echo $id ?>"><img src="../../assets/icons/borrar.png" alt="borrar"></a></td>
                    <?php } else { ?>
                        <!-- si el turno esta cerrado, no permite hacer nada con el -->
                        <td><a href="#"><img src="../../assets/icons/forbidden.png" alt="cerrar"></a></td>
                        <td><a href="#"><img src="../../assets/icons/forbidden.png" alt="modificar" aria-readonly=""></a></td>
                        <td><a href="#"><img src="../../assets/icons/forbidden.png" alt="borrar"></a></td>
                    <?php } ?>
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