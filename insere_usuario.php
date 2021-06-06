<?php

    session_start();

    include "conexao.php";

    $nome = $_POST["nome_completo"];
    $nome_usuario = $_POST["nome_usuario"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $_SESSION["nome_usuario"] = $nome_usuario;
    $_SESSION["permissao"] = 2;

    $error = 0;
    //erro = 0 ==> sucesso
    //erro = 1 ==> email já cadastrado
    //erro = 2 ==> nome de usuário já cadastrado
    //erro = 3 ==> email e nome de usuário já cadastrados

    
   
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
            $error+=1;
        }
        
        $select = "SELECT nome_usuario FROM usuario WHERE nome_usuario = '$nome_usuario'";
        $resultado = mysqli_query($conexao,$select);

        if(mysqli_num_rows($resultado) > 0){
            $error += 2; 
        }

    

    echo $error;
?>