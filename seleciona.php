<?php
    header('Content-Type: application/json');

    include "conexao.php";

    $select = "SELECT * FROM usuario";

    if(isset($_GET["id"])){
        $id_usuario = $_GET["id"];
        $select .= " WHERE id_usuario='$id_usuario'";
    }

    $resultado = mysqli_query($conexao,$select)
        or die(mysqli_error($conexao));

    while($linha = mysqli_fetch_assoc($resultado)){
        $matriz[]=$linha;
    }

    echo json_encode($matriz);
?>