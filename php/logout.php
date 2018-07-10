<?php

header('Location: ../index.php');

session_start();

unset($_SESSION['usuario']);
unset($_SESSION['email']);

setcookie('email', null, -1, '/');
setcookie('tempass', null, -1, '/');


echo 'Esperamos você de volta em breve!!!'

?>