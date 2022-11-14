<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="../../assets/jquery/jquery-3.6.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="./login.css">

    <style>
        img {
            display: block;
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
            width: 300px;
            height: 50%;
            }
    </style>

</head>
<body>
<?php 
    require('../db/dbConnection.php');
    session_start();
    $_SESSION['action'] = 'login';
    ?>

    <div id="login">
        <!-- <h3 class="text-center text-white pt-5">abocad</h3> -->
        <img src="../../assets/images/abocad-logo.png" class="imagen" alt="">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" action="./loginCrud.php" class="form" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="dni" class="text-info">dni</label><br>
                                <!-- <input type="number" name="dni" class="form-control" value="22925061"> -->
                                <input type="number" name="dni" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">password</label><br>
                                <!-- <input type="text" name="password" class="form-control" value="test1234"> -->
                                <input type="password" name="password" class="form-control">
                            </div>
                            <p>
                                <!-- <div class="form-group"> -->
                                <div class="col-md-6">
                                    <input type="submit" value="ingresar" class="btn btn-warning" name="logIn_button">
                                </div>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>





<body>

</body>