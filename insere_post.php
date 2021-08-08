<?php

session_start();

date_default_timezone_set('America/Sao_Paulo');

include './inc/conexao.php';

$conteudo = $_POST["conteudo"];
$data = date('Y-m-d');
$hora = date('H:i:s');
$email = $_SESSION["email"];
$codRede = $_SESSION["id_rede"];

$insert = "INSERT INTO postagem(
            data,
            hora,
            conteudo,
            email_usuario,
            cod_rede,
            situacao
          )
          VALUES(
            '$data',
            '$hora',
            '$conteudo',
            '$email',
            '$codRede',
            1
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