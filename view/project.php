<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=2');
    }
?>

    <!DOCTYPE html>
    <html lang="es-MX">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Visualizar Proyecto</title>

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
            if(isset($_GET['projectid'])){
                require_once('../php/project-action.php');
                require_once('../php/task-action.php');

                $projID = $_GET['projectid'];
                $userID = $_SESSION['id_usuario'];

                $project_action = new projectAction();
                $selectProject = $project_action->selectProject($projID);
                $row_project = mysqli_fetch_assoc($selectProject);

                $task_action = new taskAction();
                $selectTask = $task_action->selectTaskProject($projID);
            }
        ?>
    </head>

    <body>

		<?php include "../menu-sub.php"; ?>

        <div class="container-fluid col-md-12">
            <div class="row">
                <div class="col-md-8 border-right-form border-inferior-form">
                    <h3>Visualizar Proyecto</h3>

                    <form action="../php/update-project.php" method="post" id="form-ver-projeto">
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $row_project['P_ID']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row_project['P_NOME']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="objective">Objetivo</label>
						    <textarea rows="5" maxlength="200" class="form-control" id="objective" name="objective" readonly><?php echo $row_project['P_OBJETIVO']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="cliente">Cliente</label>
                            <input type="text" class="form-control" id="cliente" name="cliente" value="<?php echo $row_project['C_NOME']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="gerente">Gerente</label>
                            <input type="text" class="form-control" id="gerente" name="gerente" value="<?php echo $row_project['U_NOME'] . ' ' . $row_project['U_SOBRENOME']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" class="form-control" id="area" name="area" value="<?php echo $row_project['A_NOME']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date-start-plan">Data Inicial Planeada</label>
                            <input type="text" class="form-control" id="date-start-plan" name="date-start-plan" value="<?php echo date_format(date_create($row_project['P_DATA_INICIAL_PLAN']), 'd-m-Y'); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date-finish-plan">Data Final Planeada</label>
                            <input type="text" class="form-control" id="date-finish-plan" name="date-finish-plan" value="<?php echo date_format(date_create($row_project['P_DATA_FINAL_PLAN']), 'd-m-Y'); ?>" readonly>
                        </div>

                         <!-- DATA DE INICIO REAL DA TAREFA, VISIVEL SOMENTE QUANDO JA FOI INICIADA -->
                        <?php if($row_project['P_DATA_INICIAL_REAL'] != '0000-00-00' ){ ?>

                            <div class="form-group">
                                <label for="date-start">Data Inicial Real</label>
                                <input type="text" class="form-control" id="date-start" name="date-start" value="<?php echo date_format(date_create($row_project['P_DATA_INICIAL_REAL']), 'd-m-Y'); ?>" readonly>
                            </div>

                            <?php } ?>

                            <!-- DATA FINAL REAL DA TAREFA, VISIVEL SOMENTE QUANDO JA FOI FINALIZADA -->
                            <?php if($row_project['P_DATA_FINAL_REAL'] != '0000-00-00' ){ ?>

                            <div class="form-group">
                                <label for="date-finish">Data Final Real</label>
                                <input type="text" class="form-control" id="date-finish" name="date-finish" value="<?php echo date_format(date_create($row_project['P_DATA_FINAL_REAL']), 'd-m-Y'); ?>" readonly>
                            </div>

                        <?php } ?>

                        <div class="row justify-content-between">
                            <div>
                                <!-- BOTAO PARA INICIAR TAREFA, VISIVEL SOMENTE QUANDO AINDA NAO FOI INICIADA -->
                                <?php if($row_project['P_DATA_INICIAL_REAL'] == '0000-00-00' and ($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_project['P_GERENTE'])){ ?>

                                    <input type="submit" value="iniciar" class="btn btn-default" id="btn_start" name="btn_start">

                                <?php } ?>

                                <!-- BOTAO PARA INICIAR TAREFA DESABILITADO, VISIVEL SOMENTE QUANDO JA FOI INICIADA -->
                                <?php if($row_project['P_DATA_INICIAL_REAL'] != '0000-00-00' and ($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_project['P_GERENTE'])){ ?>

                                    <input type="submit" value="iniciar" class="btn btn-light" id="btn_start" name="btn_start" disabled>

                                <?php } ?>

                                <!-- BOTAO PARA FINALIZAR TAREFA, VISIVEL SOMENTE QUANDO JA FOI INICIADA -->
                                <?php if($row_project['P_DATA_FINAL_REAL'] == '0000-00-00' and $row_project['P_DATA_INICIAL_REAL'] != '0000-00-00' and ($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_project['P_GERENTE'])){ ?>

                                    <input type="submit" value="finalizar" class="btn btn-default" id="btn_finish" name="btn_finish">

                                <?php } ?>

                                <!-- BOTAO PARA FINALIZAR TAREFA DESABILITADO, VISIVEL SOMENTE QUANDO AINDA NAO FOI INICIADA OU JA FINALIZADA -->
                                <?php if($row_project['P_DATA_FINAL_REAL'] != '0000-00-00' or $row_project['P_DATA_INICIAL_REAL'] == '0000-00-00' and ($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_project['P_GERENTE'])){ ?>

                                    <input type="submit" value="finalizar" class="btn btn-light" id="btn_finish" name="btn_finish" disabled>

                                <?php } ?>

                                <!-- BOTAO PARA VALIDAR TAREFA, VISIVEL SOMENTE QUANDO JA FOI FINALIZADA -->
                                <?php if($row_project['P_DATA_FINAL_REAL'] != '0000-00-00' and $row_project['P_VALIDADO'] == '0' and ($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_project['P_GERENTE'])){ ?>

                                    <input type="submit" value="validar" class="btn btn-default" id="btn_validate" name="btn_validate">

                                <?php } ?>

                                <!-- BOTAO PARA VALIDAR TAREFA, VISIVEL SOMENTE QUANDO AINDA NAO FOI FINALIZADA -->
                                <?php if(($row_project['P_DATA_FINAL_REAL'] == '0000-00-00' and ($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_project['P_GERENTE'])) or ($row_project['P_VALIDADO'] == '1' and ($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_project['P_GERENTE']))){ ?>

                                    <input type="submit" value="validar" class="btn btn-light" id="btn_validate" name="btn_validate" disabled>

                                <?php } ?>
                            </div>

                            <div>
                                <?php if(($row_project['P_VALIDADO'] == '0' and $_SESSION['id_usuario'] == $row_project['P_GERENTE']) or $_SESSION['user_type'] == 1){ ?>

                                    <a href="../edit/project.php?projectid=<?php echo $projID; ?>" class="btn btn-warning" id="btn_edit" name="btn_edit">Editar</a>
                                    <a href="../php/project-delete.php?deleteproject=<?php echo $projID; ?>" class="btn btn-danger" id="btn_delete" name="btn_delete" data-toggle="modal" data-target="#modaldelete">Eliminar</a>
                                <?php } ?>

                                <?php if($row_project['P_VALIDADO'] == '1' and $_SESSION['user_type'] != 1){ ?>

                                    <a class="btn btn-light" id="btn_edit" name="btn_edit" disabled>Editar</a>
                                    <a class="btn btn-light" id="btn_delete" name="btn_delete" disabled>Eliminar</a>
                                <?php } ?>
                                <a href="home.php" class="btn btn-primary" id="btn_cancel" name="btn_cancel">Regresar</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-4 border-inferior-form">
                    Aqui van tener infos de proyectos y tareas del usuario
                </div>
            </div>

            <div class="row justify-content-between">
                    <div>
                        <h3>Tareas</h3>
                    </div>
                    <div>
                        <button type="buttom" class="btn btn-success button-create-task" id="btn_criar_tarefa" name="btn_criar_tarefa" onclick="location.href='../register/task.php?projectid=<?php echo $row_project['P_ID']; ?>'" >Criar Tarea</button>
                    </div>
            </div>

            <div>
                <table class="table border border-success">
                    <thead class="light-green lighten-3">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th class="d-none d-sm-table-cell">Responsavel</th>
                            <th class="d-none d-lg-table-cell">Area</th>
                            <th>Inicio</th>
                            <th>Entrega</th>
                            <th>Accion</th>
                        </tr>
                    </thead>

                    <tbody class="table-content">
                        <?php while($row_task = mysqli_fetch_assoc($selectTask)) { ?>

                            <?php
                                $date1 = new DateTime("now");
                                $date2 = new DateTime($row_task['T_DATA_FINAL_PLAN']);
                                $interval = date_diff($date1, $date2);
                                $interval2 = date_diff($date2, $date1);

                                if($interval->days <= 7 and $interval->days >= 0 and $row_task['T_VALIDADO'] == 0){
                                    echo '<tr class="table-warning">';
                                }else if($date2 < $date1 and $row_task['T_VALIDADO'] == 0){
                                    echo '<tr class="table-danger">';
                                }else{ echo '<tr>'; }
                            ?>
                                <th><?php echo $row_task['T_ID']; ?></th>
                                <th><?php echo $row_task['T_NOME']; ?></th>
                                <th class="d-none d-sm-table-cell"><?php echo $row_task['U_NOME'] . ' ' . $row_task['U_SOBRENOME']; ?></th>
                                <th class="d-none d-lg-table-cell"><?php echo $row_task['A_NOME']; ?></th>
                                <th><?php echo date_format(date_create($row_task['T_DATA_INICIAL_PLAN']), 'd-m-Y'); ?></th>
                                <th><?php echo date_format(date_create($row_task['T_DATA_FINAL_PLAN']), 'd-m-Y'); ?></th>
                                <th>
                                    <span class="d-none d-lg-block">
                                        <a href="../view/task.php?taskid=<?php echo $row_task['T_ID']; ?>&projectid=<?php echo $row_project['P_ID']; ?>" class="btn btn-primary btn-sm" id="btn_view_task" name="btn_view_task">Visualizar</a>

                                        <?php if(($_SESSION['user_type'] == 1 or $_SESSION['user_type'] == 2) AND $row_project['T_VALIDADO'] == 0){ ?>
                                            <a href="../view/task.php?taskid=<?php echo $row_task['T_ID']; ?>&projectid=<?php echo $row_project['P_ID']; ?>" class="btn btn-warning btn-sm" id="btn_edit_task" name="btn_edit_task">Editar</a>
                                            <a class="btn btn-danger btn-sm" id="btn_delete_task" name="btn_delete_task" data-toggle="modal" data-target="#modaldelete<?php echo $row_task['T_ID']; ?>">Eliminar</a>
                                        <?php }?>

                                        <?php if(($_SESSION['user_type'] == 1 or $_SESSION['user_type'] == 2)  AND $row_project['T_VALIDADO'] == 1){ ?>
                                            <a class="btn btn-light btn-sm" id="btn_edit_task" name="btn_edit_task" disabled>Editar</a>
                                            <a class="btn btn-light btn-sm" id="btn_delete_task" name="btn_delete_task" disabled>Eliminar</a>
                                        <?php }?>
                                    </span>


                                    <div class="btn-group d-block d-lg-none">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownAction">
                                            <a class="dropdown-item" href="ver-tarefa.php?taskid=<?php echo $row_task['T_ID']; ?>&projectid=<?php echo $row_project['P_ID']; ?>" id="btn_view_task" name="btn_view_task">Visualizar</a>

                                            <?php if(($_SESSION['user_type'] == 1 or $_SESSION['user_type'] == 2) AND $row_project['P_VALIDADO'] == 0){ ?>
                                                <a class="dropdown-item" href="../edit/task.php?taskid=<?php echo $row_task['T_ID']; ?>&projectid=<?php echo $row_project['P_ID']; ?>" id="btn_edit_task" name="btn_edit_task" >Editar</a>
                                                <a class="dropdown-item" id="btn_delete_task" name="btn_delete_task" data-toggle="modal" data-target="#modaldelete<?php echo $row_task['T_ID']; ?>">Eliminar</a>
                                                <?php } ?>

                                            <?php if(($_SESSION['user_type'] == 1 or $_SESSION['user_type'] == 2) AND $row_project['P_VALIDADO'] == 1){ ?>
                                                <a class="dropdown-item" id="btn_editar_task" name="btn_edit_task" disabled>Editar</button>
                                                <a class="dropdown-item" id="btn_delete_task" name="btn_delete_task" disabled>Eliminar</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modaldelete<?php echo $row_task['T_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="eliminarProyectoLabel">Eliminar Pedido</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="../php/delete-task.php" method="GET" id="form-delete-project">
                                                    <div class="modal-body">
                                                        ¿Tienes certeza que quieres eliminar el proyecto?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="deletetask" value="<?php echo $row_task['T_ID']; ?>" />
                                                        <input type="hidden" name="projectid" value="<?php echo $row_project['P_ID']; ?>" />
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