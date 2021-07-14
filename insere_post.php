<?php

session_start();

date_default_timezone_set('America/Sao_Paulo');

include './inc/conexao.php';

$conteudo = $_POST["conteudo"];
$data = date('Y-m-d');
$hora = date('H:i:s');

$selectCodRede = "SELECT inscricao.cod_rede as rede FROM inscricao INNER JOIN rede ON inscricao.email_usuario = '".$_SESSION["email"]."' AND inscricao.cod_rede = rede.id_rede";
$resultado = mysqli_query($conexao, $selectCodRede);
while($linha = mysqli_fetch_assoc($resultado)){
  $codRede = $linha['rede'];
} 

$insert = "INSERT INTO postagem(
            data,
            hora,
            conteudo,
            email_usuario,
            cod_rede
          )
          VALUES(
            '$data',
            '$hora',
            '$conteudo',
            '".$_SESSION["email"]."',
            '$codRede'
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