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
    <link rel="stylesheet" href="pacientes.css">
    <!-- datatables css basico -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css">  
    <!-- datatables estilo bootstrap -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="pacientes.css">  

</head>
<body>

    <?php require_once('../navBar.php'); ?>


    <div class="container">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <a href="./pacientesAdd.php" class="btn btn-warning" disabled>agregar paciente</a>
                </div>
            </div>

            <div class="error">
                <?php
                    if(isset($_SESSION['error'])) { ?>
                        <h3><?php echo $_SESSION['error']; ?></h3>
                        <?php unset($_SESSION['error']);
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="example" class="table table-striped table-bordered table-condensed" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>id</th>
                            <th>apellido y nombre</th>
                            <th>dni</th>
                            <th>edad</th>
                            <th>reint</th>
                            <th>cobertura</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>       
                        
                    <?php
                        require_once("../db/dbConnection.php");
                        $sql = "select 
                                    id,
                                    concat(apellido, ', ',nombre) as nombre,
                                    dni,
                                    timestampdiff(year,fechaNacimiento,curdate()) AS edad,
                                    case reintegro
                                        when 0 then 'no'
                                        when 1 then 'si'
                                    end as reint,
                                    tipocobertura.descTipoCobertura as cobertura,
                                    estado
                                    from pacientes
                                        inner join tipocobertura ON
                                        pacientes.tipoCobertura = tipocobertura.idTipoCobertura
                                    order by apellido,nombre";
                        $resultado = db::conectar()->prepare($sql);
                        $resultado->execute();        
                        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                        foreach($data as $row) {
                            $estado = $row['estado'];
                    ?>
                            <!-- id -->
                            <?php if($estado==1) { ?>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['dni']; ?></td>
                                <td><?php echo $row['edad']; ?></td>
                                <td><?php echo $row['reint']; ?></td>
                                <td><?php echo $row['cobertura']; ?></td>

                            <?php } else { ?>
                                <td><font color="red"><?php echo $row['id']; ?></td>
                                <td><font color="red"><?php echo $row['nombre']; ?></td>
                                <td><font color="red"><?php echo $row['dni']; ?></td>
                                <td><font color="red"><?php echo $row['edad']; ?></td>
                                <td><font color="red"><?php echo $row['reint']; ?></td>
                                <td><font color="red"><?php echo $row['cobertura']; ?></td>
                            <?php }?>
                            <!-- botones -->
                            <td><a href="./pacientesHistory.php?dni=<?php echo $row['dni'] ?>&nombre=<?php echo $row['nombre']; ?>"><img src="../../assets/icons/history.png" alt="historial"></a></td>
                            <td><a href="./pacientesEdit.php?id=<?php echo $row['id'] ?>"><img src="../../assets/icons/editar.png" alt="editar"></a></td>
                            <td><a href="./pacientesDelete.php?id=<?php echo $row['id'] ?>"><img src="../../assets/icons/borrar.png" alt="borrar"></a></td>
                        </tr>
                        <?php } ?>

                    </tbody>        
                </table>               
            </div>
            </div>
        </div>  
    </div> 


    <!-- jquery, popper.js, bootstrap.js -->
    <script src="../../assets/jquery/jquery-3.6.1.min.js"></script>
    <script src="../../assets/popper/popper.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables.js -->
    <script type="text/javascript" src="../../assets/datatables/datatables.min.css"></script>
    <script type="text/javascript" src="../../assets/datatables/DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/datatables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- js personalizado -->
    <script type="text/javascript" src="pacientes.js"></script>

    

    <!-- <script src="//code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="../../assets/js/jquery-3.6.1.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->

    <!-- <script type="text/javascript" src="./pacientes.js"></script>   -->
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- <script src="../../assets/bootstrap/js/bootstrap.min.js"></script> -->

    <!-- <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-AR.json'
                }
            } );
        } );
    </script> -->

    
</body>
</html>