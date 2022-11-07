<?php
    session_start();
    $accion = $_SESSION["accion"];
    $idProfesional = $_SESSION['idProfesional'];

    include "../db/connDB.php";
    $conn = regresarConexion();


    switch ($accion) {
        case "cerrar turno":
            echo 'cerrando turno';
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $estado = $_POST['estado'];
                $consulta = "update eventos set estado = '$estado' where id = $id";
                $result = mysqli_query($conn, $consulta);            
                if($result){
                    echo '<script language="javascript">alert("turno cerrado");</script>';
                    header("Location: ../profesionalesTurnos.php?p=$idProfesional");
                } else {
                    echo '<script language="javascript">alert("error cerrando el turno");</script>';
                }
            }
            break;
        case "replicar turno":
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $replicarHasta = "'".$_POST['endDate']."'";
                $consulta = "call mpa_replicarFecha($id, $replicarHasta)";
                $result = mysqli_query($conn, $consulta);
                if($result){
                    echo "<script>alert('OK - redirigiendo);</script>";
                    header("Location: ../profesionalesTurnos.php?p=$idProfesional");
                } else {
                    echo "<script>alert('error replicando los turnos);</script>";
                    // echo ": ".mysqli_error($conn);
                }
            }
            break;
        case "modificar turno":
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $start = $_POST['turnoDesde'];
                $end = $_POST['turnoHasta'];
                $consulta = "UPDATE `eventos` SET
                `title` = '$title', `description` = '$description', `start` = '$start', `end` = '$end'
                WHERE `id` = $id";
                $result = mysqli_query($conn, $consulta);
                if($result){
                    echo "<script>alert('OK - redirigiendo);</script>";
                    header("Location: ../profesionalesTurnos.php?p=$idProfesional");
                } else {
                    echo "<script>alert('error replicando los turnos);</script>";
                    // echo ": ".mysqli_error($conn);
                }
            }
            break;
        case "borrar turno":
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $consulta = "delete from eventos where id = $id";
                $result = mysqli_query($conn, $consulta);
                if($result){
                    echo "<script>alert('OK - redirigiendo);</script>";
                    header("Location: ../profesionalesTurnos.php?p=$idProfesional");
                } else {
                    echo "<script>alert('error borrando el turno);</script>";
                    // echo ": ".mysqli_error($conn);
                }
            }
            break;

    }
        


?>