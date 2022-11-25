<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> -->

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>alta de personas</title>

    <link rel="stylesheet" href="./pacientesAdd.css">

</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00FF5573";>
        borrar paciente
    </nav>

    <!-- obtenemos los datos del paciente a editar en base al id recibido por parametro -->
    <?php
        session_start();
        $_SESSION['action'] = "delete";
        require_once('../db/connDB.php');
        $conexion = regresarConexion();

        $id = $_GET['id'];
        $consulta = "select * from pacientes where id = $id limit 1";
        $result = mysqli_query($conexion, $consulta);
        $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
        <form action="pacientesCrud.php" id="pacientesDelete" method="post" style="width: 50vw; min-width: 300px;">
            <div id="add-box" class="col-md-6">
                    <!-- id -->
                    <div class="col-md-5">
                        <label class="form-label">id</label>
                        <input type="numeric" class="form-control" name="id" value="<?php echo $id ?>" readonly>
                    </div>
                    <div class="row">
                        <!-- apellido -->
                        <div class="col-md-5">
                            <label class="form-label">apellido</label>
                            <input type="text" class="form-control" name="apellido" value="<?php echo $row['apellido']?>" disabled>
                        </div>
                        <!-- nombre -->
                        <div class="col-md-7">
                            <label class="form-label">nombre</label>
                            <input type="text" class="form-control" name="nombre" value="<?php echo $row['nombre']?>" disabled>
                        </div>
                    </div>
                    <!-- dni -->
                    <div class="col-md-5">
                        <label class="form-label">dni</label>
                        <input type="number" class="form-control" name="dni" value="<?php echo $row['dni']?>" disabled>
                    </div>                
                <!-- boton submit -->
                <div>
                    <br>
                    <button type="submit" class="btn btn-success" name="submit">borrar</button>
                    <a href="pacientes.php" class="btn btn-danger">cancelar</a>
                </div>
            </div>

            <script type="text/javascript">
                (function() {
                    var form = document.getElementById('pacientesDelete');
                    form.addEventListener('submit', function(event) {
                    // si es false entonces que no haga el submit
                    if (!confirm('Realmente desea eliminar el paciente seleccionado?')) {
                        event.preventDefault();
                    }
                    }, false);
                })();
            </script>

        </form>
    </div>

    <!-- bootstrap -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
</body>
</html>