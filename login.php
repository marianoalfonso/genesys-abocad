<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="login.css">  

<body>

    <?php
        require('../db/dbConnection.php');

    ?>

    <div id="login">
        <h3 class="text-center text-white pt-5">control de agendas</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">usuario:</label><br>
                                <input type="text" name="username" id="username" class="form-control" value="testing">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">password:</label><br>
                                <input type="text" name="password" id="password" class="form-control" value="testing">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="logIn" name="logIn_button">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>