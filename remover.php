<?php
    include "conexao.php";

    $tabela = $_POST["tabela"];
    $coluna = $_POST["coluna"];
    $id = $_POST["id"];

    $delete = "DELETE FROM $tabela WHERE $coluna='$id'";

    mysqli_query($conexao,$delete)
        or die("Erro: ".mysqli_error($conexao));

    echo "1";
?>