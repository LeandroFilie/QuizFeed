<?php

session_start();

date_default_timezone_set('America/Sao_Paulo');

include './inc/conexao.php';

$email = $_SESSION["email"];
$erro = 0;

$identificador = $_POST["identificador"];
// 1 -> cadastrar na rede
// 2 --> trocar de rede

if($identificador == 1){
  $id_rede = $_POST["id"];
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
    '$id_rede'
  )
  ";

  if(mysqli_query($conexao,$insert)){
  $erro = 0;
  }        
  else{
  $erro = 1;
  }
}
else if($identificador == 2){
  $area_atual = $_SESSION['id_rede'];
  $area = $_POST["area"];

  if($area != $area_atual){
    $update = "UPDATE inscricao SET 
                        cod_rede ='$area'
                        WHERE
                        email_usuario = '$email'";

    if(mysqli_query($conexao,$update)){
      $_SESSION['id_rede'] = $area;
    } else{
      $erro = 1;
    }       
  }
}
  echo $erro;
  
?>