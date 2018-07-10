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
			require_once('../php/client-action.php');
			$userID = $_SESSION['id_usuario'];
			$client_action = new clientAction();
			$selectClients = $client_action->searchClients();
		?>
	</head>

	<body>

		<?php include "../menu-sub.php"; ?>

		<div class="container col-md-12">
			<div class="row">
				<div class="col-md-12">
					<h3 class="titulo-pagina">Clientes</h3>

					<table class="table border border-success">
						<thead class="light-green lighten-3">
							<tr>
								<th hidden>ID</th>
								<th>Nombre</th>
								<th>Contacto</th>
								<th>Email</th>
								<th>Telefone</th>
								<th>Ciudad</th>
								<th>Accion</th>
							</tr>
						</thead>

						<tbody class="table-content tabela-conteudo">
							<?php while($row_clients = mysqli_fetch_assoc($selectClients)) { ?>
								<tr>
									<th hidden><?php echo $row_clients['id']; ?></th>
									<th><?php echo $row_clients['nome']; ?></th>
									<th><?php echo $row_clients['contactname']; ?></th>
									<th><?php echo $row_clients['email']; ?></th>
									<th><?php echo $row_clients['phone']; ?></th>
									<th><?php echo $row_clients['city']; ?></th>
									<th>

										<span class="d-none d-lg-block">
											<?php if($_SESSION['user_type'] > 2){ ?>
												<a href="../view/client.php?clientid=<?php echo $row_clients['id']; ?>" class="btn btn-success btn-sm" id="btn_view_client" name="btn_view_client">Visualizar</a>
											<?php } ?>

											<?php if($_SESSION['user_type'] == 1 or $_SESSION['user_type'] == 2){ ?>
												<a href="../view/client.php?clientid=<?php echo $row_clients['id']; ?>" class="btn btn-success btn-sm" id="btn_view_client" name="btn_view_client">Visualizar</a>
												<a href="../edit/client.php?clientid=<?php echo $row_clients['id']; ?>" class="btn btn-warning btn-sm" id="btn_edit_client" name="btn_edit_client">Editar</a>
												<a class="btn btn-danger btn-sm" id="btn_excluir" name="btn_excluir" data-toggle="modal" data-target="#modaldelete<?php echo $row_clients['id']; ?>">Eliminar</a>
											<?php } ?>
										</span>

										<span class="d-block d-lg-none">
											<?php if($_SESSION['user_type'] > 2){ ?>
												<a href="../view/client.php?clientid=<?php echo $row_clients['id']; ?>" class="btn btn-primary btn-sm" id="btn_view_client" name="btn_view_client">Visualizar</a>
											<?php } ?>

											<?php if(($_SESSION['user_type'] == 1 or $_SESSION['user_type'] == 2) AND $row_projects['P_VALIDADO'] == 0){ ?>
												<div class="btn-group">
													<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Acciones
													</button>
													<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownAction">
														<a class="dropdown-item" href="../view/client.php?clientid=<?php echo $row_clients['id']; ?>" name="btn_view_client">Visualizar</a>
														<a class="dropdown-item" href="../edit/client.php?clientid=<?php echo $row_clients['id']; ?>" name="btn_edit_client" >Editar</a>
														<a class="dropdown-item" name="btn_delete_client" data-toggle="modal" data-target="#modaldelete<?php echo $row_clients['id']; ?>">Eliminar</a>
													</div>
												</div>
											<?php } ?>
										</span>
										<!-- Modal -->
										<div class="modal fade" id="modaldelete<?php echo $row_clients['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header bg-danger text-white">
														<h5 class="modal-title" id="eliminarProyectoLabel">Eliminar Cliente</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form action="../php/delete-client.php" method="GET" id="form-delete-client">
														<div class="modal-body">
															¿Tienes certeza que quieres eliminar el cliente?
														</div>
														<div class="modal-footer">
															<input type="hidden" name="deleteclient" value="<?php echo $row_clients['id']; ?>" />
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