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
        <title>Creapolis - Project Manager</title>

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
            $resultadoTipoUsuario = $popularCombobox->tipo_usuario();
            $resultadoArea = $popularCombobox->area();
        ?>
    </head>

    <body>

		<?php include "../menu-sub.php"; ?>

        <div class="container col-md-12">
            <div class="row">
                <div class="col-sm-8 border-right-form">
                    <h3>Buscar Usuario</h3>

                    <form action="user-result.php" method="post" id="form-search">
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
                            <select name="area" id="area" class="form-control">
                                <option value="">Selecione la Area del Usuario</option>
                                <?php while($row_area = mysqli_fetch_assoc($resultadoArea)) { ?>
                                    <option value="<?php echo $row_area['id']; ?>"><?php echo $row_area['nome']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type-user">Tipo</label>
                            <select name="type-user" id="type-user" class="form-control">
                                <option value="">Selecione el tipo del Usuario</option>
                                <?php while($row_tipo_usuario = mysqli_fetch_assoc($resultadoTipoUsuario)) { ?>
                                    <option value="<?php echo $row_tipo_usuario['id']; ?>"><?php echo $row_tipo_usuario['nome']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="row justify-content-end">
                            <button type="buttom" class="btn btn-primary" id="btn_search" name="btn_search">Buscar</button>
                            <button type="buttom" class="btn btn-light" id="btn_cancel" name="btn_cancel">Cancelar</button>
                        </div>
                    </form>
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