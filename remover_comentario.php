<?php
    include "./inc/conexao.php";

    $data = $_POST["data"];
    $hora = $_POST["hora"];
    $user = $_POST["email"];

    $delete = "DELETE FROM comentario WHERE email_usuario = '$user' AND hora = '$hora' AND data = '$data'";

    mysqli_query($conexao,$delete)
        or die("Erro: ".mysqli_error($conexao));

    echo '1';
?>