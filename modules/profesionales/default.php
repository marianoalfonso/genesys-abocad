<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="default.css">

    <!-- <style>
    .container {
        /* background-color: yellow; */
        margin-top: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;

    }
    </style> -->



</head>
<body background="./assets/images/abocad-logo.png">
    <?php
        session_start();
        $_SESSION['absPath'] = "localhost/genesys-abocad";
    ?>

    <div class="container">
        <div class="row justify-content-center align-items-center g-1">
            <!-- <div class="col">
                <img class="img-fluid img-thumbnail" src="./assets/images/abocad-logo.png" alt="abocad" id="logo">
            </div> -->
            <div>
                <a href="./modules/login/login.php" class="btn btn-warning">ingresar</a>
                
            </div>
        </div>
    </div>

    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>