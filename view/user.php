<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=1');
    }

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
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<!-- Material Design Bootstrap -->
		<link href="../css/mdb.min.css" rel="stylesheet">
		<!-- Your custom styles (optional) -->
		<link href="../css/style.css" rel="stylesheet">
		<link href="../css/style-pm.css" rel="stylesheet">
    </head>

    <body>

		<?php include "../menu-sub.php"; ?>

        <?php
            if(isset($_GET['userid'])){
                require_once('../php/user-action.php');

                $userID = $_GET['userid'];
                $conectedID = $_SESSION['id_usuario'];

                $user_action = new userAction();
                $selectUser = $user_action->selectUser($userID);
                $row_user = mysqli_fetch_assoc($selectUser);
            }
        ?>

        <div class="container-fluid col-md-12">
            <div class="row">
                <div class="col-md-8 border-right-form">
                    <h3>Visualizar Usuario</h3>

                    <form action="../php/update-user.php" method="post" id="form-ver-usuario">

                        <div class="form-group" hidden>
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $userID ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row_user['U_NOME']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="last-name">Apellidos</label>
                            <input type="text" class="form-control" id="last-name" name="last-name" value="<?php echo $row_user['U_SOBRENOME']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row_user['U_EMAIL']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="empresa">Empresa</label>
                            <input type="text" class="form-control" id="empresa" name="empresa" value="<?php echo $row_user['U_EMPRESA']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" class="form-control" id="area" name="area" value="<?php echo $row_user['A_NOME']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="type-user">Tipo</label>
                            <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $row_user['T_NOME']; ?>" readonly>
                        </div>

                        <div class="row justify-content-end">
                            <?php if($_SESSION['user_type'] == 0 or $_SESSION['user_type'] == 1){ ?>
                                <a href="../edit/user.php?userid=<?php echo $userID; ?>" class="btn btn-warning" id="btn_edit" name="btn_edit">Editar</a>
                                <a href="../php/delete-user.php?userid=<?php echo $userID; ?>" class="btn btn-danger" id="btn_delete" name="btn_delete" onclick ="return confirm('Deseas eliminar el usuario?');">Eliminar</a>
                            <?php } ?>

                            <a href="../home.php" class="btn btn-primary" id="btn_back" name="btn_back">Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include "footer.php"; ?>

        <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../userjs/mdb.min.js"></script>
    </body>

</html>