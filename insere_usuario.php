<?php

    session_start();

    include "conexao.php";
    $nome = $_POST["nome_completo"];
    $nome_usuario = $_POST["nome_usuario"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $_SESSION["nome_usuario"] = $nome_usuario;
    $_SESSION["permissao"] = 2;

    $select = "SELECT nome_usuario FROM usuario WHERE nome_usuario = '$nome_usuario'";
    $resultado = mysqli_query($conexao,$select);
    

    if(mysqli_num_rows($resultado) > 0){
        echo '3';  
    }
    else {
        $insert = "INSERT INTO usuario(
            nome,
            nome_usuario,
            email,
            senha,
            permissao
            )
            VALUES('$nome','$nome_usuario','$email','$senha','2')
        ";
    
        if(mysqli_query($conexao,$insert)){
            echo '1';

        }
        else{
            echo '2';
        }
    }
?>