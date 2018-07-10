<?php

	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=2');
	}

	require_once('db.class.php');

    $area_name = $_POST['nome'];
    $area_gerente = $_POST['gerente'];
	$user_creator = $_SESSION['id_usuario'];

	if (isset($_POST['btn_save'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$area_existe = false;

		//verificar se o e-mail ja existe
		$sql = " SELECT * FROM areas WHERE nome = $area_name ";
		if($resultado_area = mysqli_query($link, $sql)) {

			$dados_area = mysqli_fetch_array($resultado_area);

			if(isset($dados_area['nome'])){
				$area_existe = true;
			}
		} else{ echo 'No fue posible conectar en el banco de datos!'; }

		if($area_existe){

			$retorno_get.= "erro=2";

			header('Location: ../register/area.php?'.$retorno_get);
			echo 'Area ya registrada, intente una busca o registrar otra area!';

		}else{
			$sql = " INSERT INTO areas (nome, gerente, created, date_created) VALUES ('$area_name', '$area_gerente', '$user_creator', NOW()) ";

			//executar a query
			if(mysqli_query($link, $sql)){
				$areaID = mysqli_insert_id($link);
				$saved = true;
				header('Location: ../view/area.php?'.'areaid'.$areaID.'&saved='.$saved);
			} else {
				$saved = false;
				header('Location: ../register/area.php?'.$saved);
			}
		}

		die();
	}

	if(isset($_POST['btn_cancel'])){
		header('location: ../home.php');
	}

?>