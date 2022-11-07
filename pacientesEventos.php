<?php

// todo lo que devuelve este modulo lo devuelve a traves de json
require("connDB.php");

$conexion = regresarConexion();

switch ($_GET['accion']) {
    case 'listar':
        $consulta = "select
                        id,
                        profesional,
                        dni,
                        title,
                        description,
                        start,
                        end,
                        textColor,
                        backgroundColor
                     from
                        eventos
                     where
                        profesional = $_GET[p]";



        $datos = mysqli_query($conexion, $consulta);
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;

    case 'agregar':
        $consulta = "insert into
                        eventos (
                            profesional,
                            dni,
                            title,
                            description,
                            start,
                            end,
                            textColor,
                            backgroundColor
                            )
                        values (
                            '$_POST[profesional]',
                            '$_POST[dni]',
                            '$_POST[titulo]',
                            '$_POST[descripcion]',
                            '$_POST[inicio]',
                            '$_POST[fin]',
                            '$_POST[colorTexto]',
                            '$_POST[colorFondo]'
                            )";

        $respuesta = mysqli_query($conexion, $consulta);
        echo json_encode($respuesta);
        break;

    case 'modificar':
        $consulta = "update
                        eventos set
                            title = '$_POST[titulo]',
                            description = '$_POST[descripcion]',
                            start = '$_POST[inicio]',
                            end = '$_POST[fin]',
                            textColor = '$_POST[colorFondo]',
                            backgroundColor = '$_POST[colorTexto]'
                        where
                            id = $_POST[id]";
        $respuesta = mysqli_query($conexion,$consulta);
        echo json_encode($respuesta);
        break;

    case 'borrar':
        $consulta= "delete from
            eventos
         where
            id = $_POST[id]";
            $respuesta = mysqli_query($conexion,$consulta);
            echo json_encode($respuesta);
        break;

    default:
        # code...
        break;
}


?>