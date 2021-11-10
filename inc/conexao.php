<?php
    $host = "us-cdbr-east-04.cleardb.com";
    $db = "heroku_4ad42e2e115496d";
    $user = "bcf49341f7b8ff";
    $senha = "b760f997";

    $conexao = mysqli_connect($host,$user,$senha,$db) 
        or die("Erro ao abrir a conexão com o banco de dados.");

    mysqli_set_charset($conexao, "utf8");
?>