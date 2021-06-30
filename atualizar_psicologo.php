<?php

include "conexao.php";
session_start();

if($_POST["identificador"] == 1){
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
}
else{
  $email_sessao = $_SESSION["email"];
  $registro_sessao = $_SESSION["registro"];
  $situacao = $_SESSION["situacao"];

  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $registro = $_POST["registro"];
  $cidade = $_POST["cidade"];
  $uf = $_POST["uf"];

  $error = 0;
  //Psicólogo
          //erro = 0 ==> sucesso
          //erro = 1 ==> email já cadastrado
          //erro = 2 ==> registro já cadastrado
          //erro = 3 ==> email e registro já cadastrados
          //erro = 4 ==> erro no cadastro

  $selectRegistro = "SELECT registro FROM usuario_psicologo WHERE registro <> '$registro_sessao' AND registro = '$registro'";
  $confereRegistro = mysqli_query($conexao,$selectRegistro);

  $selectEmail = "SELECT email FROM usuario WHERE email <> '$email_sessao' AND email = '$email'";
  $confereEmail = mysqli_query($conexao,$selectEmail);

  if((mysqli_num_rows($confereRegistro) > 0) || (mysqli_num_rows($confereEmail) > 0)){
      if(mysqli_num_rows($confereRegistro) > 0){
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
                        email = '$email_sessao'";
    if($situacao == 3){
      $update2 = "UPDATE usuario_psicologo INNER JOIN usuario ON usuario_psicologo.email_usuario = usuario.email
                        SET";
                        if($_SESSION['registro']!= $registro){
                          $update2 .= " situacao = '1',";
                        }
                        $update2 .= "registro = '$registro',
                        cidade = '$cidade',
                        uf= '$uf'
                        WHERE
                        email_usuario = '$email'";
    }
    else if($situacao == 2){
      $update2 = "UPDATE usuario_psicologo INNER JOIN usuario ON usuario_psicologo.email_usuario = usuario.email
                        SET
                        uf= '$uf',
                        registro = '$registro',
                        cidade = '$cidade'
                        WHERE
                        email_usuario = '$email'";
    }
    if(mysqli_query($conexao,$update) && mysqli_query($conexao,$update2)){
      $error = 0;
      $_SESSION['email'] = $email;
      if($_SESSION['registro']!= $registro){
        $_SESSION['situação'] = 1;
        $_SESSION['registro'] = $registro;
      }
    }   
    else{
      $error = 4;
    }
  }
}

echo $error;
?>