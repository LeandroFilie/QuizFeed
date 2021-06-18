<?php

include "conexao.php";
session_start();

$nome_usuario_atual = $_SESSION['nome_usuario'];
$email_atual = $_SESSION['email'];

$nome = $_POST["nome"];
$nome_usuario = $_POST["nome_usuario"];
$email = $_POST["email"];

$error = 0;

$select = "SELECT nome_usuario FROM usuariocomum WHERE nome_usuario <> '$nome_usuario_atual' AND nome_usuario = '$nome_usuario'";
$confereNomeusuario = mysqli_query($conexao,$select);

$select = "SELECT email FROM usuario WHERE email <> '$email_atual' AND email = '$email'";
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
    $update = "UPDATE usuario SET 
                            nome ='$nome',
                            email = '$email'
                            WHERE
                            email = '$email_atual'";
    
    $update2 = "UPDATE usuariocomum INNER JOIN usuario ON usuariocomum.email_usuario = usuario.email
                            SET
                            nome_usuario = '$nome_usuario'
                            WHERE
                            email_usuario = '$email'";

                        
    if(mysqli_query($conexao,$update) && mysqli_query($conexao,$update2)){
        $error = 0;
        $_SESSION['nome_usuario'] = $nome_usuario;
        $_SESSION['email'] = $email;
    }   
    else{
       $error = 4;
    }
}

echo $error;
?>