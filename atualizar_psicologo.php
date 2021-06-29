<?php

include "conexao.php";
session_start();

$email = $_POST["email"];
$registro = $_POST["registro"];
$situacao = $_POST["situacao"];

$error = 0;

$select = "SELECT registro FROM usuario_psicologo WHERE registro <> '$registro' AND nome_usuario = '$nome_usuario'";
$confereNomeusuario = mysqli_query($conexao,$select);

$select = "SELECT email FROM usuario WHERE email <> '$email' AND email = '$email'";
$confereEmail = mysqli_query($conexao,$select);

if((mysqli_num_rows($confereNomeusuario) > 0) || (mysqli_num_rows($confereEmail) > 0)){
    if(mysqli_num_rows($confereNomeusuario) > 0){
        $error += 2; 
    }
    if(mysqli_num_rows($confereEmail) > 0){
        $error++; 
    }
}
if($situacao == 3){
  $update = "UPDATE usuario_psicologo
                    SET
                    situacao = '$situacao'
                    WHERE
                    email_usuario = '$email'";

  if(mysqli_query($conexao,$update)){
    $error = 0;
  }   
  else{
  $error = 1;
  }
}
else if($situacao == 2){
  $update = "UPDATE usuario_psicologo
                    SET
                    situacao = '$situacao'
                    WHERE
                    email_usuario = '$email'";

  if(mysqli_query($conexao,$update)){
    $error = 0;
  }   
  else{
  $error = 1;
  }
}

?>