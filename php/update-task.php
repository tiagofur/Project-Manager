<?php

	require_once('db.class.php');


	$user_update = $_SESSION['id_usuario'];
	$task_id = $_POST['task-id'];
	$task_project = $_POST['task-project'];
	$task_name = $_POST['task-name'];
	$task_objective = $_POST['task-objective'];
	$task_responsable = $_POST['task-responsable'];
	$task_area = $_POST['task-area'];
	$task_date_start = $_POST['task-date-start-plan'];
	$task_date_finish = $_POST['task-date-finish-plan'];

	if (isset($_POST['btn_save'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$saved= false;

		$sql = "UPDATE tasks SET changed = '$user_update', date_changed = NOW(), nome = '$task_name', objetivo = '$task_objective', responsavel = '$task_responsable', area = '$task_area', data_inicial_plan = '$task_date_start', data_final_plan = '$task_date_finish' WHERE id = '$task_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../view/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskupdatesucess=1');

		} else {

			header('location: ../view/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskupdateerror=1');
		}
		die();
	}

	if(isset($_POST['btn_cancel'])){
		header('location: ../view/task.php?projectid=' .$task_project .'&taskid=' .$task_id);
	}

	if(isset($_POST['btn_start'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$date = date('Y-m-d H:i:s');

		$sql = "UPDATE tasks SET data_inicial_real = '$date' WHERE id = '$task_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../view/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskstartsucess=1');

		} else {

			header('location: ../view/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskstarterror=1');
		}
		die();
	}

	if(isset($_POST['btn_finish'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$date = date('Y-m-d H:i:s');

		$sql = "UPDATE tasks SET data_final_real = '$date' WHERE id = '$task_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../view/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskfinishsucess=1');

		} else {

			header('location: ../view/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskfinisherror=1');
		}
		die();
	}

	if(isset($_POST['btn_validate'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$sql = "UPDATE tasks SET validado = '1' WHERE id = '$task_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../view/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskfinishsucess=1');

		} else {

			header('location: ../view/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskfinisherror=1');
		}
		die();
	}

	if(isset($_POST['btn_remove_start'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$date = NULL;

		$sql = "UPDATE tasks SET data_inicial_real = '$date' WHERE id = '$task_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../edit/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskstartsucess=1');

		} else {

			header('location: ../edit/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskstarterror=1');
		}
		die();
	}

	if(isset($_POST['btn_remove_finish'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$date = NULL;

		$sql = "UPDATE tasks SET data_final_real = '$date' WHERE id = '$task_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../edit/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskfinishsucess=1');

		} else {

			header('location: ../edit/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskfinisherror=1');
		}
		die();
	}

	if(isset($_POST['btn_remove_validate'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$sql = "UPDATE tasks SET validado = '0' WHERE id = '$task_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../edit/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskfinishsucess=1');

		} else {

			header('location: ../edit/task.php?projectid=' .$task_project .'&taskid=' .$task_id .'&taskfinisherror=1');
		}
		die();
	}
?>