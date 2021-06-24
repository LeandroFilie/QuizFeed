<?php
    header('Content-Type: application/json');

    include "conexao.php";

    if($_GET["identificador"] == 1){
        $select = "SELECT nome, email, nome_usuario FROM usuario INNER JOIN usuario_comum ON usuario.email = usuario_comum.email_usuario";

        if(isset($_GET["email"])){
            $email = $_GET["email"];
            $select .= " WHERE usuario.email='$email'";
        }

        $resultado = mysqli_query($conexao,$select)
            or die(mysqli_error($conexao));

        $i = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            $matriz[]=$linha;
            $i++;
        }
        if($i == 0){
            $matriz = 0;
        }
    }
    else if($_GET["identificador"] == 2){
        $select = "SELECT nome, email, registro, cidade, uf, situacao FROM usuario INNER JOIN usuario_psicologo ON usuario.email = usuario_psicologo.email_usuario";

        if(isset($_GET["situacao"])){
            $situacao = $_GET["situacao"];
            $select .= " WHERE usuario_psicologo.situacao='$situacao'";
        }

        if(isset($_GET["email"])){
            $email = $_GET["email"];
            $select .= " WHERE usuario.email='$email'";
        }

        $resultado = mysqli_query($conexao,$select)
            or die(mysqli_error($conexao));

        $j = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            $matriz[]=$linha;
            $j++;
        }
        if($j == 0){
            $matriz = 0;
        }
    }

    echo json_encode($matriz);
?>