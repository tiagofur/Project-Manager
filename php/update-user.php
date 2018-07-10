<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: index.php?erro=1');
}

	require_once('db.class.php');

	$user_conected = $_SESSION['id_usuario'];
	$user_id = $_POST['id'];
	$user_name = $_POST['name'];
	$user_last_name = $_POST['last-name'];
	$user_email = $_POST['email'];
	$user_empresa = $_POST['empresa'];
	$user_area = $_POST['area'];
	$user_type = $_POST['tipo'];

	if (isset($_POST['btn_save'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$saved= false;

		$sql = "UPDATE users SET changed = '$user_conected', date_changed = NOW(), nome = '$user_name', sobrenome = '$user_last_name', email = '$user_email', empresa = '$user_empresa', area = '$user_area', tipo = '$user_type' WHERE id = '$user_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../view/user.php?userid=' .$user_id .'&userupdatesucess=1');

		} else {

			header('location: ../view/user.php?userid=' .$user_id .'&userupdateerror= 1');
		}
		die();
	}

	if(isset($_POST['btn_cancel'])){
		header('location: ../view/user.php?userid=' .$user_id);
	}

?>