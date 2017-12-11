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

        <!-- Bootstrap -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Folha de estilo CSS personalizado -->
        <link href="css/style.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        <!-- Script Modernizr para compatibilidade com navegadores mas antigos -->
        <script src="vendor/modernizr/modernizr.js"></script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function() {

                //verificar se os campos de Login foram devidamente preenchidos
                $('#btn_login').click(function() {

                    var campo_vazio = false;

                    if ($('#email-login').val() == '') {
                        $('#email-login').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#email-login').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#password-login').val() == '') {
                        $('#password-login').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#password-login').css({
                            'border-color': '#CCC'
                        });
                    }

                    if (campo_vazio) return false;
                });

                //verificar se os campos de Cadastro foram devidamente preenchidos
                $('#btn_register').click(function() {

                    var campo_vazio = false;

                    if ($('#name').val() == '') {
                        $('#name').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#name').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#last-name').val() == '') {
                        $('#last-name').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#last-name').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#email').val() == '') {
                        $('#email').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#email').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#empresa').val() == '') {
                        $('#empresa').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#empresa').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#area').val() == '') {
                        $('#area').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#area').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#password').val() == '') {
                        $('#password').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#password').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#password-confirm').val() == '') {
                        $('#password-confirm').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#password-confirm').css({
                            'border-color': '#CCC'
                        });
                    }

                    if (campo_vazio) return false;
                });
            });
        </script>
    </head>

    <body>

        <div class="container">

            <div class="page-header">
                <img src="img\logo.png" />

                <h1 class="project-manager">Project Manager</h1>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-8 border-right-form">
                    <h3>Cadastre-se</h3>

                    <form action="php\register.php" method="post" id=form-regster>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label for="last-name">Apellidos</label>
                            <input type="text" class="form-control" id="last-name" name="last-name">
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="empresa">Empresa</label>
                            <input type="text" class="form-control" id="empresa" name="empresa">
                        </div>

                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" class="form-control" id="area" name="area">
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="password-confirm" name="password-confirm">
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chb-terminos"> Acepto los terminos del servicio.
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="opcoes"> Empresa
                            </label>

                            <label>
                                <input type="radio" name="opcoes"> Personal
                            </label>
                        </div>

                        <button type="buttom" class="btn btn-light" id="btn_register" name="btn_register">Registrar</button>

                        </br>
                        </br>

                        <?php
                            if($erro == 2){
                            echo '<font color="#FF0000">Email ya registrado, haga login o registre otro email</font>';
                            }

                            if($erro == 3){
                                echo '<font color="#FF0000">Error al registrar usuario, intente mas tarde!</font>';
                            }
                        ?>

                    </form>

                </div>

                <div class="col-sm-4">
                    <h3>Logar</h3>

                    <form id="form-login" method="post" action="php\login.php">
                        <div class="form-group">
                            <label for="email-login">E-mail</label>
                            <input type="email" class="form-control" id="email-login" name="email-login">
                        </div>

                        <div class="form-group">
                            <label for="password-login">Contraseña</label>
                            <input type="password" class="form-control" id="password-login" name="password-login">
                        </div>

                        <button type="buttom" class="btn btn-primary" id="btn_login" name="btn_login">Ingresar</button>

                        <div>
                            </br>
                            <a href="lost-pass.php">Olvidé mi contraseña</a>
                        </div>

                    </form>

                </div>

                </br>
                <?php
                    if($erro == 1){
                    echo '<font color="#FF0000">Usuario o contraseña incorectos</font>';
                }
                ?>

            </div>

        </div>

        </div>

    </body>

</html>