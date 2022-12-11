<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" href="../css/datatables.min.css" >
    <link rel="stylesheet" href="../css/bootstrap-clockpicker.css" >
    <link rel="stylesheet" href="../fullcalendar/main.css" > -->

    <!-- bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00FF5573";>
        gestión de turnos
    </nav>

    <?php
        session_start();
        $_SESSION['accion'] = "edit";
        $id = $_GET['id'];
        require_once("../db/dbConnection.php");
        $sql = "select profesional,dni,title,description,start,end,textColor,backgroundColor,cobertura
        from eventos where id = $id limit 1";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        $result = $p->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $profesional = $row['profesional'];
            $dni = $row['dni'];
            $title = $row['title'];
            $description = $row['description'];
            $start = $row['start'];
            $end = $row['end'];
            $cobertura = $row['cobertura'];

        }
    ?>

    <div class="container d-flex justify-content-center">
        <form action="./turnosCrud.php" method="post" style="width: 50vw; min-width: 300px;">
            <div class="row">
                <div class="form-group mb-3">

                    <!-- id OCULTO -->
                    <div class="col">
                        <input type="number" class="form-control" name="id" value="<?php echo $id; ?>" hidden>
                    </div>

                    <!-- profesional OCULTO -->
                    <div class="col">
                        <input type="number" class="form-control" name="profesional" value="<?php echo $profesional; ?>" hidden>
                    </div>

                    <!-- apellido y nombre -->
                    <div class="col">
                        <label class="form-label">nombre</label>
                        <input type="text" class="form-control" name="title" value="<?php echo $title?>" readonly>
                    </div>

                    <!-- dni -->
                    <div class="col">
                        <label class="form-label">dni</label>
                        <input type="number" class="form-control" name="dni" value="<?php echo $dni?>" readonly>
                    </div>

                    <!-- descripcion turno -->
                    <div class="col">
                        <label class="form-label">descripcion</label>
                        <input type="text" class="form-control" name="description" value="<?php echo $description ?>">
                    </div>

                    <!-- turno desde-->
                    <div class="col">
                        <label class="form-label">fecha/hora desde</label>
                        <input type="text" class="form-control" name="turnoDesde" value="<?php echo $start ?>" >
                    </div>

                    <!-- turno hasta-->
                    <div class="col">
                        <label class="form-label">fecha/hora hasta</label>
                        <input type="text" class="form-control" name="turnoHasta" value="<?php echo $end?>" >
                    </div>

                    <!-- en una edicion, muestra el valor correspondiente en el campo select -->
                    <div class="form-row">
                        <!-- cobertura -->
                        <div class="form-group col-md-12">
                            <!-- cargamos el combo con las coberturas -->
                            <label class="form label">cobertura</label>
                            <select name = "cobertura" id="cobertura" class="form-control">
                                <?php
                                    $sql = "select id,nombre from coberturas order by nombre";
                                    $p = db::conectar()->prepare($sql);
                                    $p->execute();
                                    $result = $p->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($result as $row){
                                        // verificamos cual es la opcion que traemos desde la base de datos
                                        // para setearla como SELECTED
                                        if($row['id'] == $cobertura){
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["nombre"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>


                </div>

                <div>
                    <input type="submit" class="btn btn-warning" name="submit" value="modificar"></button>
                    <a href="./turnosProfesional.php?id=<?php echo $profesional ?>" class="btn btn-danger">cancelar</a>
                </div>

            </div>
        </form>
    </div>

    <!-- bootstrap -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>