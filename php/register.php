<?php

	require_once('db.class.php');
	

	$cadena = $_POST['email']; 
	$subcadena = "@"; 
	// localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
	$posicionsubcadena = strpos ($cadena, $subcadena); 
	// eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
	$dominio = substr ($cadena, ($posicionsubcadena+1)); 

    $name = $_POST['name'];
    $lastname = $_POST['last-name'];
    $email = $_POST['email'];
    $empresa = $_POST['empresa'];
    $area = $_POST['area'];
    $password = $_POST['password'];

    $objDb = new db();
    $link = $objDb->conect_mysql();

	$email_existe = false;

	//verificar se o e-mail ja existe
	$sql = " SELECT * FROM users WHERE email = '$email' ";
	if($resultado_id = mysqli_query($link, $sql)) {

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['email'])){
			$email_existe = true;
		} 
	} else {
		echo 'El email ya es registrado, intente hacer login o registrar con otro email';
	}


	if($email_existe){

		$retorno_get = '';

        $retorno_get.= "erro=2";

		header('Location: ..\index.php?'.$retorno_get);
		die();
	}

    $sql = " INSERT INTO users(nome, last_name, email, domain, empresa, area, pass) VALUES ('$name', '$lastname', '$email', '$dominio', '$empresa', '$area', '$password') ";

    //executar a query
	if(mysqli_query($link, $sql)){

		echo 'Usuario registrado con sucesso!';

		header('Location: ..\home.php?'.$retorno_get);

	} else {
		$retorno_get = '';
		
		$retorno_get.= "erro=3";
		
		header('Location: ..\index.php?'.$retorno_get);
	}

?>