<?php
    session_start();

    include "conexao.php";

    $nome = $_POST["nome_completo"];
    $nome_usuario = $_POST["nome_usuario"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $_SESSION["nome_usuario"] = $nome_usuario;
    $_SESSION["permissao"] = 2;
    $_SESSION["email"] = email;

    $error = 0;
    //erro = 0 ==> sucesso
    //erro = 1 ==> email já cadastrado
    //erro = 2 ==> nome de usuário já cadastrado
    //erro = 3 ==> email e nome de usuário já cadastrados
    //erro = 4 ==> erro no cadastro

    $select = "SELECT nome_usuario FROM usuario WHERE nome_usuario = '$nome_usuario'";
    $confereNomeusuario = mysqli_query($conexao,$select);

    $select = "SELECT email FROM usuario WHERE email = '$email'";
    $confereEmail = mysqli_query($conexao,$select);

    if((mysqli_num_rows($confereNomeusuario) > 0) || (mysqli_num_rows($confereEmail) > 0)){
        if(mysqli_num_rows($confereNomeusuario) > 0){
            $error += 2; 
        }
        if(mysqli_num_rows($confereEmail) > 0){
            $error++; 
        }
    }
    else{

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
            $error = 0;
        }
        else{
            $error = 4;
            session_unset();
        }
    }

    echo $error;

    mysqli_close($conexao);
?>