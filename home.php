<?php
	
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: index.php?erro=1');
    }
    
?>

<!DOCTYPE HTML>
<html lang="es-mx">
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
		<!-- Arquivo CSS para a Barra de Menus -->
		<link rel="stylesheet" type="text/css" href="vendor/HorizontalDropDownMenu/css/component.css" />

		<!-- Final das funcoes da Barra de Menu -->

	</head>

	<body>

	<div class="container">
	
		<div class="page-header">
			<img src="img\logo.png" />

			<h1 class="project-manager">Project Manager</h1>
		</div>
	</div>

		<nav id="cbp-hrmenu" class="cbp-hrmenu">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li>
                <a href="#">Proyectos</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner">
                        <div>
                            <ul>
                                <li><a href="create-project.php">Nuevo</a></li>
                                <li><a href="#">Buscar</a></li>
                                <li><a href="#">Agendas</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /cbp-hrsub-inner -->
                </div>
                <!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Tareas</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner">
                        <div>
                            <ul>
                                <li><a href="#">Nueva</a></li>
                                <li><a href="#">Buscar</a></li>
                                <li><a href="#">Agendas</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /cbp-hrsub-inner -->
                </div>
                <!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Colaboradores</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner">
                        <div>
                            <ul>
                                <li><a href="#">Registrar</a></li>
                                <li><a href="#">Buscar</a></li>
                                <li><a href="#">Agendas</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /cbp-hrsub-inner -->
                </div>
                <!-- /cbp-hrsub -->
            </li>

            <li><a href="#">Contacto</a></li>
        </ul>
    </nav>
	<script src="vendor/HorizontalDropDownMenu/js/cbpHorizontalMenu.min.js"></script>
		<script>
			$(function() {
				cbpHorizontalMenu.init();
			});
		</script>
	</body>
</html>