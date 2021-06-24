<?php
    session_start();

    include "conexao.php";

    $email = $_POST["email"];
    $senha = $_POST["senha"];
    

    $sql = "SELECT permissao, email FROM usuario WHERE email='$email' AND senha='$senha'";
    

    $resultado = mysqli_query($conexao,$sql)
                                    or die(mysqli_error($conexao));

    if(mysqli_num_rows($resultado) == 1){
        $linha = mysqli_fetch_assoc($resultado);

        $_SESSION["permissao"] = $linha["permissao"];
        $_SESSION["email"] = $linha["email"];

        if($_SESSION["permissao"] != 3){


            $sql2 = "SELECT nome_usuario FROM usuario_comum INNER JOIN usuario ON usuario.email = usuario_comum.email_usuario WHERE usuario.email = '$email'";
            $resultado = mysqli_query($conexao,$sql2);

            $linha = mysqli_fetch_assoc($resultado);

            $_SESSION["nome_usuario"] = $linha["nome_usuario"];

            
        }
        else{
            $sql3 = "SELECT registro, situacao FROM usuario_psicologo INNER JOIN usuario ON usuario.email = usuario_psicologo.email_usuario WHERE usuario.email = '$email'";
            $resultado = mysqli_query($conexao,$sql3);

            $linha = mysqli_fetch_assoc($resultado);

            $_SESSION["registro"] = $linha["registro"];
            $_SESSION["situacao"] = $linha["situacao"];
        }

        echo '1';
    }
    else{
        echo '2';
    }
?>