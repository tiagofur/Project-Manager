<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=2');
	}

	$project_creator = $_SESSION['id_usuario'];

	if (isset($_GET['deleteuser'])){

		$deleteid = $_GET['deleteuser'];
		require_once('user-action.php');
		$tasktaction = new userAction();
		$tasktaction->deleteUser($deleteid);
	}
?>