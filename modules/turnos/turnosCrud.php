<?php
    session_start();
    $accion = $_SESSION["accion"];
    $idProfesional = $_SESSION['idProfesional'];
    $origenCierreTurno = $_SESSION['origenCierreTurno'];

    require_once("../db/dbConnection.php");

    switch ($accion) {
        case "close":
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $estado = $_POST['estadoCierre'];
                $sql = "update eventos set estado = '$estado' where id = $id";
                $p = db::conectar()->prepare($sql);
                $p->execute();
                if($p){
                    if($origenCierreTurno == "general"){
                        header("Location: turnosGeneral.php");
                    } else {
                        header("Location: turnosProfesional.php?id=$idProfesional");
                    }
                    
                } else {
                    echo '<script language="javascript">alert("error cerrando el turno");</script>';
                }
            }
            break;
        case "replicar":
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $replicarHasta = "'".$_POST['endDate']."'";
                $sql = "call mpa_replicarFecha($id, $replicarHasta)";
                $p = db::conectar()->prepare($sql);
                $p->execute();
                if($p){
                    header("Location: turnosProfesional.php?id=$idProfesional");
                } else {
                    echo "<script>alert('error replicando los turnos);</script>";
                }
            }
            break;
        case "edit":
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $start = $_POST['turnoDesde'];
                $end = $_POST['turnoHasta'];
                $sql = "UPDATE `eventos` SET
                `title` = '$title', `description` = '$description', `start` = '$start', `end` = '$end'
                WHERE `id` = $id";
                $p = db::conectar()->prepare($sql);
                $p->execute();
                if($p){
                    header("Location: turnosProfesional.php?id=$idProfesional");
                } else {
                    echo "<script>alert('error replicando los turnos);</script>";
                }
            }
            break;
        case "delete":
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $sql = "delete from eventos where id = $id";
                $p = db::conectar()->prepare($sql);
                $p->execute();
                if($p){
                    header("Location: turnosProfesional.php?id=$idProfesional");
                } else {
                    echo "<script>alert('error borrando el turno);</script>";
                }
            }
            break;

    }
        


?>