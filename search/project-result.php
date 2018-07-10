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
			if(isset($_POST['btn_cancel'])){
				header('location: ../home.php');
			}

			require_once('../php/db.class.php');
			$project_name = $_POST['project-name'];
			$project_client = $_POST['project-client'];
			$project_objective = $_POST['project-objective'];
			$project_gerente = $_POST['project-gerente'];
			$project_area = $_POST['project-area'];
			$project_date_start = $_POST['project-date-start'];
			$project_date_finish = $_POST['project-date-finish'];
			$project_validated= $_POST['project-validated'];

			$sql = "SELECT projects.id P_ID, projects.gerente P_GERENTE, projects.cliente P_CLIENTE, projects.nome P_NOME, projects.objetivo P_OBJETIVO, projects.area P_AREA, projects.data_final_plan P_DATA_FINAL_PLAN, projects.data_inicial_plan P_DATA_INICIAL_PLAN, projects.data_final_real P_DATA_FINAL_REAL, projects.data_inicial_real P_DATA_INICIAL_REAL, projects.validado P_VALIDADO, users.nome U_NOME, users.sobrenome U_SOBRENOME, clients.nome C_NOME, areas.nome A_NOME FROM projects LEFT JOIN users ON projects.gerente = users.id LEFT JOIN clients ON projects.cliente = clients.id LEFT JOIN areas ON projects.area = areas.id WHERE projects.nome LIKE '%$project_name%' AND projects.cliente LIKE '%$project_client%' AND projects.objetivo LIKE '%$project_objective%' AND projects.gerente LIKE '%$project_gerente%' AND projects.area LIKE '%$project_area%' AND projects.data_inicial_plan LIKE '%$project_date_start%' AND projects.data_final_plan LIKE '%$project_date_finish%' AND projects.validado LIKE '%$project_validated%' ORDER BY projects.data_final_plan";

			$objDb = new db();
			$link = $objDb->conect_mysql();
			//executar a query
			if(mysqli_query($link, $sql)){
				$resultSelectProject = mysqli_query($link, $sql);
			} else {
				echo 'Ningun proyecto encontrado!' .$project_name;
			}
			?>
	</head>

	<body>

		<?php include "../menu-sub.php"; ?>

		<div class="container col-md-12">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="titulo-pagina">Proyectos</h3>

					<table class="table border border-success">
						<thead class="light-green lighten-3">
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Cliente</th>
								<th>Gerente</th>
								<th>Area</th>
								<th>Entrega</th>
								<th>Accion</th>
							</tr>
						</thead>

						<tbody class="table-content tabela-conteudo">
							<?php while($row_projects = mysqli_fetch_assoc($resultSelectProject)) { ?>
								<tr>
									<th><?php echo $row_projects['P_ID']; ?></th>
									<th><?php echo $row_projects['P_NOME']; ?></th>
									<th><?php echo $row_projects['C_NOME']; ?></th>
									<th><?php echo $row_projects['U_NOME'] . ' ' . $row_projects['U_SOBRENOME']; ?></th>
									<th><?php echo $row_projects['A_NOME']; ?></th>
									<th><?php echo date_format(date_create($row_projects['P_DATA_FINAL_PLAN']), 'd-m-Y'); ?></th>
									<th>
										<a href="../view/project.php?projectid=<?php echo $row_projects['P_ID']; ?>" type="buttom" class="btn btn-primary btn-sm" id="btn_visualizar" name="btn_visualizar" >Visualizar</a>

                            			<?php if($_SESSION['user_type'] == 1 or $_SESSION['user_type'] == 2){ ?>
											<a href="../edit/project.php?projectid=<?php echo $row_projects['P_ID']; ?>" class="btn btn-warning btn-sm" id="btn_edit" name="btn_edit">Editar</a>
											<a class="btn btn-danger btn-sm" id="btn_excluir" name="btn_excluir" data-toggle="modal" data-target="#modaldelete<?php echo $row_projects['P_ID']; ?>">Eliminar</a>
										<?php } ?>

										<!-- Modal -->
										<div class="modal fade" id="modaldelete<?php echo $row_projects['P_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header bg-danger text-white">
														<h5 class="modal-title" id="eliminarProyectoLabel">Eliminar Proyecto</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form action="../php/delete-project.php" method="GET" id="form-delete-project">
														<div class="modal-body">
															¿Tienes certeza que quieres eliminar el proyecto?
														</div>
														<div class="modal-footer">
															<input type="hidden" name="deleteproject" value="<?php echo $row_projects['P_ID']; ?>" />
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