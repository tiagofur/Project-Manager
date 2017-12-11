<?php

	session_start();

	require_once('db.class.php');

	$email = $_POST['email-login'];
	$senha = $_POST['password-login'];

	$sql = " SELECT id, nome, email, empresa, area FROM users WHERE email = '$email' AND pass = '$senha' ";

	$objDb = new db();
	$link = $objDb->conect_mysql();

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		$dados_usuario = mysqli_fetch_array($resultado_id);

        if(isset($dados_usuario['email'])){

			$_SESSION['id_usuario'] = $dados_usuario['id'];
			$_SESSION['name'] = $dados_usuario['nome'];
			$_SESSION['email'] = $dados_usuario['email'];

            header('Location: ..\home.php');

        } else{

            header('Location: ..\index.php?erro=1');
        }


	} else {
		echo 'Erro na execucao da consulta, favor entrar em contato com o admin do site';
	}

?>