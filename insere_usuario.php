<?php
    session_start();

    include "conexao.php";

    $nome = $_POST["nome_completo"];

    $email = $_POST["email"];
    $_SESSION["email"] = $email;

    $senha = $_POST["senha"];

    $identificador = $_POST["identificador"];

    $error = 0;
    //Usuário Comum
        //erro = 0 ==> sucesso
        //erro = 1 ==> email já cadastrado
        //erro = 2 ==> nome de usuário já cadastrado
        //erro = 3 ==> email e nome de usuário já cadastrados
        //erro = 4 ==> erro no cadastro
    //Psicólogo
        //erro = 0 ==> sucesso
        //erro = 1 ==> email já cadastrado
        //erro = 2 ==> registro já cadastrado
        //erro = 3 ==> email e registro já cadastrados
        //erro = 4 ==> erro no cadastro


    if($identificador == 1){ //usuario comum
        $nome_usuario = $_POST["nome_usuario"];
        $_SESSION["nome_usuario"] = $nome_usuario;
        $_SESSION["permissao"] = 2;

        $select = "SELECT nome_usuario FROM usuario_comum WHERE nome_usuario = '$nome_usuario'";
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
                email,
                senha,
                permissao
                )
                VALUES('$nome','$email','$senha','2')
            ";

            $insert2 = "INSERT INTO usuario_comum(
                nome_usuario,
                email_usuario
                )
                VALUES('$nome_usuario', '$email')";

            if(mysqli_query($conexao,$insert) && mysqli_query($conexao,$insert2)){
                $error = 0;
            }
            else{
                $error = 4;
                session_unset();
            }
        }
    }
    else if($identificador == 2){ //psicólogo
        $registro = $_POST["registro"];
        $cidade = $_POST["cidade"];
        $uf = $_POST["uf"];
        $_SESSION["permissao"] = 3;
        $_SESSION["situacao"] = 1;

        $select = "SELECT registro FROM usuario_psicologo WHERE registro = '$registro'";
        $confereregistro = mysqli_query($conexao,$select);

        $select2 = "SELECT email FROM usuario WHERE email = '$email'";
        $confereEmail = mysqli_query($conexao,$select2);

        if((mysqli_num_rows($confereregistro) > 0) || (mysqli_num_rows($confereEmail) > 0)){
            if(mysqli_num_rows($confereregistro) > 0){
                $error += 2; 
            }
            if(mysqli_num_rows($confereEmail) > 0){
                $error++; 
            }
        }
        else{
            $insert = "INSERT INTO usuario(
                nome,
                email,
                senha,
                permissao
                )
                VALUES('$nome','$email','$senha','3')
            ";

            $insert2 = "INSERT INTO usuario_psicologo(
                registro,
                cidade,
                uf,
                situacao,
                email_usuario
                )
                VALUES('$registro', '$cidade', '$uf', '1', '$email')";

            if(mysqli_query($conexao,$insert) && mysqli_query($conexao,$insert2)){
                $error = 0;
            }
            else{
                $error = 4;
                session_unset();
            }
        }
    }
    echo $error;
?>