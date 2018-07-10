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
        <title>Visualizar Tarea</title>

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
            if(isset($_GET['taskid'])){
                require_once('../php/task-action.php');

                $projID = $_GET['projectid'];
                $taskID = $_GET['taskid'];
                $userID = $_SESSION['id_usuario'];

                $task_action = new taskAction();
                $selectTask = $task_action->selectTask($taskID);
                $row_task = mysqli_fetch_assoc($selectTask);
            }
        ?>

        <div class="container-fluid col-sm-12">
            <div class="row">
                <div class="col-sm-8 border-right-form">
                    <h3>Visualizar Tarea</h3>

                    <form action="../php/update-task.php" method="post" id="form-ver-tarefa">
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $taskID; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="project">ID Proyecto</label>
                            <input type="text" class="form-control" id="project" name="project" value="<?php echo $projID; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row_task['T_NOME']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="objective">Objetivo</label>
						    <textarea rows="5" maxlength="500" class="form-control" id="objective" name="objective" readonly><?php echo $row_task['T_OBJETIVO']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="responsavel">Responsavel</label>
                            <input type="text" class="form-control" id="responsavel" name="responsavel" value="<?php echo $row_task['U_NOME'] . ' ' . $row_task['U_SOBRENOME']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" class="form-control" id="area" name="area" value="<?php echo $row_task['A_NOME']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date-start">Data Inicial Planeada</label>
                            <input type="text" class="form-control" id="date-start" name="date-start" value="<?php echo date_format(date_create($row_task['T_DATA_INICIAL_PLAN']), 'd-m-Y'); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date-finish">Data Final Planeada</label>
                            <input type="text" class="form-control" id="date-finish" name="date-finish" value="<?php echo date_format(date_create($row_task['T_DATA_FINAL_PLAN']), 'd-m-Y'); ?>" readonly>
                        </div>

                        <!-- DATA DE INICIO REAL DA TAREFA, VISIVEL SOMENTE QUANDO JA FOI INICIADA -->
                        <?php if($row_task['T_DATA_INICIAL_REAL'] != '0000-00-00' ){ ?>

                            <div class="form-group">
                                <label for="date-start">Data Inicial Real</label>
                                <input type="text" class="form-control" id="date-start" name="date-start" value="<?php echo date_format(date_create($row_task['T_DATA_INICIAL_REAL']), 'd-m-Y'); ?>" readonly>
                            </div>

                        <?php } ?>

                        <!-- DATA FINAL REAL DA TAREFA, VISIVEL SOMENTE QUANDO JA FOI FINALIZADA -->
                        <?php if($row_task['T_DATA_FINAL_REAL'] != '0000-00-00' ){ ?>

                            <div class="form-group">
                                <label for="date-finish">Data Final Real</label>
                                <input type="text" class="form-control" id="date-finish" name="date-finish" value="<?php echo date_format(date_create($row_task['T_DATA_FINAL_REAL']), 'd-m-Y'); ?>" readonly>
                            </div>

                        <?php } ?>

                        <div class="row justify-content-between">
                            <div>
                                <!-- BOTAO PARA INICIAR TAREFA, VISIVEL SOMENTE QUANDO AINDA NAO FOI INICIADA -->
                                <?php if($row_task['T_DATA_INICIAL_REAL'] == '0000-00-00'){ ?>

                                    <input type="submit" value="iniciar" class="btn btn-default" id="btn_start" name="btn_start">

                                <?php } ?>

                                <!-- BOTAO PARA INICIAR TAREFA DESABILITADO, VISIVEL SOMENTE QUANDO JA FOI INICIADA -->
                                <?php if($row_task['T_DATA_INICIAL_REAL'] != '0000-00-00'){ ?>

                                    <input type="submit" value="iniciar" class="btn btn-light" id="btn_start" name="btn_start" disabled>

                                <?php } ?>

                                <!-- BOTAO PARA FINALIZAR TAREFA, VISIVEL SOMENTE QUANDO JA FOI INICIADA -->
                                <?php if($row_task['T_DATA_FINAL_REAL'] == '0000-00-00' and $row_task['T_DATA_INICIAL_REAL'] != '0000-00-00'){ ?>

                                    <input type="submit" value="finalizar" class="btn btn-default" id="btn_finish" name="btn_finish">

                                <?php } ?>

                                <!-- BOTAO PARA FINALIZAR TAREFA DESABILITADO, VISIVEL SOMENTE QUANDO AINDA NAO FOI INICIADA OU JA FINALIZADA -->
                                <?php if($row_task['T_DATA_FINAL_REAL'] != '0000-00-00' or $row_task['T_DATA_INICIAL_REAL'] == '0000-00-00'){ ?>

                                    <input type="submit" value="finalizar" class="btn btn-light" id="btn_finish" name="btn_finish" disabled>

                                <?php } ?>

                                <!-- BOTAO PARA VALIDAR TAREFA, VISIVEL SOMENTE QUANDO JA FOI FINALIZADA -->
                                <?php if($row_task['T_DATA_FINAL_REAL'] != '0000-00-00' and $row_task['T_VALIDADO'] == '0'){ ?>

                                    <input type="submit" value="validar" class="btn btn-default" id="btn_validate" name="btn_validate">

                                <?php } ?>

                                <!-- BOTAO PARA VALIDAR TAREFA, VISIVEL SOMENTE QUANDO AINDA NAO FOI FINALIZADA -->
                                <?php if(($row_task['T_DATA_FINAL_REAL'] == '0000-00-00' and ($_SESSION['user_type'] == 0 or $_SESSION['user_type'] == 1)) or ($row_task['T_VALIDADO'] == '1' and ($_SESSION['user_type'] == 0 or $_SESSION['user_type'] == 1))){ ?>

                                    <input type="submit" value="validar" class="btn btn-light" id="btn_validate" name="btn_validate" disabled>

                                <?php } ?>
                            </div>

                            <div>
                                <?php if(($row_task['T_VALIDADO'] == '0' and $_SESSION['id_usuario'] == $row_task['P_GERENTE']) or $_SESSION['user_type'] == 1){ ?>
                                    <a href="../edit/task.php?projectid=<?php echo $projID; ?>&taskid=<?php echo $taskID; ?>" class="btn btn-warning" id="btn_edit" name="btn_edit">Editar</a>
                                    <a href="../view/task.php?projectid=<?php echo $projID; ?>&deletetask=<?php echo $taskID; ?>" class="btn btn-danger" id="btn_delete" name="btn_delete" data-toggle="modal" data-target="#modaldelete">Eliminar</a>
                                <?php } ?>

                                <?php if($row_task['T_VALIDADO'] == '1' and $_SESSION['user_type'] !=1){ ?>
                                    <a class="btn btn-light" id="btn_edit" name="btn_edit" disabled>Editar</a>
                                    <a class="btn btn-light" id="btn_delete" name="btn_delete" disabled>Eliminar</a>
                                <?php } ?>

                                <a href="../view/project.php?projectid=<?php echo $projID; ?>" class="btn btn-primary" id="btn_back" name="btn_back">Regresar</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 border-inferior-form">
                    Aqui van tener infos de proyectos y tareas del usuario
                </div>
            </div>
        </div>

		<!-- Modal -->
		<div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-danger text-white">
						<h5 class="modal-title" id="eliminarProyectoLabel">Eliminar Pedido</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						¿Tienes certeza que quieres eliminar la tarea?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-primary btn-ok">Eliminar</button>
					</div>
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