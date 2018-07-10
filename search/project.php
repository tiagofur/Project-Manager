<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=1');
    }
?>

<!DOCTYPE html>
<html lang="es-MX">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Buscar Proyecto</title>

		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<!-- Material Design Bootstrap -->
		<link href="../css/mdb.min.css" rel="stylesheet">
		<!-- Your custom styles (optional) -->
		<link href="../css/style.css" rel="stylesheet">
        <link href="../css/style-pm.css" rel="stylesheet">

        <?php
            require_once('../php/search-combobox.php');
            $popularCombobox = new comboboxPopulate();
            $resultadoGerente = $popularCombobox->gerente();
            $resultadoCliente = $popularCombobox->cliente();
            $resultadoArea = $popularCombobox->area();
        ?>
    </head>

    <body>
		<?php include "../menu-sub.php"; ?>

        <div class="container col-md-12">
            <div class="row">
                <div class="col-sm-8 border-right-form">
                    <h3 class="titulo-pagina">Buscar Proyecto</h3>

                    <form action="project-result.php" method="post" id=form-search>
                        <div class="form-group">
                            <label for="project-name">Nombre</label>
                            <input type="text" class="form-control" id="project-name" name="project-name">
                        </div>

                        <div class="form-group">
                            <label for="project-objective">Objetivo</label>
						    <textarea rows="5" maxlength="500" class="form-control" id="project-objective" name="project-objective"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="project-client">Cliente</label>
                            <select name="project-client" id="project-client" class="form-control">
                                <option value="">Selecione el Cliente del Proyecto</option>
                                <?php while($row_cliente = mysqli_fetch_assoc($resultadoCliente)) { ?>
                                    <option value="<?php echo $row_cliente['id']; ?>"><?php echo $row_cliente['nome']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="project-gerente">Gerente</label>
                            <select name="project-gerente" id="project-gerente" class="form-control">
                                <option value="">Selecione el Gerente del Proyecto</option>
                                <?php while($row_gerente = mysqli_fetch_assoc($resultadoGerente)) { ?>
                                    <option value="<?php echo $row_gerente['id']; ?>"><?php echo $row_gerente['nome'] . ' ' . $row_gerente['sobrenome']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="project-area">Area</label>
                            <select name="project-area" id="project-area" class="form-control">
                                <option value="">Selecione la Area del Proyecto</option>
                                <?php while($row_area = mysqli_fetch_assoc($resultadoArea)) { ?>
                                    <option value="<?php echo $row_area['id']; ?>"><?php echo $row_area['nome']; ?></option>
                                <?php } ?>
                            </select>
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
                            <label for="project-validated">Situacion</label>
                            <select name="project-validated" id="project-validated" class="form-control">
                                <option value="">Ambos</option>
                                <option value="1">No Validado</option>
                                <option value="2">Validado</option>
                            </select>
                        </div>

                        <div class="row justify-content-end">
                            <button type="submit" class="btn btn-primary" id="btn_search_project" name="btn_search_project">Buscar</button>
                            <a href="../home.php" class="btn btn-light" id="btn_cancel" name="btn_cancel">Cancelar</a>
                        </div>
                    </form>
                </div>

                <div class="col-md-4">
                    Aqui van tener infos de proyectos y tareas del usuario
                </div>
            </div>
        </div>

         <?php include "../footer.php"; ?>

        <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../js/mdb.min.js"></script>
    </body>
</html>