<?php
    $host = "us-cdbr-east-04.cleardb.com";
    $db = "heroku_3d70503486e0bc8";
    $user = "b5f7d93db4bac1";
    $senha = "43ed3c7f";

    $conexao = mysqli_connect($host,$user,$senha,$db) 
        or die("Erro ao abrir a conexão com o banco de dados.");

    mysqli_set_charset($conexao, "utf8");
?>