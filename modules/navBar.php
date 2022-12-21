<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>

    <?php
        session_start();
        $pacientesDesarrollo = "//localhost/genesys-abocad/modules/pacientes/pacientes.php";
        $profesionalesDesarrollo = "//localhost/genesys-abocad/modules/profesionales/profesionales.php";
        $turnosDesarrollo = "//localhost/genesys-abocad/modules/turnos/turnosGeneral.php";
        $descargasDesarrollo = "//localhost/genesys-abocad/modules/descargas/seleccionDescarga.php";
        $salirDesarrollo = "//localhost/genesys-abocad/default.php";

        $pacientesProduccion = "https://abocad.geatec.com.ar/modules/pacientes/pacientes.php";
        $profesionalesProduccion = "https://abocad.geatec.com.ar/modules/profesionales/profesionales.php";
        $turnosProduccion = "https://genesys-abocad/modules/turnos/turnosGeneral.php";
        $descargasProduccion = "https://genesys-abocad/modules/descargas/seleccionDescarga.php";
        $salirProduccion = "https://abocad.geatec.com.ar/default.php";
    ?>

    <div class="container-fluid">
        <!-- barra de navegacion -->
        <!-- navbar-expand-md (expansion de la barra) -->
        <!-- navbar-light (estilo luminoso) -->
        <!-- border-primary (color azul llamativo) -->
        <nav class="navbar navbar-expand-md navbar-light bg-light border-3 border-bottom border-primary">
            <!-- container-fluid (ocupa todo el ancho disponible) -->
            <div class="container-fluid">
                <a href="#" class="navbar-brand">ABOCAD</a>
                <!-- navbar-toggler (alterna entre estado visible o no) -->
                <!-- data-bs-toggle (propiedad a alternar) -->
                <!-- data-bs-target (cual es el elemento objetivo del toggle) -->
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MenuNavegacion">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="MenuNavegacion" class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-3">
                        <!-- menu pacientes -->
                        <li class="nav-item"><a class="nav-link" href="<?php echo $pacientesDesarrollo ?>">pacientes</a></li>
                        <!-- menu profesionales -->
                        <li class="nav-item"><a class="nav-link" href="<?php echo $profesionalesDesarrollo ?>">profesionales</a></li>
                        <!-- menu turnos -->
                        <li class="nav-item"><a class="nav-link" href="<?php echo $turnosDesarrollo ?>">turnos</a></li>
                        <!-- menu descargas -->
                        <li class="nav-item"><a class="nav-link" href="<?php echo $descargasDesarrollo ?>">descargas</a></li>
                        <!-- menu salir -->
                        <li class="nav-item"><a class="nav-link" href=<?php echo $salirDesarrollo ?>>salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    </div>
    
    <!-- para el menu dropdown, debe importarse popper antes que bootstrap -->
    <script src="../assets/bootstrap/js/popper.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    
</body>
</html>