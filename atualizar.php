<?php

include "conexao.php";
session_start();

$nome_usuario_atual = $_SESSION['nome_usuario'];
$email_atual = $_SESSION['email'];

$nome = $_POST["nome"];
$nome_usuario = $_POST["nome_usuario"];
$email = $_POST["email"];
$id_usuario = $_POST["id_usuario"];

$error = 0;

$select = "SELECT nome_usuario FROM usuario WHERE nome_usuario <> '$nome_usuario_atual' AND nome_usuario = '$nome_usuario'";
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
    $update = "UPDATE usuario SET nome ='$nome',
                            nome_usuario = '$nome_usuario',
                            email = '$email'
                            WHERE
                            id_usuario = '$id_usuario'";

    if(mysqli_query($conexao,$update)){
        $error = 0;
    }   
    else{
       $error = 4;
    }
}

echo $error;
?>