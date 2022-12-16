<?php
    session_start();
    $accion = $_SESSION["accion"];
    $idProfesional = $_SESSION['idProfesional'];
    $nombreProfesional = $_SESSION['profesionalNombre'];
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
                    } elseif($origenCierreTurno == "profesional") {
                        header("Location: turnosProfesional.php?id=$idProfesional&nombre=$nombreProfesional");
                    } else {
                        echo "<script>alert('error cerrando el turno');</script>";
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
                    if($origenCierreTurno == "general"){
                        header("Location: turnosGeneral.php");
                    } elseif($origenCierreTurno == "profesional") {
                        header("Location: turnosProfesional.php?id=$idProfesional&nombre=$nombreProfesional");
                    } else {
                        echo "<script>alert('error cerrando el turno');</script>";
                    }

                } else {
                    echo "<script>alert('error replicando los turnos');</script>";
                }
            }
            break;
        case "edit":
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $profesional = $_POST['profesional'];
                $dni = $_POST['dni'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $start = $_POST['turnoDesde'];
                $end = $_POST['turnoHasta'];
                $cobertura = $_POST['cobertura'];
                // borro los turnos superiores a la fecha de modificacion
                $sql = "delete from eventos where id > $id and dni = $dni and profesional = $profesional";
                $d = db::conectar()->prepare($sql);
                $d->execute();            

                $sql = "UPDATE eventos SET
                    description = '$description', 
                    start = '$start', 
                    end = '$end',
                    cobertura = $cobertura
                WHERE dni = $dni
                    and id = $id
                    and profesional = $profesional";

                $p = db::conectar()->prepare($sql);
                $p->execute();
                if($p){
                    if($origenCierreTurno == "general"){
                        header("Location: turnosGeneral.php");
                    } elseif($origenCierreTurno == "profesional") {
                        header("Location: turnosProfesional.php?id=$idProfesional&nombre=$nombreProfesional");
                    } else {
                        echo "<script>alert('error cerrando el turno');</script>";
                    }
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
                    if($origenCierreTurno == "general"){
                        header("Location: turnosGeneral.php");
                    } elseif($origenCierreTurno == "profesional") {
                        header("Location: turnosProfesional.php?id=$idProfesional&nombre=$nombreProfesional");
                    } else {
                        echo "<script>alert('error cerrando el turno');</script>";
                    }
                } else {
                    echo "<script>alert('error borrando el turno);</script>";
                }
            }
            break;

    }
        


?>