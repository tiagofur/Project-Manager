<?php
	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=2');
	}

		require_once('db.class.php');
		$task_creator = $_SESSION['id_usuario'];
		$task_project = $_POST['project'];
		$task_name = $_POST['name'];
		$task_objective = $_POST['objective'];
		$task_responsable = $_POST['responsable'];
		$task_area = $_POST['area'];
		$task_date_start = $_POST['date-start'];
		$task_date_finish = $_POST['date-finish'];

	if (isset($_POST['btn_save'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$saved= false;

		$sql = "INSERT INTO tasks (nome, criador, date_created, project_id, objetivo, responsavel , area, data_inicial_plan, data_final_plan) VALUES ('$task_name','$task_creator', NOW(),'$task_project', '$task_objective', '$task_responsable', '$task_area', '$task_date_start', '$task_date_finish')";

		//executar a query
		if(mysqli_query($link, $sql)){
			$saved = true;
			header('location: ../view/project.php?projectid=' .$task_project .'&saved=' .$saved);
		} else {
			$saved = false;
			header('location: ../view/project.php?projectid=' .$task_project .'&saved=' .$saved);
		}

		die();
	}

	if(isset($_POST['btn_cancel'])){
		header('location: ../view/project.php?projectid='.$task_project);
	}
?>