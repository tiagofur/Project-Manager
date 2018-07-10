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
        <title>Visualizar Cliente</title>

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
            if(isset($_GET['clientid'])){
                require_once('../php/db.class.php');

                $clientID = $_GET['clientid'];
                $userID = $_SESSION['id_usuario'];

                $sql = "SELECT * FROM clients WHERE id = $clientID";

                $objDb = new db();
                $link = $objDb->conect_mysql();

                //executar a query
                if(mysqli_query($link, $sql)){

                        $resultSelectClient = mysqli_query($link, $sql);
                        $row_client = mysqli_fetch_assoc($resultSelectClient);

                } else {
                        echo 'Ningun proyecto encontrado!';
                }
            }
        ?>
    </head>

    <body>

		<?php include "../menu-sub.php"; ?>

        <div class="container-fluid col-md-12">
            <div class="row">
                <div class="col-md-8 border-right-form">
                    <h3>Visualizar Cliente</h3>

                    <form action="php/update-client.php" method="post" id="form-vier">
                        <div class="form-group" hidden>
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="user-id" name="user-id" value="<?php echo $clientID ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row_client['nome']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="contact-name">Nome Contacto</label>
                            <input type="text" class="form-control" id="contact-name" name="contact-name" value="<?php echo $row_client['contactname']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row_client['email']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="phone">Telefono</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row_client['phone']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="adress">Direccion</label>
                            <input type="text" class="form-control" id="adress" name="adress" value="<?php echo $row_client['adress']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="city">Ciudad</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?php echo $row_client['city']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="state">Estado</label>
                            <input type="text" class="form-control" id="state" name="state" value="<?php echo $row_client['estado']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="country">Pais</label>
                            <input type="text" class="form-control" id="country" name="country" value="<?php echo $row_client['country']; ?>" readonly>
                        </div>

                        <div class="row justify-content-end">
                            <?php if($_SESSION['user_type'] == 1 or $_SESSION['user_type'] == 2){ ?>
                                <a href="../edit/client.php?clientid=<?php echo $clientID; ?>" class="btn btn-warning" id="btn_edit" name="btn_edit">Editar</a>
                                <a href="../php/delete-client.php?deleteclient=<?php echo $clientID; ?>" class="btn btn-danger" id="btn_delete" name="btn_delete" onclick ="return confirm('Deseas eliminar el proyecto?');">Eliminar</a>
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