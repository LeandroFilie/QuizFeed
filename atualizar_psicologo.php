<?php

include "conexao.php";
session_start();

$email = $_POST["email"];
$situacao = $_POST["situacao"];

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