<?php
    include "conexao.php";

    $tabela = $_POST["tabela"];
    $coluna = $_POST["coluna"];
    $email = $_POST["email"];

    $delete = "DELETE FROM $tabela WHERE $coluna='$email'";

    mysqli_query($conexao,$delete)
        or die("Erro: ".mysqli_error($conexao));

    echo '1';
?>