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
        <title>Crear Proyecto</title>

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

                //verificar se os campos de Cadastro foram devidamente preenchidos
                $('#btn_save_project').click(function() {

                    var campo_vazio = false;

                    if ($('#tarea-name').val() == '') {
                        $('#tarea-name').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#tarea-name').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#tarea-objective').val() == '') {
                        $('#tarea-objective').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#tarea-objective').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#tarea-responsable').val() == '') {
                        $('#tarea-responsable').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#tarea-responsable').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#tarea-area').val() == '') {
                        $('#tarea-area').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#tarea-area').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#tarea-date-start').val() == '') {
                        $('#tarea-date-start').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#tarea-date-start').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#tarea-date-finish').val() == '') {
                        $('#tarea-date-finish').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#tarea-date-finish').css({
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

                    <form action="php\save-tarea.php" method="post" id=form-regster>
                        <div class="form-group">
                            <label for="tarea-name">Nombre</label>
                            <input type="text" class="form-control" id="tarea-name" name="tarea-name">
                        </div>

                        <div class="form-group">
                            <label for="tarea-objective">Objetivo</label>
						<textarea rows="5" maxlength="200" class="form-control" placeholder="Objetivo" id="tarea-objective" name="tarea-objective" required data-validation-required-message="Entre el abjetivo."></textarea>
<p class="help-block text-danger"></p>
                        </div>

                        <div class="form-group">
                            <label for="tarea-responsable">Responsable</label>
                            <input type="text" class="form-control" id="tarea-responsable" name="tarea-responsable">
                        </div>

                        <div class="form-group">
                            <label for="tarea-area">Area</label>
                            <input type="text" class="form-control" id="tarea-area" name="tarea-area">
                        </div>

                        <div class="form-group">
                            <label for="tarea-date-start">Data Inicial</label>
                            <input type="date" class="form-control" id="tarea-date-start" name="tarea-date-start">
                        </div>

                        <div class="form-group">
                            <label for="tarea-date-finish">Data Final</label>
                            <input type="date" class="form-control" id="tarea-date-finish" name="tarea-date-finish">
                        </div>

                        <div class="form-group">
                            <label for="tarea-domain">Dominio</label>
                            <input type="text" class="form-control" id="tarea-domain" name="tarea-domain">
                        </div>

                        <button type="buttom" class="btn btn-light" id="btn_save_tarea" name="btn_save_tarea">Guardar</button>

                        </br>
                        </br>

                        <?php
                            if($erro == 2){
                            echo '<font color="#FF0000">Tarea ya registrado, haga una busca.</font>';
                        }
                        ?>

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