<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profesionales</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
    <?php require_once('../../index.php'); ?>

    <?php require_once('../db/dbConnection.php'); ?>
    <br>
        <label for="">seleccione profesional</label>
        <p>
            <div class="col-lg-3">
                <select id="codigoProfesional" class="form-control">
                    <?php
                        $sql = "select id,nombre from profesionales";
                        $p = db::conectar()->prepare($sql);
                        $p->execute();
                        $datos = $p->fetchAll(PDO::FETCH_ASSOC);
                        foreach($datos as $row) {
                            echo '<option value="'.$row["id"].'">'.$row["nombre"].'</option>';
                        }
                    ?>
                </select>
            </div>
        </p>
        <div class="container">
            <p>
                <button type="button" id="cargarAgenda" class="btn btn-warning float-left" onclick="cargarAgenda()">ver agenda</button>
                <button type="button" id="listarTurnos" class="btn btn-warning float-left" onclick="listarTurnos()">listar turnos</button>
            </p>
        </div>
    <script>
        //en el click se dispara esta function
        //obtiene el idProfesional y arma la url con el parametro $_GET
        function cargarAgenda(){
            var e = document.getElementById("codigoProfesional");
            var value=e.options[e.selectedIndex].value;// get selected option value
            var text=e.options[e.selectedIndex].text;
            // alert("codigo: " + value + " / texto: " + text);
            const url = "../turnos/calendario.php?p=" + encodeURIComponent(value);
            window.location.href = url;
        }

        function listarTurnos(){
            var e = document.getElementById("codigoProfesional");
            var value=e.options[e.selectedIndex].value;// get selected option value
            var text=e.options[e.selectedIndex].text;
            // alert("codigo: " + value + " / texto: " + text);
            const url = "profesionalesTurnos.php?p=" + encodeURIComponent(value);
            window.location.href = url;
        }
    </script>
</body>
</html>