<?php

session_start();

date_default_timezone_set('America/Sao_Paulo');

$setImage = $_FILES["imagem"]["error"];

function uploadImage(){
  $client_id = '17a3fa29196028a';
  $file = file_get_contents($_FILES["imagem"]["tmp_name"]);
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

function insert($campos, $variaveis){
  include './inc/conexao.php';

  $insert = "INSERT INTO postagem(";
    foreach($campos as $index => $campo){

      if($index != array_key_last($campos)){
        $insert .= "$campo,";
      }
      else{
        $insert .= "$campo";
      }
      
    }
  $insert .= ")
          VALUES(";
            foreach($variaveis as $index => $variavel){
              if($index != array_key_last($variaveis)){
                $insert .= "'$variavel',";
              }
              else{
                $insert .= "'$variavel'";
              }
            }
          $insert .= ")";

          echo $insert;

  if(mysqli_query($conexao,$insert)){
    header('Location: rede.php');
  }        
  else{
    echo '<h1>Ocorreu um erro. Por favor, contate os administradores</h1>';
  }
}

$data = date('Y-m-d');
$hora = date('H:i:s');
$email_usuario = $_SESSION["email"];
$cod_rede = $_SESSION["id_rede"];
$situacao = 1;
$campos = ['data', 'hora', 'email_usuario', 'cod_rede', 'situacao'];
$variaveis = [$data, $hora, $email_usuario, $cod_rede, $situacao];

if(($_POST["conteudo"] != '') || ($setImage == 0)){
  if($_POST["conteudo"] != ''){
    $conteudo = $_POST["conteudo"];
    array_push($campos, 'conteudo');
    array_push($variaveis, $conteudo);
  }
  if($setImage == 0){
    $imagem = uploadImage();
    echo $imagem;
    array_push($campos, 'imagem');
    array_push($variaveis, $imagem);
  }

  
  insert($campos, $variaveis);
}
  
?>