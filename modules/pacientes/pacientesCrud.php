<?php
    require('../db/dbConnection.php');
    session_start();
    $accion = $_SESSION['action'];
    // $id = $_POST['id'];

    
    switch ($accion) {
        case 'add':
            if(isset($_POST['submit'])) {
                try {
                    $apellido = $_POST['apellido'];
                    $nombre = $_POST['nombre'];
                    $dni = $_POST['dni'];
                    $fechaNacimiento = $_POST['fecNac'];
                    $contactoFamilia = $_POST['contacto'];
                    $contactoColegio = $_POST['contactoColegio'];
                    $estado = $_POST['estado'];
                    // estado activo o inactivo
                    if($estado=="activo"){
                        $valorEstado = 1;
                    } else {
                        $valorEstado = 0;
                    }
                    // pago por reintegro
                    $reintegro = $_POST['reintegro'];
                    if($reintegro=="si"){
                        $valorReintegro = 1;
                    } else {
                        $valorReintegro = 0;
                    }
                    // tipo de cobertura
                    $tipoPrestacion = $_POST['tipoPrestacion'];
                    if($tipoPrestacion=="si"){
                        $valorTipoPrestacion = 1;
                    } else {
                        $valorTipoPrestacion = 2;
                    }

                    $sql = "INSERT INTO `pacientes`(`apellido`, `nombre`, `dni`, `fechaNacimiento`, `contacto`, `contactoColegio`, `estado`, `reintegro`, `tipoCobertura`) VALUES 
                    ('$apellido','$nombre','$dni','$fechaNacimiento','$contactoFamilia','$contactoColegio','$valorEstado','$valorReintegro','$valorTipoPrestacion')";

                    $p = db::conectar()->prepare($sql);
                    $p->execute();
                    header ("Location: ./pacientes.php");
                } catch (PDOException $error1) {
                    echo $error1->getMessage();
                } catch (Exception $error1) {
                    echo $error2->getMessage();
                }
            }
        break;

        // edicion de paciente
        case 'edit':
            if(isset($_POST['submit'])){
                try {
                    $id = $_POST['id'];
                    $apellido = $_POST['apellido'];
                    $nombre = $_POST['nombre'];
                    $dni = $_POST['dni'];
                    $fechaNacimiento = $_POST['fecNac'];
                    $contactoFamilia = $_POST['contacto'];
                    $contactoColegio = $_POST['contactoColegio'];
                    $estado = $_POST['estado'];
                    // estado activo o inactivo
                    if($estado=="activo"){
                        $valorEstado = 1;
                    } else {
                        $valorEstado = 0;
                    }
                    // pago por reintegro
                    $reintegro = $_POST['reintegro'];
                    if($reintegro=="si"){
                        $valorReintegro = 1;
                    } else {
                        $valorReintegro = 0;
                    }
                    // tipo de cobertura
                    $tipoPrestacion = $_POST['discapacidad'];
                    if($tipoPrestacion=="si"){
                        $valorTipoPrestacion = 1;
                    } else {
                        $valorTipoPrestacion = 2;
                    }


                    $sql = "UPDATE pacientes SET apellido='$apellido' ,nombre='$nombre', dni=$dni, fechaNacimiento='$fechaNacimiento',
                            contacto='$contactoFamilia', contactoColegio='$contactoColegio', estado=$valorEstado, reintegro=$valorReintegro, tipoCobertura=$valorTipoPrestacion
                            WHERE id=$id";

                    $p = db::conectar()->prepare($sql);
                    $p->execute();
                    header ("Location: ./pacientes.php");
                } catch (PDOException $error1) {
                    echo $error1->getMessage();
                } catch (Exception $error1) {
                    echo $error2->getMessage();
                }
            }
        break;

        // borrado de paciente
        case 'delete':
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                try {
                    $sql = "delete from pacientes where id = $id";
                    $p = db::conectar()->prepare($sql);
                    $p->execute();
                    header ("Location: ./pacientes.php");
                } catch (PDOException $error1) {
                    echo $error1->getMessage();
                } catch (Exception $error1) {
                    echo $error2->getMessage();
                }
            }
        break;



    }
?>
