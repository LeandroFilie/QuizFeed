<?php
  session_start();

  date_default_timezone_set('America/Sao_Paulo');

  include './inc/conexao.php';

  $cod_postagem = $_POST["cod_postagem"];
  $email = $_SESSION["email"];
  $data = date('Y-m-d');
  $hora = date('H:i:s');
  $acao = $_POST["acao"];

  if($acao == 1){
    $situacao = $_POST["situacao"];

    if($situacao == 1){
      $insert = "INSERT INTO curtida(
        cod_postagem,
        hora,
        data,
        email_usuario
      ) VALUES(
          '$cod_postagem',
          '$hora',
          '$data',
          '$email'
      )";
      
      if(mysqli_query($conexao,$insert)){
      $erro = 0;
      }        
      else{
      $erro = 1;
      }
    }
    else{
  
      $delete = "DELETE FROM curtida WHERE cod_postagem = '$cod_postagem' AND email_usuario = '$email' ";
  
      if(mysqli_query($conexao,$delete)){
      $erro = 0;
      }        
      else{
      $erro = 1;
      }
      
    }
  }
  else if($acao == 2){  
    $conteudo = $_POST["conteudo"];

    $insert = "INSERT INTO comentario(
      cod_postagem,
      hora,
      data,
      email_usuario,
      conteudo
    ) VALUES(
        '$cod_postagem',
        '$hora',
        '$data',
        '$email',
        '$conteudo'
    )";

    if(mysqli_query($conexao,$insert)){
      $erro = 0;
    }        
    else{
      $erro = 1;
    }

  }



  echo $erro;
?>