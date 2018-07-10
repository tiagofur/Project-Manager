<?php
    class userAction{

        function selectUser($userID){

            require_once('db.class.php');

            $objDb = new db();
            $link = $objDb->conect_mysql();

			$sql = "SELECT users.nome U_NOME, users.sobrenome U_SOBRENOME, users.email U_EMAIL, users.empresa U_EMPRESA, users.area U_AREA, users.tipo U_TIPO, areas.nome A_NOME, typeuser.nome T_NOME FROM users LEFT JOIN areas ON users.area = areas.id LEFT JOIN typeuser ON users.tipo = typeuser.id WHERE users.id = $userID";

            //executar a query
            if(mysqli_query($link, $sql)){

                $resultadoUser = mysqli_query($link, $sql);

            } else {

                $resultadoTask = 'null';
            }

            return $resultadoUser;

            die();
        }

        function deleteUser($userID){

            require_once('db.class.php');

            $objDb = new db();
			$link = $objDb->conect_mysql();
            $deleted = false;

            $sql = "DELETE FROM users WHERE id = '$userID'";

            if ($link->query($sql)) {
                $deleted = true;

                header('location: ../home.php?userdeleted='.$deleted);

                echo '<div class="alert alert-success" id="deleted-alert">
                Usuario eliminado con <strong>Sucesso!</strong>.
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

                header('location: ../home.php?userdeleted='.$deleted);

                echo '<div class="alert alert-danger" id="deleted-alert">
                <strong>No</strong> fue posible eliminar el usuario!
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