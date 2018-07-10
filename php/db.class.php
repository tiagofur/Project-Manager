<?php

    class db {
        //host
        private $host = 'pdb9.awardspace.net';

        //usuario
        private $usuario = '2442620_projetcmanager';

        //senha
        private $senha = 'cafe1245';

        //banco de dados
        private $database = '2442620_projetcmanager';

        public function conect_mysql(){

         //criar a conexao
        $con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

         //ajustar o charset de comunicacao entre a aplicacao e o banco de dados
         mysqli_set_charset($con, 'utf8');

         //verificar se houve algum erro de conexao
         if(mysqli_connect_errno()){
            echo 'Error ao intentar conectar con el SQL: '.mysqli_connect_error();
         }

         return $con;
        }
    }

?>