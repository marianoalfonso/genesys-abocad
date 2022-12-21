<?php
        session_start();
        $_SESSION['action'] = "add";
?>

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

    <title>alta de pacientes</title>

    <!-- css personalizado -->
    <link rel="stylesheet" href="./pacientesAdd.css">

</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00FF5573";>
        alta de pacientes
    </nav>

    <!-- <div class="container">
        <div class="text-center mb-4">
            <h3>agregar nuevo paciente</h3>
            <p class="text-muted">complete los campos para agregar un nuevo paciente</p>
        </div>
    </div> -->

    <div class="container d-flex justify-content-center">
        <form action="./pacientesCrud.php" method="post" style="width: 50vw; min-width: 300px;">
            <div id="add-box" class="col-md-12">
                <div class="row">

                    <!-- estado -->
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label>estado</label> &nbsp;
                                <input type="radio" class="form-check-input" name="estado" id="activo" value="activo" checked>
                                <label for="male" class="form-input-label">activo</label>
                                &nbsp;
                                <input type="radio" class="form-check-input" name="estado" id="inactivo" value="inactivo">
                                <label for="male" class="form-input-label">inactivo</label>
                            </div>
                        </div>
                    </div>

                    <!-- apellido -->
                    <div class="col-md-5">
                        <label class="form-label">apellido</label>
                        <input type="text" class="form-control" name="apellido" placeholder="apellido">
                    </div>
                    <!-- nombre -->
                    <div class="col-md-7">
                        <label class="form-label">nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="nombre">
                    </div>
                </div>
                <div class="row">
                    <!-- dni -->
                    <div class="col-md-6">
                        <label class="form-label">dni</label>
                        <input type="number" class="form-control" name="dni" placeholder="dni">
                    </div>                
                    <!-- fecha de nacimiento -->
                    <div class="col-md-6">
                        <label class="form-label">fecha de nacimiento</label>
                        <?php $dt = new DateTime(); ?>
                        <input type="date" class="form-control" name="fecNac" value="<?php echo $dt->format('Y-m-d') ?>">
                    </div>
                </div>
                <div class="row">
                    <!-- contacto -->
                    <div class="col-md-6">
                        <label class="form-label">contacto familia</label>
                        <textarea name="contacto" class="form-control" id="contacto" placeholder="contacto familia"></textarea>
                    </div>
                    <!-- contacto colegio-->
                    <div class="col-md-6">
                        <label class="form-label">contacto colegio</label>
                        <textarea name="contactoColegio" class="form-control" id="contactoColegio" placeholder="contacto colegio"></textarea>
                    </div>
                </div>

                    <!-- reintegro -->
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label>prestacion por reintegro</label> &nbsp;
                                <input type="radio" class="form-check-input" name="reintegro" id="activo" value="si">
                                <label for="si" class="form-input-label">si</label>
                                &nbsp;
                                <input type="radio" class="form-check-input" name="reintegro" id="inactivo" value="no" checked>
                                <label for="no" class="form-input-label">no</label>
                            </div>
                        </div>
                    </div>

                    <!-- tipo prestacion -->
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label>prestacion discapacidad</label> &nbsp;
                                <input type="radio" class="form-check-input" name="tipoPrestacion" id="discapacidad" value="discapacidad">
                                <label for="si" class="form-input-label">si</label>
                                &nbsp;
                                <input type="radio" class="form-check-input" name="tipoPrestacion" id="discapacidad" value="NO discapacidad" checked>
                                <label for="no" class="form-input-label">no</label>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- boton submit -->
                <div>
                    <br>
                    <button type="submit" class="btn btn-success" name="submit">guardar</button>
                    <a href="./pacientes.php" class="btn btn-danger">cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <!-- bootstrap -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
</body>
</html>