<?php

	session_start();

	require_once('db.class.php');

	$project_name = $_POST['project-name'];
	$project_objective = $_POST['project-objective'];
	$project_gerente = $_POST['project-gerente'];
	$project_area = $_POST['project-area'];
	$project_date_start = $_POST['project-date-start'];
	$project_date_finish = $_POST['project-date-finish'];
	$project_domain = $_POST['project-domain'];

	$objDb = new db();
    $link = $objDb->conect_mysql();

	//$email_existe = false;
	
		//verificar se o e-mail ja existe
		//$sql = " select * from users where gerente = '$project_gerente' ";
		//if($resultado_id = mysqli_query($link, $sql)) {
	
		//	$dados_usuario = mysqli_fetch_array($resultado_id);
	
		//	if(isset($dados_usuario['id'])){
		//		$gerente_exist = true;
		//	} 
		//} else {
		//	echo 'El email ya es registrado, intente hacer login o registrar con otro email';
		//}
	
		//if($gerente_exist){

			$sql = " insert into projects(nome, objective, gerente, area, start, finish, domain) values ('$project_name', '$project_objective', '$project_gerente', '$project_area', '$project_date_start', '$project_date_finish', '$project_domain') ";
		//}

		//if($gerente_exist == FALSE){

		//	$retorno_get = '';
				
		//	$retorno_get.= "erro=3";
				
		//		header('Location: ..\create-project.php?'.$retorno_get);
		//		die();
		//	}
			

		//executar a query
		if(mysqli_query($link, $sql)){
			echo 'Projeto registrado con sucesso!';
		} else {
			echo 'Error al registrar el Projeto!';
		}

		header('Location: ..\home.php?');
		die();
	
	?>