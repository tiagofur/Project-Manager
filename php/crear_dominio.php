<?php
$cadena = "prueba@leonpurpura.com"; 
$subcadena = "@"; 
// localicamos en que posici�n se haya la $subcadena, en nuestro caso la posicion es "7"
$posicionsubcadena = strpos ($cadena, $subcadena); 
// eliminamos los caracteres desde $subcadena hacia la izq, y le sumamos 1 para borrar tambien el @ en este caso
$dominio = substr ($cadena, ($posicionsubcadena+1)); 
echo $dominio; // leonpurpura.com
?>