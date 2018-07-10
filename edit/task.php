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
            require_once('../php/search-combobox.php');
            $popularCombobox = new comboboxPopulate();
            $colaboradores = $popularCombobox->colaboradores();
            $resultadoArea = $popularCombobox->area();

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
    </head>

    <body>
		<?php include "../menu-sub.php"; ?>

        <div class="container-fluid col-md-12">
            <div class="row">
                <div class="col-md-8 border-right-form">
                    <h3>Editar Tarea</h3>

                    <form action="../php/update-task.php" method="post" id="form-edit-task">
                        <div class="form-group">
                            <label for="task-id">ID Tarea</label>
                            <input type="text" class="form-control" id="task-id" name="task-id" value="<?php echo $taskID; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="task-project">ID Proyecto</label>
                            <input type="text" class="form-control" id="task-project" name="task-project" value="<?php echo $projID; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="task-name">Nombre</label>
                            <input type="text" class="form-control" id="task-name" name="task-name" value="<?php echo $row_task['T_NOME']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="task-objective">Objetivo</label>
						    <textarea rows="5" maxlength="500" class="form-control" placeholder="Objetivo" id="task-objective" name="task-objective" required><?php echo $row_task['T_OBJETIVO']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="task-responsable">Responsable</label>
                            <select name="task-responsable" id="task-responsable" class="form-control" required>
                                <option value="<?php echo $row_task['T_RESPONSAVEL']; ?>"><?php echo $row_task['U_NOME'] . ' ' . $row_task['U_SOBRENOME']; ?></option>
                                <?php while($row_colaboradores = mysqli_fetch_assoc($colaboradores)) { ?>
                                    <option value="<?php echo $row_colaboradores['id']; ?>"><?php echo $row_colaboradores['nome'] . ' ' . $row_colaboradores['sobrenome']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="task-area">Area</label>
                            <select name="task-area" id="task-area" class="form-control" required>
                                <option value="<?php echo $row_task['T_AREA']; ?>"><?php echo $row_task['A_NOME']; ?></option>
                                <?php while($row_area = mysqli_fetch_assoc($resultadoArea)) { ?>
                                    <option value="<?php echo $row_area['id']; ?>"><?php echo $row_area['nome']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!--VERIFICA SE JA FOI INICIADO O PROJETO PARA PERMITIR ALTERAR DATA INICIAL -->
                        <?php if($row_task['T_DATA_INICIAL_REAL'] == '0000-00-00' ){ ?>
                            <div class="form-group">
                                <label for="task-date-start-plan">Data Inicial Planeada</label>
                                <input type="date" class="form-control" id="task-date-start-plan" name="task-date-start-plan" value="<?php echo date_format(date_create($row_task['T_DATA_INICIAL_PLAN']), 'd-m-Y'); ?>">
                            </div>
                        <?php } ?>

                        <?php if($row_task['T_DATA_INICIAL_REAL'] != '0000-00-00' ){ ?>
                            <div class="form-group">
                                <label for="task-date-start-plan">Data Inicial Planeada</label>
                                <input type="date" class="form-control" id="task-date-start-plan" name="task-date-start-plan" value="<?php echo date_format(date_create($row_task['T_DATA_INICIAL_PLAN']), 'd-m-Y'); ?>" readonly>
                            </div>
                        <?php } ?>

                        <!--VERIFICA SE JA FOI INICIADO O PROJETO PARA PERMITIR ALTERAR DATA INICIAL -->
                        <?php if($row_task['T_DATA_INICIAL_REAL'] == '0000-00-00' ){ ?>
                            <div class="form-group">
                                <label for="task-date-start-plan">Data Final Planeada</label>
                                <input type="date" class="form-control" id="task-date-start-plan" name="task-date-start-plan" value="<?php echo date_format(date_create($row_task['T_DATA_FINAL_PLAN']), 'd-m-Y'); ?>">
                            </div>
                        <?php } ?>

                        <?php if($row_task['T_DATA_INICIAL_REAL'] != '0000-00-00' ){ ?>
                            <div class="form-group">
                                <label for="task-date-start-plan">Data Final Planeada</label>
                                <input type="date" class="form-control" id="task-date-start-plan" name="task-date-start-plan" value="<?php echo date_format(date_create($row_task['T_DATA_FINAL_PLAN']), 'd-m-Y'); ?>" readonly>
                            </div>
                        <?php } ?>

                        <!-- DATA DE INICIO REAL DA TAREFA, VISIVEL SOMENTE QUANDO JA FOI INICIADA -->
                        <?php if($row_task['T_DATA_INICIAL_REAL'] != '0000-00-00' ){ ?>

                            <div class="form-group">
                                <label for="project-date-start">Data Inicial Real</label>
                                <input type="text" class="form-control" id="project-date-start" name="project-date-start" value="<?php echo date_format(date_create($row_task['T_DATA_INICIAL_REAL']), 'd-m-Y'); ?>" readonly>
                            </div>
                            <?php } ?>

                            <!-- DATA FINAL REAL DA TAREFA, VISIVEL SOMENTE QUANDO JA FOI FINALIZADA -->
                        <?php if($row_task['T_DATA_FINAL_REAL'] != '0000-00-00' ){ ?>

                            <div class="form-group">
                                <label for="project-date-finish">Data Final Real</label>
                                <input type="text" class="form-control" id="project-date-finish" name="project-date-finish" value="<?php echo date_format(date_create($row_task['T_DATA_FINAL_REAL']), 'd-m-Y'); ?>" readonly>
                            </div>
                        <?php } ?>

                        <div class="row justify-content-between">
                            <div>
                                <!-- BOTAO PARA VOLTAR INICIAR PROJETO, VISIVEL SOMENTE QUANDO AINDA NAO FOI INICIADA -->
                                <?php if($row_task['T_DATA_INICIAL_REAL'] != '0000-00-00' and $row_task['T_DATA_FINAL_REAL'] == '0000-00-00' and ($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_task['P_GERENTE'])){ ?>

                                    <input type="submit" value="Cancelar Iniciar" class="btn btn-primary" id="btn_remove_start" name="btn_remove_start">

                                <?php } ?>

                                <!-- BOTAO PARA VOLTAR INICIAR PROJETO DESABILITADO, VISIVEL SOMENTE QUANDO JA FOI INICIADA -->
                                <?php if(($row_task['T_DATA_INICIAL_REAL'] == '0000-00-00' or $row_task['T_DATA_FINAL_REAL'] != '0000-00-00') and ($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_task['P_GERENTE'])){ ?>

                                    <input type="submit" value="Cancelar Iniciar" class="btn btn-light" id="btn_remove_start" name="btn_remove_start" disabled>

                                <?php } ?>

                                <!-- BOTAO PARA VOLTAR FINALIZAR PROJETO, VISIVEL SOMENTE QUANDO JA FOI INICIADA -->
                                <?php if($row_task['T_DATA_FINAL_REAL'] != '0000-00-00' and $row_task['T_VALIDADO'] == '0' and ($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_task['P_GERENTE'])){ ?>

                                    <input type="submit" value="Cancelar Finalizar" class="btn btn-primary" id="btn_remove_finish" name="btn_remove_finish">

                                <?php } ?>

                                <!-- BOTAO PARA VOLTAR FINALIZAR PROJETO DESABILITADO, VISIVEL SOMENTE QUANDO AINDA NAO FOI INICIADA OU JA FINALIZADA -->
                                <?php if($row_task['T_VALIDADO'] == '1' or ($row_task['T_DATA_FINAL_REAL'] == '0000-00-00' and ($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_task['P_GERENTE']))){ ?>

                                    <input type="submit" value="Cancelar Finalizar" class="btn btn-light" id="btn_remove_finish" name="btn_remove_finish" disabled>

                                <?php } ?>

                                <!-- BOTAO PARA VOLTAR VALIDAR PROJETO, VISIVEL SOMENTE QUANDO JA FOI FINALIZADA -->
                                <?php if(($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_task['P_GERENTE']) and $row_task['T_VALIDADO'] == '1' and $row_task['T_DATA_FINAL_REAL'] != '0000-00-00'){ ?>

                                    <input type="submit" value="Cancelar Validar" class="btn btn-primary" id="btn_remove_validate" name="btn_remove_validate">

                                <?php } ?>

                                <!-- BOTAO PARA VOLTAR VALIDAR PROJETO, VISIVEL SOMENTE QUANDO AINDA NAO FOI FINALIZADA -->
                                <?php if(($_SESSION['user_type'] == 1 or $_SESSION['id_usuario'] == $row_task['P_GERENTE']) and ($row_task['T_VALIDADO'] == '0')){ ?>

                                    <input type="submit" value="Cancelar Validar" class="btn btn-light" id="btn_remove_validate" name="btn_remove_validate" disabled>

                                <?php } ?>
                            </div>

                            <div class="justify-content-end">
                                <button type="submit" class="btn btn-primary" id="btn_save" name="btn_save">Guardar</button>
                                <button type="buttom" class="btn btn-light" id="btn_cancel" name="btn_cancel">Cancelar</button>
                            </div>
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