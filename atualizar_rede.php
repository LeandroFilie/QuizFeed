<?php

include "./inc/conexao.php";
header('Content-Type: application/json');
session_start();

$email_atual = $_SESSION['email'];
$area_atual = $_SESSION['id_rede'];
$area= $_POST["area"];
$error = 0;

if($area != $area_atual){
    $update = "UPDATE inscricao SET 
                        cod_rede ='$area'
                        WHERE
                        email_usuario = '$email_atual'";

    if(mysqli_query($conexao,$update)){
        $_SESSION['id_rede'] = $area;
    } else{
        $error = 1;
    }       
}

echo $error;
?>