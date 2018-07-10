<?php
    class taskAction{

        function selectTaskProject($projID){

            require_once('db.class.php');

            $objDb = new db();
            $link = $objDb->conect_mysql();

            $sql = "SELECT tasks.id T_ID, tasks.nome T_NOME, tasks.objetivo T_OBJETIVO, tasks.responsavel T_RESPONSAVEL, tasks.area T_AREA, tasks.data_final_plan T_DATA_FINAL_PLAN, tasks.data_inicial_plan T_DATA_INICIAL_PLAN, tasks.data_final_real T_DATA_FINAL_REAL, tasks.data_inicial_real T_DATA_INICIAL_REAL, tasks.validado T_VALIDADO, users.nome U_NOME, users.sobrenome U_SOBRENOME, areas.nome A_NOME, projects.gerente P_GERENTE FROM tasks LEFT JOIN users ON users.id = tasks.responsavel LEFT JOIN areas ON tasks.area = areas.id LEFT JOIN projects ON tasks.project_id = projects.id WHERE tasks.project_id= $projID";

            //executar a query
            if(mysqli_query($link, $sql)){

                $resultadoTask = mysqli_query($link, $sql);

            } else {

                $resultadoTask = 'null';
            }

            return $resultadoTask;

            die();
        }

        function selectTask($taskID){

            require_once('db.class.php');

            $objDb = new db();
            $link = $objDb->conect_mysql();

            $sql = "SELECT tasks.id T_ID, tasks.nome T_NOME, tasks.objetivo T_OBJETIVO, tasks.responsavel T_RESPONSAVEL, tasks.area T_AREA, tasks.data_final_plan T_DATA_FINAL_PLAN, tasks.data_inicial_plan T_DATA_INICIAL_PLAN, tasks.data_final_real T_DATA_FINAL_REAL, tasks.data_inicial_real T_DATA_INICIAL_REAL, tasks.validado T_VALIDADO, users.nome U_NOME, users.sobrenome U_SOBRENOME, areas.nome A_NOME, projects.gerente P_GERENTE FROM tasks LEFT JOIN users ON tasks.responsavel = users.id LEFT JOIN areas ON tasks.area = areas.id LEFT JOIN projects ON tasks.project_id = projects.id WHERE tasks.id= $taskID";

            //executar a query
            if(mysqli_query($link, $sql)){

                $resultadoTask = mysqli_query($link, $sql);

            } else {

                $resultadoTask = 'null';
            }

            return $resultadoTask;

            die();
        }

        function deleteTask($taskID, $projectID){

            require_once('db.class.php');

            $objDb = new db();
			$link = $objDb->conect_mysql();
            $deleted = false;

            $sql = "DELETE FROM tasks WHERE id = '$taskID'";

            if ($link->query($sql)) {

                $deleted = true;

                header('location: ../view/project.php?projectid='.$projectID.'&taskdeleted='.$deleted);

                echo '<div class="alert alert-success" id="deleted-alert">
                Tarea eliminada con <strong>Sucesso!</strong>.
                </div>';

                ?>
                <script type="text/javascript">
                    $("#deleted-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#deleted-alert").slideUp(500);
                    });
                </script>

                <?php

            } else {

                $deleted = false;

                header('location: ../view/project.php?projectid='.$projectID.'&taskdeleted='.$deleted);

                echo '<div class="alert alert-danger" id="deleted-alert">
                <strong>No</strong> fue posible eliminar la tarea!
                </div>';

                ?>
                <script type="text/javascript">
                    $("#deleted-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#deleted-alert").slideUp(500);
                    });
                </script>

                <?php
            }

            return  $deleted;

            die();
        }
    }d
?>