<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <!-- bootstrap css -->
    <!-- <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css"> -->

    <!-- css personalizado -->
    <!-- <link rel="stylesheet" href="./pacientes.css"> -->

    <!-- datatables css basico -->
    <!-- <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css"> -->
    
    <!-- datatables estilo bootstrap -->
    <!-- <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css"> -->






    <!-- version original -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> -->
    <!-- version directa -->
    <!-- <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css"> -->

    <!-- version original -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"> -->
    <!-- version directa -->
    <!-- <link rel="stylesheet" href="../../assets/datatables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css"> -->

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"> -->

    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">   -->

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="./pacientes.css">  



    <!-- bootstrap css -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <!-- css personalizado -->
    <link rel="stylesheet" href="pacientes.css">

    <!-- datatables css basico -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css">
    
    <!-- datatables estilo bootstrap -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css">



</head>
<body>

    <?php require_once('../../index.php'); ?>

    <div class="form-group">
        <br/>
            <a href="./pacientesAdd.php" class="btn btn-warning" disabled>agregar paciente</a>
            <input type="checkbox" name="verActivos" value="si">
        <br/><br/>
    </div>

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="example" class="table table-striped table-bordered table-condensed" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>id</th>
                            <th>apellido</th>
                            <th>nombre</th>                                
                            <th>dni</th>  
                            <th>direccion</th>
                            <th>cobertura</th>
                            <th>socio</th>
                            <th>reint</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>       
                        

                    <?php
                        require_once("../db/dbConnection.php");
                        $sql = "select pacientes.id as id,apellido,pacientes.nombre,dni,direccion,
                            coberturas.nombre as cobertura,c1numero as socio,
                            case reintegro
                                when 0 then 'no'
                                when 1 then 'si'
                            end as reint
                            from pacientes inner join coberturas ON
                            pacientes.cobertura1 = coberturas.id
                            order by apellido,pacientes.nombre";
                        $resultado = db::conectar()->prepare($sql);
                        $resultado->execute();        
                        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                        foreach($data as $row) {
                    ?>
                            <td><font color="red"><?php echo $row['id']; ?></td>
                            <td><?php echo $row['apellido']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['dni']; ?></td>
                            <td><?php echo $row['direccion']; ?></td>
                            <td><?php echo $row['cobertura']; ?></td>
                            <td><?php echo $row['socio']; ?></td>
                            <td><?php echo $row['reint']; ?></td>
                            <!-- botones -->
                            <td><a href="./pacientesEdit.php?id=<?php echo $row['id'] ?>"><img src="../../assets/icons/modificar.png" alt="modificar"></a></td>
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