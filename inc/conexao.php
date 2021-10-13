<?php
    $host = "localhost";
    $db = "quizfeed";
    $user = "tcc";
    $senha = "12345";

    $conexao = mysqli_connect($host,$user,$senha,$db) 
        or die("Erro ao abrir a conexão com o banco de dados.");

    mysqli_set_charset($conexao, "utf8");
?>