<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');

$setImage = false;

if($_FILES["imagem"]["error"] == 0){
  $setImage = true;
}

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

  if(mysqli_query($conexao,$insert)){
    if($_SESSION["permissao"] == 1){
      header('Location: rede.php?nome_rede='.$_POST["area-admin"].'');
    }
    else{
      header('Location: rede.php');
    }
    

  }        
  else{
    echo '<h1>Ocorreu um erro. Por favor, contate os administradores</h1>';
  }
}

$email_usuario = $_SESSION["email"];
if($_SESSION["permissao"] == 1){
  $cod_rede = $_POST["area-admin"];
}
else{
  $cod_rede = $_SESSION["id_rede"];
}

$data = date('Y-m-d');
$hora = date('H:i:s');

$situacao = 1;
$campos = ['data', 'hora', 'email_usuario', 'cod_rede', 'situacao'];
$variaveis = [$data, $hora, $email_usuario, $cod_rede, $situacao];

if(isset($_POST["conteudo"])){
  $conteudo = $_POST["conteudo"];
  array_push($campos, 'conteudo');
  array_push($variaveis, $conteudo);
}

if($setImage){
  if($_FILES["imagem"]["error"] == 0){
      $imagem = uploadImage();
      array_push($campos, 'imagem');
      array_push($variaveis, $imagem);
      
  }
}

insert($campos, $variaveis);

?>