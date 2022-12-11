<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./turnos.css">

</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00FF5573";>
        gestión de turnos
    </nav>

    <?php
        session_start();
        $_SESSION['accion'] = "delete";
        $id = $_GET['id'];
        require_once("../db/dbConnection.php");
        $sql = "select profesional,dni,title,description,start,end,estado,cobertura
        from eventos where id = $id limit 1";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        $resultado = $p->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultado as $row){
            $profesional = $row['profesional'];
            $dni = $row['dni'];
            $title = $row['title'];
            $description = $row['description'];
            $cobertura = $row['cobertura'];
            $estado = $row['estado'];
            $turnoDesde =substr($row['start'],0,10)." ( ".substr($row['start'],11,8)." - ".substr($row['end'],11,8);
            $turno = $row['start'];
        }

        $hoy = date('Y-m-d');
        if($estado != '' or $turno < $hoy) {
            echo "<script type='text/javascript'>
                alert('no pueden borrarse turnos ya cerrados o turnos anteriores al dia de hoy');
                window.location.href='./turnosProfesional.php?id=$profesional';
                </script>";
        }


    ?>


    <div class="container caja">

        <div class="container d-flex justify-content-center">
            <form action="./turnosCrud.php" method="post" style="width: 50vw; min-width: 300px;">
                <div class="row">
                    <div class="form-group mb-3">

                        <!-- id -->
                        <div class="col">
                            <input type="number" class="form-control" name="id" value="<?php echo $id; ?>" hidden>
                        </div>

                        <!-- apellido y nombre -->
                        <div class="col">
                            <label class="form-label">apellido</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $title ?>" readonly>
                        </div>

                        <!-- turno desde-->
                        <div class="col">
                            <label class="form-label">turno asignado</label>
                            <input type="text" class="form-control" name="turnoDesde" value="<?php echo $turnoDesde ?> )" readonly>
                        </div>

                    </div>

                    <div>
                        <input type="submit" class="btn btn-warning" name="submit" value="borrar turno"></button>
                        <a href="./turnosProfesional.php?id=<?php echo $profesional ?>" class="btn btn-danger">cancelar</a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- bootstrap -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>