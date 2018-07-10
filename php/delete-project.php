<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=2');
	}

	$project_creator = $_SESSION['id_usuario'];

	if (isset($_GET['deleteproject'])){

		$deleteid = $_GET['deleteproject'];
		require_once('project-action.php');
		$projectaction = new projectAction();
		$projectaction->deleteProject($deleteid);
	}
?>