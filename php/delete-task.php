<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=2');
	}

	$project_creator = $_SESSION['id_usuario'];

	if (isset($_GET['deletetask'])){

		$deleteid = $_GET['deletetask'];
		$projectID = $_GET['projectid'];
		require_once('task-action.php');
		$tasktaction = new taskAction();
		$tasktaction->deleteTask($deleteid, $projectID);
	}
?>