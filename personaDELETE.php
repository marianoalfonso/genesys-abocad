<?php
    include "connDB.php";
    $conn = regresarConexion();
    $id = $_GET['id'];
    // $consultaTurnos = "select count(*) from eventos where dni = (select dni from personas where id = $id)";
    // $resultadoConsultaTurnos = mysqli_query($conn,$consultaTurnos);
    // if(!$resultadoConsultaTurnos){
    //     $consulta = "delete from personas where id = $id";
    //     $resultado = mysqli_query($conn,$consulta);
    //     if($resultado){
    //         header("Location: personas.php");
    //     }
    // }

    $consulta = "delete from personas where id = $id";
    $resultado = mysqli_query($conn,$consulta);
    if($resultado){
        header("Location: personas.php");
    }
?>