<?php
    class projectAction {


        function selectAllProjects($start, $quant_result_pg){

            require_once('db.class.php');

            $sql = "SELECT projects.id P_ID, projects.gerente P_GERENTE, projects.cliente P_CLIENTE, projects.nome P_NOME, projects.area P_AREA, projects.data_final_plan P_DATA, projects.validado P_VALIDADO, areas.nome A_NOME, users.nome U_NOME, users.sobrenome U_SOBRENOME, clients.nome C_NOME FROM projects LEFT JOIN areas ON projects.area = areas.id LEFT JOIN users ON projects.gerente = users.id LEFT JOIN clients ON projects.cliente = clients.id ORDER BY projects.data_final_plan LIMIT $start, $quant_result_pg";

            $objDb = new db();
            $link = $objDb->conect_mysql();

            //executar a query
            if(mysqli_query($link, $sql)){

                $resultSelectProject = mysqli_query($link, $sql);

            } else {

                $resultSelectProject = "null";

                echo '<div class="alert alert-alert" id="ningun-proyecto-alert">
                No hay proyectos registrados!
                </div>';

                ?>
                <script type="text/javascript">
                    $("#ningun-proyecto-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#ningun-proyecto-alert").slideUp(500);
                    });
                </script>

            <?php

            }

            return $resultSelectProject;
        }

        function selectAllProjectsValidados($validado, $start, $quant_result_pg){

            require_once('db.class.php');

            $sql = "SELECT projects.id P_ID, projects.gerente P_GERENTE, projects.cliente P_CLIENTE, projects.nome P_NOME, projects.area P_AREA, projects.data_final_plan P_DATA, projects.validado P_VALIDADO, areas.nome A_NOME, users.nome U_NOME, users.sobrenome U_SOBRENOME, clients.nome C_NOME FROM projects JOIN areas ON projects.area = areas.id LEFT JOIN users ON projects.gerente = users.id LEFT JOIN clients ON projects.cliente = clients.id WHERE validado = $validado ORDER BY projects.data_final_plan LIMIT $start, $quant_result_pg";

            $objDb = new db();
            $link = $objDb->conect_mysql();

            //executar a query
            if(mysqli_query($link, $sql)){

                $resultSelectProject = mysqli_query($link, $sql);

            } else {

                $resultSelectProject = "null";

                echo '<div class="alert alert-alert" id="ningun-proyecto-alert">
                No hay proyectos registrados!
                </div>';

                ?>
                <script type="text/javascript">
                    $("#ningun-proyecto-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#ningun-proyecto-alert").slideUp(500);
                    });
                </script>

            <?php

            }

            return $resultSelectProject;
        }

        function selectUserProjects($userID){

            require_once('db.class.php');

            $sql = "SELECT projects.id P_ID, projects.gerente P_GERENTE, projects.cliente P_CLIENTE, projects.nome P_NOME, projects.area P_AREA, projects.data_final_plan P_DATA, projects.validado P_VALIDADO, areas.nome A_NOME, users.nome U_NOME, users.sobrenome U_SOBRENOME, clients.nome C_NOME FROM projects LEFT JOIN areas ON projects.area = areas.id LEFT JOIN users ON projects.gerente = users.id LEFT JOIN clients ON projects.cliente = clients.id WHERE users.id = $userID ORDER BY projects.data_final_plan";

            $objDb = new db();
            $link = $objDb->conect_mysql();

            //executar a query
            if(mysqli_query($link, $sql)){

                $resultSelectProject = mysqli_query($link, $sql);

            } else {

                $resultSelectProject = "null";

                echo '<div class="alert alert-alert" id="ningun-proyecto-alert">
                No hay proyectos registrados!
                </div>';

                ?>
                <script type="text/javascript">
                    $("#ningun-proyecto-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#ningun-proyecto-alert").slideUp(500);
                    });
                </script>

            <?php

            }

            return $resultSelectProject;
        }

        function selectUserProjectsValidados($userID, $validado){

            require_once('db.class.php');

            $sql = "SELECT projects.id P_ID, projects.gerente P_GERENTE, projects.cliente P_CLIENTE, projects.nome P_NOME, projects.area P_AREA, projects.data_final_plan P_DATA, projects.validado P_VALIDADO, areas.nome A_NOME, users.nome U_NOME, users.sobrenome U_SOBRENOME, clients.nome C_NOME FROM projects JOIN areas ON projects.area = areas.id LEFT JOIN users ON projects.gerente = users.id LEFT JOIN clients ON projects.cliente = clients.id WHERE users.id = $userID AND validado = $validado ORDER BY projects.data_final_plan";

            $objDb = new db();
            $link = $objDb->conect_mysql();

            //executar a query
            if(mysqli_query($link, $sql)){

                $resultSelectProject = mysqli_query($link, $sql);

            } else {

                $resultSelectProject = "null";

                echo '<div class="alert alert-alert" id="ningun-proyecto-alert">
                No hay proyectos registrados!
                </div>';

                ?>
                <script type="text/javascript">
                    $("#ningun-proyecto-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#ningun-proyecto-alert").slideUp(500);
                    });
                </script>

            <?php

            }

            return $resultSelectProject;
        }

        function selectProject($projID){

            require_once('db.class.php');

            $sql = "SELECT projects.id P_ID, projects.gerente P_GERENTE, projects.cliente P_CLIENTE, projects.nome P_NOME, projects.objetivo P_OBJETIVO, projects.area P_AREA, projects.data_final_plan P_DATA_FINAL_PLAN, projects.data_inicial_plan P_DATA_INICIAL_PLAN, projects.data_final_real P_DATA_FINAL_REAL, projects.data_inicial_real P_DATA_INICIAL_REAL, projects.validado P_VALIDADO, users.nome U_NOME, users.sobrenome U_SOBRENOME, clients.nome C_NOME, areas.nome A_NOME  FROM projects LEFT JOIN users ON projects.gerente = users.id LEFT JOIN clients ON projects.cliente = clients.id LEFT JOIN areas ON projects.area = areas.id WHERE projects.id = $projID ORDER BY projects.data_final_plan";

            $objDb = new db();
            $link = $objDb->conect_mysql();

            //executar a query
            if(mysqli_query($link, $sql)){

                $resultado = mysqli_query($link, $sql);

                echo '<div class="alert alert-success" id="success-alert">
                Proyecto cargado con <strong>Suceso!</strong>
                </div>';

                ?>
                <script type="text/javascript">
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#success-alert").slideUp(500);
                    });
                </script>

                <?php

            } else {

                $resultado = 'null';

                echo '<div class="alert alert-danger" id="no-project-alert">
                No fue possible cargar las informaciones del Proyecto!
                </div>';

                ?>
                <script type="text/javascript">
                    $("#no-project-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#no-project-alert").slideUp(500);
                    });
                </script>

                <?php
            }

            return $resultado;

        }

        function savedProject($saved){

            if($saved == 1){

            echo '<div class="alert alert-success" id="saved-alert">
                Tarea guardada con <strong>Sucesso! </strong>.
                </div>';

            ?>
            <script type="text/javascript">
                $("#saved-alert").fadeTo(2000, 500).slideUp(500, function(){
                    $("#saved-alert").slideUp(500);
                });
            </script>

            <?php
            }

            if($saved=0){
                echo '<div class="alert alert-danger" id="saved-alert">
                No fue posible guardar la tarea!</strong>.
                </div>';

            ?>
            <script type="text/javascript">
                $("#saved-alert").fadeTo(2000, 500).slideUp(500, function(){
                    $("#saved-alert").slideUp(500);
                });
            </script>

            <?php
            }
        }

        function deleteProject($projID){

            require_once('db.class.php');

            $objDb = new db();
			$link = $objDb->conect_mysql();
            $deleted = false;

            $sql = "DELETE FROM projects WHERE id = $projID";

            if ($link->query($sql)) {
                $deleted = true;

                header('location: ../home.php?projectdeleted='.$deleted);

                echo '<div class="alert alert-success" id="deleted-alert">
                Proyecto eliminado con <strong>Sucesso! </strong>.
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

                header('location: ../home.php?projectdeleted='.$deleted);

                echo '<div class="alert alert-danger" id="deleted-alert">
                <strong>No</strong> fue posible eliminar el Proyecto!
                </div>';

                ?>
                <script type="text/javascript">
                    $("#deleted-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#deleted-alert").slideUp(500);
                    });
                </script>

                <?php
            }

            die();
        }
    }

?>