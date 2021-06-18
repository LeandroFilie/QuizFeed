<?php
    header('Content-Type: application/json');

    include "conexao.php";

    $select = "SELECT nome, email, nome_usuario FROM usuario INNER JOIN usuariocomum ON usuario.email = usuariocomum.email_usuario";

    if(isset($_GET["email"])){
        $email = $_GET["email"];
        $select .= " WHERE usuario.email='$email'";
    }

    $resultado = mysqli_query($conexao,$select)
        or die(mysqli_error($conexao));

    while($linha = mysqli_fetch_assoc($resultado)){
        $matriz[]=$linha;
    }

    echo json_encode($matriz);
?>