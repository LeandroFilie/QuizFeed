<?php
    $host = "us-cdbr-east-04.cleardb.com";
    $db = "heroku_08b8e4264878aac";
    $user = "bd8c6fd9e7fc2e";
    $senha = "a57d5260";

    $conexao = mysqli_connect($host,$user,$senha,$db) 
        or die("Erro ao abrir a conexão com o banco de dados.");

    mysqli_set_charset($conexao, "utf8");
?>