<?php

	require_once('db.class.php');

    $name = $_POST['name'];
    $contactname = $_POST['contact-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
	$adress = $_POST['adress'];
	$city = $_POST['city'];
	$estado = $_POST['state'];
	$country = $_POST['country'];

	if (isset($_POST['btn_save'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$email_existe = false;

		//verificar se o e-mail ja existe
		$sql = " SELECT * FROM clients WHERE nome = '$name' ";
		if($resultado_id = mysqli_query($link, $sql)) {

			$dados_cliente = mysqli_fetch_array($resultado_id);

			if(isset($dados_cliente['email'])){
				$name_existe = true;
			}
		} else { echo "No fue posible conectar en el baco de datos"; }

		if($name_existe){
			$retorno_get.= "erro=2";
			header('Location: ../register/client.php?'.$retorno_get);
			echo 'El cliente ya existe, que tal hacer una busca?';
		}

		$sql = " INSERT INTO clients(nome, contactname, email, phone, adress, city, estado, country) VALUES ('$name', '$contactname', '$email', '$phone', '$adress', '$city', '$state', '$country') ";

		//executar a query
		if(mysqli_query($link, $sql)){
			$clientID = mysqli_insert_id($link);
			$saved = true;
			header('Location: ../view/client.php?'.'clientid'.$clientID.'&saved='.$saved);
			echo 'Usuario registrado con sucesso!';
		} else {
			$retorno_get.= "erro=3";
			header('Location: ../register/client.php?'.$retorno_get);
			echo 'No fue posible crear el cliente!';
		}
	}

	if(isset($_POST['btn_cancel'])){
		header('location: ../home.php');
	}

?>