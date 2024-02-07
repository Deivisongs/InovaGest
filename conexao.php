<?php
    // servidor Local

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inovagest";


    // Cria conexão

    $conexao = new mysqli ($servername, $username, $password, $dbname);

    // Verifica conexão

    if ( $conexao -> connect_error){
        die("Falha na Conexão com o BD!" . $conexao->connect_error);
    }


?>