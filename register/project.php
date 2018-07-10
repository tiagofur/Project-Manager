<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=1');
    }
?>

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
                    <h3>Crear Proyecto</h3>

                    <form action="../php/save-project.php" method="post" id="form-register-project">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del Proyecto" required>
                        </div>

                        <div class="form-group">
                            <label for="objective">Objetivo</label>
						    <textarea rows="5" maxlength="500" class="form-control" id="objective" name="objective" placeholder="Objetivo" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="cliente">Cliente</label>
                            <select name="cliente" id="cliente" class="form-control">
                                <option value="">Selecione un Cliente para el Proyecto</option>
                                <?php while($row_cliente = mysqli_fetch_assoc($resultadoCliente)) { ?>
                                    <option value="<?php echo $row_cliente['id']; ?>"><?php echo $row_cliente['nome']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="gerente">Gerente</label>
                            <select name="gerente" id="gerente" class="form-control" required>
                                <option value="">Selecione un Gerente para el Proyecto</option>
                                <?php while($row_gerente = mysqli_fetch_assoc($resultadoGerente)) { ?>
                                    <option value="<?php echo $row_gerente['id']; ?>"><?php echo $row_gerente['nome'] . ' ' . $row_gerente['sobrenome']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="area">Area</label>
                            <select name="area" id="area" class="form-control" required>
                                <option value="">Selecione una Area para el Proyecto</option>
                                <?php while($row_area = mysqli_fetch_assoc($resultadoArea)) { ?>
                                    <option value="<?php echo $row_area['id']; ?>"><?php echo $row_area['nome']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date-start">Data Inicial</label>
                            <input type="date" class="form-control" id="date-start" name="date-start" required>
                        </div>

                        <div class="form-group">
                            <label for="date-finish">Data Final</label>
                            <input type="date" class="form-control" id="date-finish" name="date-finish" required>
                        </div>

                        <div class="row justify-content-end">
                            <button type="submit" class="btn btn-primary" id="btn_save" name="btn_save">Guardar</button>
                            <button type="buttom" class="btn btn-light" id="btn_cancel" name="btn_cancel">Cancelar</button>
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
        <script type="../text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="../text/javascript" src="js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="../text/javascript" src="js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="../text/javascript" src="js/mdb.min.js"></script>
    </body>
</html>