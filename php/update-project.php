<?php

	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=2');
	}

	require_once('db.class.php');

	$user_update = $_SESSION['id_usuario'];
	$project_id = $_POST['id'];
	$project_name = $_POST['name'];
	$project_objective = $_POST['objective'];
	$project_responsable = $_POST['gerente'];
	$project_area = $_POST['area'];
	$project_date_start = $_POST['date-start-plan'];
	$project_date_finish = $_POST['date-finish-plan'];

	if (isset($_POST['btn_save'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$saved= false;

		$sql = "UPDATE projects SET changed = '$user_update', date_changed = NOW(), nome = '$project_name', objetivo = '$project_objective', gerente = '$project_responsable', area = '$project_area', data_inicial_plan = '$project_date_start', data_final_plan = '$project_date_finish' WHERE id = '$project_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../edit/project.php?projectid=' .$project_id .'&projectupdatesucess=1');

		} else {

			header('location: ../edit/project.php?projectid=' .$project_id .'&projectupdateerror= 1');
		}

		die();
	}

	if(isset($_POST['btn_cancel'])){
		header('location: ../view/project.php?projectid=' .$project_id);
	}

	if(isset($_POST['btn_start'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$date = date('Y-m-d H:i:s');

		$sql = "UPDATE projects SET data_inicial_real = '$date' WHERE id = '$project_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../view/project.php?projectid=' .$project_id .'&projectstartsucess=1');

		} else {

			header('location: ../view/project.php?projectid=' .$project_id .'&projectstarterror=1');
		}

		die();
	}

	if(isset($_POST['btn_remove_start'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$date = NULL;
		//$date = date('y-m-d', strtotime('0001-01-01'));

		$sql = "UPDATE projects SET data_inicial_real = '$date' WHERE id = '$project_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../edit/project.php?projectid=' .$project_id .'&projectstartsucess=1');

		} else {

			header('location: ../edit/project.php?projectid=' .$project_id .'&projectstarterror=1');
		}

		die();
	}

	if(isset($_POST['btn_finish'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$date = date('Y-m-d H:i:s');

		$sql = "UPDATE projects SET data_final_real = '$date' WHERE id = '$project_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../view/project.php?projectid=' .$project_id .'&projectfinishsucess=1');

		} else {

			header('location: ../view/project.php?projectid=' .$project_id .'&projectfinisherror=1');
		}

		die();
	}

	if(isset($_POST['btn_remove_finish'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$date = NULL;
		//$date = date('y-m-d', strtotime('0001-01-01'));

		$sql = "UPDATE projects SET data_final_real = '$date' WHERE id = '$project_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../edit/project.php?projectid=' .$project_id .'&projectfinishsucess=1');

		} else {

			header('location: ../edit/project.php?projectid=' .$project_id .'&projectfinisherror=1');
		}

		die();
	}

	if(isset($_POST['btn_validate'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$sql = "UPDATE projects SET validado = '1' WHERE id = '$project_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../view/project.php?projectid=' .$project_id .'&projectfinishsucess=1');

		} else {

			header('location: ../view/project.php?projectid=' .$project_id .'&projectfinisherror=1');
		}

		die();
	}

	if(isset($_POST['btn_remove_validate'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$sql = "UPDATE projects SET validado = '0' WHERE id = '$project_id'";

		//executar a query
		if(mysqli_query($link, $sql)){

			header('location: ../edit/project.php?projectid=' .$project_id .'&projectfinishsucess=1');

		} else {

			header('location: ../edit/project.php?projectid=' .$project_id .'&projectfinisherror=1');
		}

		die();
	}
?>