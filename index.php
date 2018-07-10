<?php

    $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;

?>

    <!DOCTYPE html>
    <html lang="es-MX">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Creapolis - Project Manager</title>

		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- Material Design Bootstrap -->
		<link href="css/mdb.min.css" rel="stylesheet">
		<!-- Your custom styles (optional) -->
		<link href="css/style.css" rel="stylesheet">
		<link href="css/style-pm.css" rel="stylesheet">
    </head>

    <body>
        <?php
            if(isset($_COOKIE["email"])){
                $cookie_email = $_COOKIE["email"] ;
                $cookie_tempass = $_COOKIE["tempass"];

                ?>

                <form id="form-login-cookie" method="post" action="php\login.php">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="email-cookie" name="email-cookie" value="<?php echo "$cookie_email" ?>" >
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="tempass-cookie" name="tempass-cookie" value="<?php echo "$cookie_tempass" ?>">
                    </div>
                </form>

                <script>
                    window.onload=function(){
                        // Una vez cargada la página, el formulario se enviara automáticamente.
                        document.forms["form-login-cookie"].submit();
                    }
                </script>

        <?php } ?>

        <div class="col-md-12">
            <?php
                if($erro == 1){
                echo '<div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Usuario o contraseña incorrectos.
                </div>';
            }

            if($erro == 2){
                echo '<div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Es necesario hacer login para ejecutar esta accion!.
                </div>';
            }
            ?>
        </div>

        <div class="container col-md-12" style="height: 600px;">

            <div class="row col-md-12">
                <div class="col-md-8">
                    <h3>Project Manager</h3>
                    <h4>Organizando sus proyectos y los haciendo visibles a quien quieres que los vea!</h4>
                    <p>Necesitas organizar tus proyectos?</p>
                    <p>Que sean visibles por quien quieras donde quieras?</p>
                    <p>Con nuetros Project Manager se puede organizar sus proyectos y dejarlos visibles para quien quieras</p>
                    <p>Crias tu cuenta y despues puedes añadir quien quieras.</p>
                    <p>Nuetros sistema cuenta con administradores, gerente de proyecto, cliente...</p>
                </div>

                <div class="col-md-4">
                    <!-- Card -->
                    <div class="card">

                        <!-- Card body -->
                        <div class="card-body">

                            <!--Header-->
                            <div class="header pt-3 primary-color">

                                <div class="row d-flex justify-content-center">
                                    <h3 class="white-text mb-3 pt-3 font-weight-bold">Log in</h3>
                                </div>

                            </div>
                            <!--Header-->

                            <!-- Material form register -->
                            <form id="form-login" method="post" action="php\login.php">

                                <!-- Material input email -->
                                <div class="md-form">
                                    <i class="fa fa-envelope prefix grey-text"></i>
                                    <input type="email" id="materialFormCardEmailEx" class="form-control" name="email-login" required>
                                    <label for="materialFormCardEmailEx" class="font-weight-light">Su email</label>
                                </div>

                                <!-- Material input password -->
                                <div class="md-form">
                                    <i class="fa fa-lock prefix grey-text"></i>
                                    <input type="password" id="materialFormCardPasswordEx" class="form-control" name="password-login" required>
                                    <label for="materialFormCardPasswordEx" class="font-weight-light">Su contraseña</label>
                                </div>

                                <div class="text-center">
                                    <input type="checkbox" name="guardar_clave" value="1">&nbspPermanecer conectado!</input>
                                </div>

                                <div class="text-center py-4 mt-3">
                                    <button class="btn btn-cyan" type="submit">Entrar</button>
                                </div>

                                <div  class="text-center">
                                    <a href="lost-pass.php">Olvidé mi contraseña</a>
                                </div>
                            </form>
                            <!-- Material form register -->

                        </div>
                        <!-- Card body -->

                    </div>
                    <!-- Card -->
                </div>
            </div>
        </div>

        <?php include "footer.php"; ?>

        <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
    </body>
</html>