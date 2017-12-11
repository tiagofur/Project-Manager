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

                    if ($('#project-name').val() == '') {
                        $('#project-name').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#project-name').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#project-objective').val() == '') {
                        $('#project-objective').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#project-objective').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#project-gerente').val() == '') {
                        $('#project-gerente').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#project-gerente').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#project-area').val() == '') {
                        $('#project-area').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#project-area').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#project-date-start').val() == '') {
                        $('#project-date-start').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#project-date-start').css({
                            'border-color': '#CCC'
                        });
                    }

                    if ($('#project-date-finish').val() == '') {
                        $('#project-date-finish').css({
                            'border-color': '#A94442'
                        });
                        campo_vazio = true;
                    } else {
                        $('#project-date-finish').css({
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

                    <form action="php\save-project.php" method="post" id=form-regster>
                        <div class="form-group">
                            <label for="project-name">Nombre</label>
                            <input type="text" class="form-control" id="project-name" name="project-name">
                        </div>

                        <div class="form-group">
                            <label for="project-objective">Objetivo</label>
						<textarea rows="5" maxlength="200" class="form-control" placeholder="Objetivo" id="project-objective" name="project-objective" required data-validation-required-message="Entre el objetivo."></textarea>
<p class="help-block text-danger"></p>
                        </div>

                        <div class="form-group">
                            <label for="project-gerente">Gerente</label>
                            <input type="text" class="form-control" id="project-gerente" name="project-gerente">
                        </div>

                        <div class="form-group">
                            <label for="project-area">Area</label>
                            <input type="text" class="form-control" id="project-area" name="project-area">
                        </div>

                        <div class="form-group">
                            <label for="project-date-start">Data Inicial</label>
                            <input type="date" class="form-control" id="project-date-start" name="project-date-start">
                        </div>

                        <div class="form-group">
                            <label for="project-date-finish">Data Final</label>
                            <input type="date" class="form-control" id="project-date-finish" name="project-date-finish">
                        </div>

                        <div class="form-group">
                            <label for="project-domain">Dominio</label>
                            <input type="text" class="form-control" id="project-domain" name="project-domain">
                        </div>

                        <button type="buttom" class="btn btn-light" id="btn_save_project" name="btn_save_project">Guardar</button>

                        </br>
                        </br>

                        <?php
                            if($erro == 2){
                            echo '<font color="#FF0000">Projeto ya registrado, haga una busca.</font>';
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