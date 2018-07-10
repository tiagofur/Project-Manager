<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$user_conected = $_SESSION['id_usuario'];
	$client_id = $_POST['id'];
	$client_name = $_POST['name'];
	$client_contact_name = $_POST['contact-name'];
	$client_email = $_POST['email'];
	$client_phone = $_POST['phone'];
	$client_adress = $_POST['adress'];
	$client_city = $_POST['city'];
	$client_state = $_POST['state'];
	$client_country = $_POST['country'];

	if (isset($_POST['btn_save'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$sql = " UPDATE clients SET changed = '$user_conected', date_changed = NOW(), nome = '$client_name', contactname = '$client_contact_name', email = '$client_email', phone = '$client_phone', adress = '$client_adress', city = '$client_city', estado = '$client_state', country = '$client_country' WHERE id = $client_id ";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../view/client.php?clientid=' .$client_id .'&clientupdatesucess=1');

		} else {

			header('location: ../view/client.php?clientid=' .$client_id .'&clientupdateerror= 1');

		}

		die();

	}else{
		header('location: ../view/client.php?clientid=' .$client_id);
		echo 'No fue posible actualizar el cliente';
	}

	if(isset($_POST['btn_cancel'])){
		header('location: ../view/client.php?clientid=' .$client_id);
	}

?>