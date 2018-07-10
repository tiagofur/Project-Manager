<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: index.php?erro=2');
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

		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- Material Design Bootstrap -->
		<link href="css/mdb.min.css" rel="stylesheet">
		<!-- Your custom styles (optional) -->
		<link href="css/style.css" rel="stylesheet">
		<link href="css/style-pm.css" rel="stylesheet">

		<?php
			//receber numero da pagina
			$actual_page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
			$page = (!empty($actual_page)) ? $actual_page : 1;
			//quantidade de itens por pagina
			$quant_result_pg = 1;

			//calcular o inicio visualizacao
			$start = ($quant_result_pg * $page) - $quant_result_pg;

			require_once('php/project-action.php');
			$userID = $_SESSION['id_usuario'];
			$project_action = new projectAction();
			$selectProjects = $project_action->selectAllProjectsValidados(0, $start, $quant_result_pg);
        ?>
	</head>

	<body>

		<?php include "menu.php"; ?>

		<div class="container col-md-12">
			<div class="row">
				<div class="col-md-12">
					<h3 class="titulo-pagina">Proyectis en Desarrollo</h3>

				<?php	if(($selectProjects) AND ($selectProjects->num_rows != 0)){ ?>

					<table class="table border border-success">
						<thead class="light-green lighten-3">
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Cliente</th>
								<th class="d-none d-sm-table-cell">Gerente</th>
								<th class="d-none d-lg-table-cell">Area</th>
								<th>Entrega</th>
								<th>Accion</th>
							</tr>
						</thead>

						<tbody class="table-content tabela-conteudo">
							<?php while($row_projects = mysqli_fetch_assoc($selectProjects)) { ?>

								<?php
									$date1 = new DateTime("now");
									$date2 = new DateTime($row_projects['P_DATA']);
									$interval = date_diff($date1, $date2);
									$interval2 = date_diff($date2, $date1);

									if($interval->days <= 7 and $interval->days >= 0 and $row_projects['P_VALIDADO'] == 0){
										echo '<tr class="table-warning">';
									}else if($date2 < $date1 and $row_projects['P_VALIDADO'] == 0){
										echo '<tr class="table-danger">';
									}else{ echo '<tr>'; }
								?>
									<th><?php echo $row_projects['P_ID']; ?></th>
									<th><?php echo $row_projects['P_NOME']; ?></th>
									<th><?php echo $row_projects['C_NOME']; ?></th>
									<th class="d-none d-sm-table-cell"><?php echo $row_projects['U_NOME'] . ' ' . $row_projects['U_SOBRENOME']; ?></th>
									<th class="d-none d-lg-table-cell"><?php echo $row_projects['A_NOME']; ?></th>
									<th><?php echo date_format(date_create($row_projects['P_DATA']), 'd-m-Y'); ?></th>
									<th>
										<span class="d-none d-lg-block">
											<a href="view/project.php?projectid=<?php echo $row_projects['P_ID']; ?>" class="btn btn-success btn-sm" id="btn_visualizar_project" name="btn_visualizar_project">Visualizar</a>

											<?php if(($_SESSION['user_type'] == 1 or $_SESSION['user_type'] == 2) AND $row_projects['P_VALIDADO'] == 0){ ?>
												<a href="edit/project.php?projectid=<?php echo $row_projects['P_ID']; ?>" class="btn btn-warning btn-sm" id="btn_editar_project" name="btn_editar_project">Editar</a>
												<a class="btn btn-danger btn-sm" id="btn_excluir_project" name="btn_excluir_project" data-toggle="modal" data-target="#modaldelete<?php echo $row_projects['P_ID']; ?>">Eliminar</a>
											<?php } ?>
										</span>

										<span class="d-block d-lg-none">
											<?php if($_SESSION['user_type'] > 2 or $row_projects['P_VALIDADO'] == 1){ ?>
													<a href="view/project.php?projectid=<?php echo $row_projects['P_ID']; ?>" class="btn btn-success btn-sm" id="btn_visualizar_project" name="btn_visualizar_project">Visualizar</a>
											<?php } ?>

											<?php if(($_SESSION['user_type'] == 1 or $_SESSION['user_type'] == 2) AND $row_projects['P_VALIDADO'] == 0){ ?>
												<div class="btn-group">
													<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														Acciones
													</button>
													<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownAction">
														<a class="dropdown-item" href="view/project.php?projectid=<?php echo $row_projects['P_ID']; ?>" name="btn_visualizar_project">Visualizar</a>
														<a class="dropdown-item" href="edit/project.php?projectid=<?php echo $row_projects['P_ID']; ?>" name="btn_editar_project" >Editar</a>
														<a class="dropdown-item" href="php/delete-project.php?deleteproject=<?php echo $row_projects['P_ID']; ?>" name="btn_excluir_project" data-target="#modaldelete<?php echo $row_projects['P_ID']; ?>">Eliminar</a>
													</div>
												</div>
											<?php } ?>
										</span>
										<!-- Modal -->
										<div class="modal fade" id="modaldelete<?php echo $row_projects['P_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header bg-danger text-white">
														<h5 class="modal-title" id="eliminarProyectoLabel">Eliminar Pedido</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form action="php/delete-project.php" method="GET" id="form-delete-project">
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

					<?php
						}else{
							echo "Error ao selecionar Proyectos";
						}

						require_once('php/db.class.php');

						$quant_total = "SELECT COUNT(id) AS NUM_RESULT FROM projects WHERE validado = 0";

						$objDb = new db();
						$link = $objDb->conect_mysql();

						$result_pg = mysqli_query($link, $quant_total);
						$row_pg = mysqli_fetch_assoc($result_pg);
						//echo $row_pg['NUM_RESULT'];
						$quant_pg = ceil($row_pg['NUM_RESULT'] / $quant_result_pg);
						//limitar quantodade de link antes e depois da pagina atual
						$max_links = 2;

						echo "<nav aria-label='pagination'>";
						echo "<ul class='pagination pg-pg-bluegrey pagination-sm justify-content-center'>";
						echo "<li class='page-item'>";
						echo "<a class='page-link' href='http://creapolis.mx/project-manager/home-activos.php?page=1' tabindex='-1'>Primera</a>";
						echo "</li>";

						for($page_before = $page - $max_links; $page_before <= $page -1; $page_before++){
							if($page_before >= 1){
								echo "<li class='page-item'><a class='page-link' href='http://creapolis.mx/project-manager/home-activos.php?page=".$page_before."'>".$page_before."</a></li>";
							}
						}

						echo "<li class='page-item active'>";
						echo "<a class='page-link' href='#'>".$page."</a>";
						echo "</li>";

						for($page_after = $page + 1; $page_after <= $page +$max_links; $page_after++){
							if($page_after <= $quant_pg){
								echo "<li class='page-item'><a class='page-link' href='http://creapolis.mx/project-manager/home-activos.php?page=".$page_after."'>".$page_after."</a></li>";
							}
						}

						echo "<li class='page-item'>";
						echo "<a class='page-link' href='http://creapolis.mx/project-manager/home-activos.php?page=".$quant_pg."'>Ultima</a>";
						echo "</li>";
						echo "</ul>";
						echo "</nav>";
					?>
				</div>
			</div>
		</div>

		<?php include "footer.php"; ?>

		<!-- SCRIPTS -->
		<!-- JQuery -->
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<!-- Bootstrap tooltips -->
		<script type="text/javascript" src="js/popper.min.js"></script>
		<!-- Bootstrap core JavaScript -->
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<!-- MDB core JavaScript -->
		<script type="text/javascript" src="js/mdb.min.js"></script>
	</body>
</html>