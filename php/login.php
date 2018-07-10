<?php

	session_start();

	require_once('db.class.php');

	$email_cookie = $_POST['email-cookie'];
	$tempass_cookie = $_POST['tempass-cookie'];
	$email = $_POST['email-login'];
	$senha = $_POST['password-login'];
	$mantener_conectado = $_POST["guardar_clave"];

	if($email){

		$sql = "SELECT id, nome, sobrenome, email, empresa, area, tipo FROM users WHERE email = '$email' AND senha = '$senha'";

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$resultado_id = mysqli_query($link, $sql);

		if($resultado_id){
			$dados_usuario = mysqli_fetch_array($resultado_id);

			$userID = $dados_usuario['id'];

			if(isset($dados_usuario['email'])){

				$_SESSION['id_usuario'] = $dados_usuario['id'];
				$_SESSION['name'] = $dados_usuario['nome'];
				$_SESSION['sobrenome'] = $dados_usuario['sobrenome'];
				$_SESSION['email'] = $dados_usuario['email'];
				$_SESSION['user_type'] = $dados_usuario['tipo'];

				if($mantener_conectado == 1){

					$numero_aleatorio = mt_rand(1000000,999999999);

					$sqlteppass = "UPDATE users SET tempass = '$numero_aleatorio' WHERE id = '$userID'";

					setcookie("email", $email , time()+(7*24*3600), '/');
					setcookie("tempass", $numero_aleatorio, time()+(7*24*3600), '/');

					if(mysqli_query($link, $sqlteppass)){

						header('Location: ../home.php?');

					} else {

						header('Location: ../index.php?erro=1');
					}
				}

				header('Location: ../home.php');

			} else{

				header('Location: ../index.php?erro=1');
			}

		} else {
			echo 'Erro na execucao da consulta, favor entrar em contato com o admin do site';
		}

	}

	if($email_cookie){

		$sql = "SELECT id, nome, sobrenome, email, empresa, area, tipo, tempass FROM users WHERE email = '$email_cookie' AND tempass = '$tempass_cookie'";

		$objDb = new db();
		$link = $objDb->conect_mysql();

		$resultado_id = mysqli_query($link, $sql);

		if($resultado_id){
			$dados_usuario = mysqli_fetch_array($resultado_id);

			$userID = $dados_usuario['id'];

			if(isset($dados_usuario['email'])){

				$_SESSION['id_usuario'] = $dados_usuario['id'];
				$_SESSION['name'] = $dados_usuario['nome'];
				$_SESSION['sobrenome'] = $dados_usuario['sobrenome'];
				$_SESSION['email'] = $dados_usuario['email'];
				$_SESSION['user_type'] = $dados_usuario['tipo'];


				header('Location: ../home.php');

			} else{

				header('Location: ../index.php?erro=1');
			}

		} else {
			echo 'Erro na execucao da consulta, favor entrar em contato com o admin do site';
		}

	}

?>