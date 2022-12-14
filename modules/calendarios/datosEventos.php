<?php

// todo lo que devuelve este modulo lo devuelve a traves de json
header('Content-Type: application/json');
require_once("../db/dbConnection.php");


switch ($_GET['accion']) {
    case 'listar':
        $sql = "select
                    id,profesional,dni,
                    title,description,
                    start,end,
                    textColor,backgroundColor
                from eventos
                where profesional = $_GET[p]";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        $resultado = $p->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;

    case 'agregar':
        $sql = "insert into
                        eventos (
                            profesional,
                            dni,
                            title,
                            description,
                            start,
                            end,
                            textColor,
                            backgroundColor,
                            cobertura
                            )
                        values (
                            '$_POST[profesional]',
                            '$_POST[dni]',
                            '$_POST[titulo]',
                            '$_POST[descripcion]',
                            '$_POST[inicio]',
                            '$_POST[fin]',
                            '$_POST[colorTexto]',
                            '$_POST[colorFondo]',
                            '$_POST[cobertura]'
                            )";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        echo json_encode($p);
        break;

    case 'modificar':
        $sql = "update
                        eventos set
                            title = '$_POST[titulo]',
                            description = '$_POST[descripcion]',
                            start = '$_POST[inicio]',
                            end = '$_POST[fin]',
                            textColor = '$_POST[colorFondo]',
                            backgroundColor = '$_POST[colorTexto]',
                            cobertura = '$_POST[cobertura]'
                        where
                            id = $_POST[id]";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        echo json_encode($p);
        break;

    case 'borrar':
        $sql= "delete from
            eventos
         where
            id = $_POST[id]";
        $p = db::conectar()->prepare($sql);
        $p->execute();
        echo json_encode($p);
        break;

    default:
        # code...
        break;
}


?>