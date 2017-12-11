<?php

	session_start();

	require_once('db.class.php');

	$tarea_name = $_POST['tarea-name'];
	$tarea_objective = $_POST['tarea-objective'];
	$tarea_gerente = $_POST['tarea-responsable'];
	$tarea_area = $_POST['tarea-area'];
	$tarea_date_start = $_POST['tarea-date-start'];
	$tarea_date_finish = $_POST['tarea-date-finish'];
	$tarea_domain = $_POST['tarea-domain'];

	$objDb = new db();
    $link = $objDb->conect_mysql();

	//$email_existe = false;
	
		//verificar se o e-mail ja existe
		//$sql = " select * from users where gerente = '$tarea_gerente' ";
		//if($resultado_id = mysqli_query($link, $sql)) {
	
		//	$dados_usuario = mysqli_fetch_array($resultado_id);
	
		//	if(isset($dados_usuario['id'])){
		//		$gerente_exist = true;
		//	} 
		//} else {
		//	echo 'El email ya es registrado, intente hacer login o registrar con otro email';
		//}
	
		//if($gerente_exist){

			$sql = " insert into tareas(nome, objective, responsable, area, start, finish, domain) values ('$tarea_name', '$tarea_objective', '$tarea_gerente', '$tarea_area', '$tarea_date_start', '$tarea_date_finish', '$tarea_domain') ";
		//}

		//if($gerente_exist == FALSE){

		//	$retorno_get = '';
				
		//	$retorno_get.= "erro=3";
				
		//		header('Location: ..\create-project.php?'.$retorno_get);
		//		die();
		//	}
			

		//executar a query
		if(mysqli_query($link, $sql)){
			echo 'Tarea registrada con sucesso!';
		} else {
			echo 'Error al registrar el Tarea!';
		}

		header('Location: ..\home.php?');
		die();
	
	?>