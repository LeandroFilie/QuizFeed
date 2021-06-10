<?php

include "conexao.php";
session_start();

$nome = $_POST["nome"];
$nome_usuario = $_POST["nome_usuario"];
$email = $_POST["email"];
$id_usuario = $_POST["id_usuario"];

$update = "UPDATE usuario SET nome ='$nome',
                            nome_usuario = '$nome_usuario',
                            email = '$email'
                            WHERE
                            id_usuario = '$id_usuario'";

if(mysqli_query($conexao,$update)){
    echo '1';
}   
else{
    echo '2';
}

?>