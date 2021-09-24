<?php

include './inc/conexao.php';
session_start();

$email = $_SESSION["email"];

function uploadImage(){
  $client_id = '17a3fa29196028a';
  $file = file_get_contents($_FILES["editar-avatar"]["tmp_name"]);
  $url = 'https://api.imgur.com/3/image.json';
  $headers = array("Authorization: Client-ID $client_id");  
  $pvars  = array('image' => base64_encode($file));
  
  $curl = curl_init();
  curl_setopt_array($curl, array(
      CURLOPT_URL=> $url,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_POST => 1,
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => $pvars
  ));
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  $json_return = curl_exec($curl);
  $data = json_decode($json_return, TRUE);
  return $data["data"]["link"];
  curl_close ($curl); 
}

$image = uploadImage();

$update = "UPDATE usuario_comum
                      SET
                      avatar = '$image'
                      WHERE
                      email_usuario = '$email'";

if(mysqli_query($conexao,$update)){
  $_SESSION["avatar"] = $image;
  header('Location: dados_usuarios.php');
}        
else{
  echo '<h1>Ocorreu um erro. Por favor, contate os administradores</h1>';
}

 

?>