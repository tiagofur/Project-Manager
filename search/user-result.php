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
			require_once('../php/db.class.php');
			$user_name = $_POST['name'];
			$user_last_name = $_POST['last-name'];
			$user_email = $_POST['email'];
			$user_empresa = $_POST['empresa'];
			$user_area = $_POST['area'];
			$user_type = $_POST['type-user'];

			$sql = "SELECT users.id U_ID, users.nome U_NOME, users.sobrenome U_SOBRENOME, users.email U_EMAIL, users.empresa U_EMPRESA, users.area U_AREA, users.tipo U_TIPO, areas.nome A_NOME, typeuser.nome T_NOME FROM users LEFT JOIN areas ON users.area = areas.id LEFT JOIN typeuser ON users.tipo = typeuser.id WHERE users.nome LIKE '%$user_name%' AND users.sobrenome LIKE '%$user_last_name%' AND users.email LIKE '%$user_email%' AND users.empresa LIKE '%$user_empresa%' AND users.area LIKE '%$user_area%' AND users.tipo LIKE '%$user_type%' ORDER BY users.nome";

			$objDb = new db();
			$link = $objDb->conect_mysql();
			//executar a query
			if(mysqli_query($link, $sql)){
				$resultado = mysqli_query($link, $sql);
			} else {
				echo 'Ningun usuario encontrado!';
			}
		?>
	</head>

	<body>

		<?php include "../menu-sub.php"; ?>

		<div class="containervcol-md-12">
			<div class="row">
				<div class="col-md-12">
					<h3 class="titulo-pagina">Resultado busca Colaboradores</h3>

					<table class="table border border-success">
						<thead class="light-green lighten-3">
							<tr>
								<th hidden>ID</th>
								<th>Nombre</th>
								<th>Apellidos</th>
								<th>Email</th>
								<th>Empresa</th>
								<th>Area</th>
								<th>Tipo</th>
								<th>Accion</th>
							</tr>
						</thead>

						<tbody class="table-content tabela-conteudo">
							<?php while($row_users = mysqli_fetch_assoc($resultado)) { ?>
								<tr>
									<th hidden><?php echo $row_users['U_ID']; ?></th>
									<th><?php echo $row_users['U_NOME']; ?></th>
									<th><?php echo $row_users['U_SOBRENOME']; ?></th>
									<th><?php echo $row_users['U_EMAIL']; ?></th>
									<th><?php echo $row_users['U_EMPRESA']; ?></th>
									<th><?php echo $row_users['A_NOME']; ?></th>
									<th><?php echo $row_users['T_NOME']; ?></th>
									<th>
										<span class="d-none d-lg-block">
											<?php if($_SESSION['user_type'] > 2){ ?>
												<a href="../view/user.php?userid=<?php echo $row_users['U_ID']; ?>" class="btn btn-success btn-sm" id="btn_view_user" name="btn_view_user">Visualizar</a>
											<?php } ?>

											<?php if($_SESSION['user_type'] == 1 or $_SESSION['user_type'] == 2){ ?>
												<a href="../view/user.php?userid=<?php echo $row_users['U_ID']; ?>" class="btn btn-success btn-sm" id="btn_view_user" name="btn_view_user">Visualizar</a>
												<a href="../edit/user.php?userid=<?php echo $row_users['U_ID']; ?>" class="btn btn-warning btn-sm" id="btn_edit_user" name="btn_edit_user">Editar</a>
												<a class="btn btn-danger btn-sm" id="btn_excluir" name="btn_excluir" data-toggle="modal" data-target="#modaldelete<?php echo $row_users['U_ID']; ?>">Eliminar</a>
											<?php } ?>
										</span>

										<span class="d-block d-lg-none">
											<?php if($_SESSION['user_type'] > 2){ ?>
												<a href="../view/user.php?userid=<?php echo $row_users['U_ID']; ?>" class="btn btn-primary btn-sm" id="btn_view_user" name="btn_view_user">Visualizar</a>
											<?php } ?>

											<?php if(($_SESSION['user_type'] == 1 or $_SESSION['user_type'] == 2) AND $row_projects['P_VALIDADO'] == 0){ ?>
												<div class="btn-group">
													<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Acciones
													</button>
													<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownAction">
														<a class="dropdown-item" href="../view/user.php?userid=<?php echo $row_users['U_ID']; ?>" name="btn_view_user">Visualizar</a>
														<a class="dropdown-item" href="../edit/user.php?userid=<?php echo $row_users['U_ID']; ?>" name="btn_edit_user" >Editar</a>
														<a class="dropdown-item" name="btn_delete_user" data-toggle="modal" data-target="#modaldelete<?php echo $row_users['U_ID']; ?>">Eliminar</a>
													</div>
												</div>
											<?php } ?>
										</span>
										<!-- Modal -->
										<div class="modal fade" id="modaldelete<?php echo $row_users['U_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header bg-danger text-white">
														<h5 class="modal-title" id="eliminarProyectoLabel">Eliminar Usuario</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form action="../php/delete-user.php" method="GET" id="form-delete-user">
														<div class="modal-body">
															¿Tienes certeza que quieres eliminar el usuario?
														</div>
														<div class="modal-footer">
															<input type="hidden" name="deleteuser" value="<?php echo $row_users['U_ID']; ?>" />
															<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
															<button type="submit" class="btn btn-primary btn-ok">Eliminar</a>
														</div>
													</form>
												</div>
											</div>
										</div>
									</th>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<nav aria-label="paginacao">
						<ul class="pagination pagination-sm justify-content-center">
							<li class="page-item disabled">
								<a class="page-link" href="#" tabindex="-1">Primera</a>
							</li>
							<li class="page-item"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item active">
								<a class="page-link" href="#">3</a>
							</li>
							<li class="page-item"><a class="page-link" href="#">4</a></li>
							<li class="page-item"><a class="page-link" href="#">5</a></li>
							<li class="page-item">
								<a class="page-link" href="#">Ultima</a>
							</li>
						</ul>
					</nav>
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