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
            if(isset($_GET['areaid'])){
                require_once('../php/db.class.php');

                $areaID = $_GET['areaid'];
                $userID = $_SESSION['id_usuario'];

                $sql = "SELECT areas.id A_ID, areas.nome A_NOME, areas.gerente A_GERENTE, users.nome U_NOME, users.sobrenome U_SOBRENOME FROM areas LEFT JOIN users ON areas.gerente = users.id WHERE areas.id= $areaID";


                $objDb = new db();
                $link = $objDb->conect_mysql();

                //executar a query
                if(mysqli_query($link, $sql)){

                    $resultSelect = mysqli_query($link, $sql);
                    $row_area = mysqli_fetch_assoc($resultSelect);

                } else {
                        echo 'Ninguna Area encontrada!';
                }
            }
        ?>
    </head>

    <body>
		<?php include "../menu-sub.php"; ?>

        <div class="container-fluid col-md-12">
            <div class="row">
                <div class="col-md-8 border-right-form">
                    <h3>Editar Area</h3>

                    <form action="../php/update-area.php" method="post" id="form-edit-area">
                        <div class="form-group" hidden>
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $row_area['A_ID']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nome">Nombre</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row_area['A_NOME']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="gerente">Gerente</label>
                            <input type="text" class="form-control" id="gerente" name="gerente" value="<?php echo $row_area['U_NOME'] . ' ' . $row_area['U_SOBRENOME']; ?>" readonly>
                        </div>

                        <div class="row justify-content-end">
                            <?php if($_SESSION['user_type'] == 0 or $_SESSION['user_type'] == 1){ ?>
                                <a href="../edit/area.php?userid=<?php echo $userID; ?>" class="btn btn-warning" id="btn_edit" name="btn_edit">Editar</a>
                                <a href="../php/delete-area.php?userid=<?php echo $userID; ?>" class="btn btn-danger" id="btn_delete" name="btn_delete" onclick ="return confirm('Deseas eliminar el usuario?');">Eliminar</a>
                            <?php } ?>

                            <a href="../home.php" class="btn btn-primary" id="btn_back" name="btn_back">Regresar</a>
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