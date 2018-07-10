<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=2');
	}

	$project_creator = $_SESSION['id_usuario'];

	if (isset($_GET['deleteclient'])){

		$deleteid = $_GET['deleteclient'];
		require_once('client-action.php');
		$tasktaction = new clientAction();
		$tasktaction->deleteClient($deleteid);
	}
?>