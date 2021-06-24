<?php
    header('Content-Type: application/json');

    include "conexao.php";

    if($_GET["identificador"] == 1){
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
    }
    else{
        $select = "SELECT nome, email, crp, cidade, uf, situacao FROM usuario INNER JOIN usuariopsicologo ON usuario.email = usuariopsicologo.email_usuario";

        if(isset($_GET["situacao"])){
            $situacao = $_GET["situacao"];
            $select .= " WHERE usuariopsicologo.situacao='$situacao'";
        }

        if(isset($_GET["email"])){
            $email = $_GET["email"];
            $select .= " WHERE usuario.email='$email'";
        }

        $resultado = mysqli_query($conexao,$select)
            or die(mysqli_error($conexao));

        while($linha = mysqli_fetch_assoc($resultado)){
            $matriz[]=$linha;
        }
    }

    echo json_encode($matriz);
?>