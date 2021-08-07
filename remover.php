<?php
    include "./inc/conexao.php";

    $tabela = $_POST["tabela"];
    $coluna = $_POST["coluna"];

    if(isset($_POST["email"])){
        $id = $_POST["email"];
    }
    else{
        $id = $_POST["id"];
    }

    $delete = "DELETE FROM $tabela WHERE $coluna='$id'";

    mysqli_query($conexao,$delete)
        or die("Erro: ".mysqli_error($conexao));

    echo '1';
?>