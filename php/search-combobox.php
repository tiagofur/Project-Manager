<?php
    class comboboxPopulate {

        function gerente(){

            require_once('db.class.php');

            $sql = "SELECT id, nome, sobrenome, tipo FROM users WHERE tipo IN (0, 1) ";

            $objDb = new db();
            $link = $objDb->conect_mysql();

            if(mysqli_query($link, $sql)){

                $resultado_gerente = mysqli_query($link, $sql);

            }else{

                $resultado_gerente = 'null';
            }

            return  $resultado_gerente;
        }

        function colaboradores(){

            require_once('db.class.php');

            $sql = "SELECT id, nome, sobrenome, tipo FROM users ";

            $objDb = new db();
            $link = $objDb->conect_mysql();

            if(mysqli_query($link, $sql)){

                $resultado_colaboradores = mysqli_query($link, $sql);

            }else{

                $resultado_colaboradores = 'null';
            }

            return  $resultado_colaboradores;
        }

        function cliente(){

            require_once('db.class.php');

            $sql = "SELECT id, nome FROM clients";

            $objDb = new db();
            $link = $objDb->conect_mysql();

            if(mysqli_query($link, $sql)){

                $resultado_cliente = mysqli_query($link, $sql);

            }else{

                $resultado_cliente = 'null';
            }

            return $resultado_cliente;
        }

        function area(){

            require_once('db.class.php');

            $sql = "SELECT id, nome FROM areas";

            $objDb = new db();
            $link = $objDb->conect_mysql();

            if(mysqli_query($link, $sql)){

                $resultado_area = mysqli_query($link, $sql);

            }else{

                $resultado_area = 'null';
            }

            return $resultado_area;
        }

        function tipo_usuario(){

            require_once('db.class.php');

            $sql = "SELECT id, nome FROM typeuser";

            $objDb = new db();
            $link = $objDb->conect_mysql();

            if(mysqli_query($link, $sql)){

                $resultado_typeuser = mysqli_query($link, $sql);

            }else{

                $resultado_typeuser = 'null';
            }

            return $resultado_typeuser;
        }
    }

?>