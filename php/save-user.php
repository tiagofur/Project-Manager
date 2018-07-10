<?php

	session_start();

	if(!isset($_SESSION['email'])){
		header('Location: ../index.php?erro=2');
	}

	require_once('db.class.php');
    $user_name = $_POST['name'];
    $user_lastname = $_POST['last-name'];
    $user_email = $_POST['email'];
    $user_empresa = $_POST['empresa'];
	$user_area = $_POST['area'];
	$user_tipo = $_POST['type-user'];
	$user_password = $_POST['password'];
	$user_creator = $_SESSION['id_usuario'];

	if (isset($_POST['btn_register'])){

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$email_existe = false;

		//verificar se o e-mail ja existe
		$sql = " SELECT * FROM users WHERE email = $user_email ";
		if($resultado_id = mysqli_query($link, $sql)) {

			$dados_usuario = mysqli_fetch_array($resultado_id);

			if(isset($dados_usuario['email'])){
				$email_existe = true;
			}
		}else{ echo 'No fue posible conectar en el banco de datos!'; }

		if($email_existe){

			$retorno_get.= "erro=2";

			header('Location: ../register/user.php?'.$retorno_get);
			echo 'El email ya es registrado, intente hacer login o registrar con otro email';

		}else{
			$sql = " INSERT INTO users (nome, sobrenome, email, empresa, area, senha, tipo, created, date_created) VALUES ('$user_name', '$user_lastname', '$user_email', '$user_empresa', '$user_area', '$user_password', '$user_tipo', '$user_creator', NOW()) ";

			//executar a query
			if(mysqli_query($link, $sql)){
				$userID = mysqli_insert_id($link);
				$retorno_get.= "usercreated=1";

				header('Location: ../view/user.php?userid='.$userID .'&'.$retorno_get);

			} else {

				$retorno_get.= "erro=3";

				header('Location: ../register/user.php?'.$retorno_get);
			}
		}

		die();
	}

	if(isset($_POST['btn_cancel'])){
		header('location: ../home.php');
	}

?>