<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: index.php?erro=1');
}

	require_once('db.class.php');

	$user_conected = $_SESSION['id_usuario'];
	$area_id = $_POST['id'];
	$area_name = $_POST['name'];
	$area_gerente = $_POST['gerente'];

	if (isset($_POST['btn_save'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$saved= false;

		$sql = "UPDATE areas SET changed = '$user_conected', date_changed = NOW(), nome = '$area_name', gerente = '$area_gerente' WHERE id = '$area_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../view/area.php?areaid=' .$area_id .'&areaupdatesucess=1');
		} else {

			header('location: ../view/area.php?areaid=' .$area_id .'&areaupdateerror= 1');
		}

		die();
	}

	if(isset($_POST['btn_cancel'])){
		header('location: ../view/area.php?areaid=' .$area_id);
	}

?>