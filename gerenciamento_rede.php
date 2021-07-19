<?php

session_start();

date_default_timezone_set('America/Sao_Paulo');

include './inc/conexao.php';

$email = $_SESSION["email"];
$id = $_POST["id"];
$data = date('Y-m-d');
$hora = date('H:i:s'); 

$insert = "INSERT INTO inscricao(
            data,
            hora,
            email_usuario,
            cod_rede
          )
          VALUES(
            '$data',
            '$hora',
            '$email',
            '$id'
          )
          ";
  
  if(mysqli_query($conexao,$insert)){
    $erro = 0;
  }        
  else{
    $erro = 1;
  }

  echo $erro;
  
?>