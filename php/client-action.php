<?php
    class clientAction{

        function searchClients(){
            require_once('db.class.php');

			$client_name = $_POST['name'];
			$client_contact = $_POST['contact-name'];
			$client_email = $_POST['email'];
			$client_city = $_POST['city'];
			$client_state = $_POST['state'];
			$client_country = $_POST['country'];

			$sql = "SELECT * FROM clients WHERE nome LIKE '%$client_name%' AND contactname LIKE '%$client_contact%' AND email LIKE '%$client_email%' AND city LIKE '%$client_city%' AND estado LIKE '%$client_state%' AND country LIKE '%$client_country%'";

			$objDb = new db();
			$link = $objDb->conect_mysql();

			//executar a query
			if(mysqli_query($link, $sql)){
				$resultadoClient = mysqli_query($link, $sql);
			} else {
				echo 'Ningun Cliente encontrado!';
            }

            return $resultadoClient;

            die();
        }

        function selectClient($clientID){

            require_once('db.class.php');

            $objDb = new db();
            $link = $objDb->conect_mysql();

			$sql = "SELECT clients.nome C_NOME, clients.contactname C_CONTATO, clients.email C_EMAIL, clients.phone C_PHONE, users.area U_AREA, users.tipo U_TIPO, areas.nome A_NOME, typeuser.nome T_NOME FROM users LEFT JOIN areas ON users.area = areas.id LEFT JOIN typeuser ON users.tipo = typeuser.id WHERE users.id = $clientID";

            //executar a query
            if(mysqli_query($link, $sql)){

                $resultadoUser = mysqli_query($link, $sql);

            } else {

                $resultadoTask = 'null';
            }

            return $resultadoUser;

            die();
        }

        function deleteClient($clientID){

            require_once('db.class.php');

            $objDb = new db();
			$link = $objDb->conect_mysql();
            $deleted = false;

            $sql = "DELETE FROM clients WHERE id = '$clientID'";

            if ($link->query($sql)) {
                $deleted = true;

                header('location: ../home.php?clientdeleted='.$deleted);

                echo '<div class="alert alert-success" id="deleted-alert">
                Cliente eliminado con <strong>Sucesso!</strong>.
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

                header('location: ../home.php?clientdeleted='.$deleted);

                echo '<div class="alert alert-danger" id="deleted-alert">
                <strong>No</strong> fue posible eliminar el cliente!
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