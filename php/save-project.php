<?php

	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=2');
	}

	require_once('db.class.php');
	$project_creator = $_SESSION['id_usuario'];
	$project_name = $_POST['name'];
	$project_objective = $_POST['objective'];
	$project_cliente = $_POST['cliente'];
	$project_gerente = $_POST['gerente'];
	$project_area = $_POST['area'];
	$project_date_start = $_POST['date-start'];
	$project_date_finish = $_POST['date-finish'];

	if (isset($_POST['btn_save'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$saved= false;

		$sql = "INSERT INTO projects (nome, created, date_created, objetivo, cliente, gerente, area, data_inicial_plan, data_final_plan) VALUES ('$project_name','$project_creator', NOW() , '$project_objective', '$project_cliente', '$project_gerente', '$project_area', '$project_date_start', '$project_date_finish')";

		//executar a query
		if(mysqli_query($link, $sql)){
			$projID = mysqli_insert_id($link);
			$saved = true;
			header('location: ../view/project.php?projectid='.$projID.'&saved='.$saved);
		} else {
			$saved = false;
			//echo 'Error al registrar el Projeto!';
			header('location: ../register/project.php?saved='.$saved);

		}
	}

	if(isset($_POST['btn_cancel'])){
		header('location: ../home.php');
	}

	die();
?>