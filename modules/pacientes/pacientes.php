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
    <link rel="stylesheet" href="./pacientes.css">

    <!-- datatables css basico -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css">
    
    <!-- datatables estilo bootstrap -->
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css">

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

</head>
<body>

    <?php require_once('../../index.php'); ?>

    <div class="form-group">
        <br/>
            <a href="./pacientesAdd.php" class="btn btn-warning" disabled>agregar paciente</a>
        <br/><br/>
    </div>

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed" style="width:100%" >
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
                            <th>acciones</th>
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
                            <td><a href="modulos/turnoCerrar.php?id=<?php echo $row['id'] ?>"><img src="../../assets/icons/cerrar.png" alt="cerrar"></a></td>
                            <td><a href="modulos/turnoModificar.php?id=<?php echo $row['id'] ?>"><img src="../../assets/icons/modificar.png" alt="modificar"></a></td>
                            <td><a href="modulos/turnoReplicar.php?replicar=<?php echo $row['id'] ?>"><img src="../../assets/icons/replicar.png" alt="replicar"></a></td>
                            <td><a href="modulos/turnoBorrar.php?id=<?php echo $row['id'] ?>"><img src="../../assets/icons/borrar.png" alt="borrar"></a></td>
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
    

    <!-- <script src="//code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="../../assets/js/jquery-3.6.1.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->

    <!-- <script type="text/javascript" src="./pacientes.js"></script>   -->
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- <script src="../../assets/bootstrap/js/bootstrap.min.js"></script> -->

    <script>
        $(document).ready(function() {
            $('#tablaUsuarios').DataTable( {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-AR.json'
                }
            } );
        } );
    </script>

    <!-- <script>
        $(document).ready(function() {
        var user_id, opcion;
        opcion = 4;

        tablaUsuarios = $('#tablaUsuarios').DataTable({  
            "ajax":{            
                "url": "pacientesCrudDT.php", 
                "method": 'POST', //usamos el metodo POST
                "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
                "dataSrc":""
            },
            "columns":[
                {"data": "id"},
                {"data": "apellido"},
                {"data": "nombre"},
                {"data": "dni"},
                {"data": "direccion"},
                {"data": "cobertura"},
                {"data": "socio"},
                {"data": "reint"},
                {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
                
            ]
        });  

        // captura el boton EDITAR del datatable
        $(document).on("click", ".btnEditar", function(){		        
            opcion = 2;//editar
            fila = $(this).closest("tr");
            id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
            const url = "pacientesEdit.php?id=" + encodeURIComponent(id);
            window.location.href = url;
        });

        // captura el boton BORRAR del datatable
        $(document).on("click", ".btnBorrar", function(){		        
            opcion = 3;//editar
            fila = $(this).closest("tr");
            id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
            var respuesta = confirm("¿Está seguro de borrar el paciente seleccionado ?");                
                if (respuesta) { 
                    const url = "pacientesDelete.php?id=" + encodeURIComponent(id);
                    window.location.href = url;
                }
        });

        // formato modal (evualuar para el futuro)
        var fila; //captura la fila, para editar o eliminar
        //submit para el Alta y Actualización
        $('#formPersona').submit(function(e){                         
            e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
            apellido = $.trim($('#apellido').val());    
            nombre = $.trim($('#nombre').val());
            dni = $.trim($('#dni').val());
            direccion = $.trim($('#direccion').val());
                $.ajax({
                url: "crud.php",
                type: "POST",
                datatype:"json",    
                data:  {apellido:apellido, nombre:nombre, dni:dni, direccion:direccion, opcion:opcion},    
                success: function(data) {
                    // tablaPersonas.ajax.reload(null, false);
                }
                });			        
            $('#modalCRUD').modal('hide');											     			
        });

        //para limpiar los campos antes de dar de Alta una Persona
        $("#btnNuevo").click(function(){
            opcion = 1; //alta           
            user_id=null;
            $("#formUsuarios").trigger("reset");
            $(".modal-header").css( "background-color", "#17a2b8");
            $(".modal-header").css( "color", "white" );
            $(".modal-title").text("alta de paciente");
            $('#modalCRUD').modal('show');	    
        });

    });
    </script> -->
    
</body>
</html>