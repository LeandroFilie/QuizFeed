<?php
    session_start();
    header('Content-Type: application/json');

    include "./inc/conexao.php";

    if($_GET["identificador"] == 1){
        $select = "SELECT nome, email, nome_usuario FROM usuario INNER JOIN usuario_comum ON usuario.email = usuario_comum.email_usuario";

        if(isset($_GET["email"])){
            $email = $_GET["email"];
            $select .= " WHERE usuario.email='$email'";
        }

        $resultado = mysqli_query($conexao,$select)
            or die(mysqli_error($conexao));

        $i = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            $matriz[]=$linha;
            $i++;
        }
        if($i == 0){
            $matriz = 0;
        }
        echo json_encode($matriz);

    }
    else if($_GET["identificador"] == 2){
        $select = "SELECT nome, email, registro, cidade, uf, situacao FROM usuario INNER JOIN usuario_psicologo ON usuario.email = usuario_psicologo.email_usuario";

        if(isset($_GET["situacao"])){
            $situacao = $_GET["situacao"];
            $select .= " WHERE usuario_psicologo.situacao='$situacao'";
        }

        if(isset($_GET["email"])){
            $email = $_GET["email"];
            $select .= " WHERE usuario.email='$email'";
        }

        $resultado = mysqli_query($conexao,$select)
            or die(mysqli_error($conexao));

        $j = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            $matriz[]=$linha;
            $j++;
        }
        if($j == 0){
            $matriz = 0;
        }
        echo json_encode($matriz);

    }
    else if($_GET["identificador"] == 3){
        $selectPosts = "SELECT postagem.conteudo as conteudo, usuario_comum.nome_usuario as nome_usuario, postagem.id_postagem as id_postagem FROM postagem INNER JOIN usuario_comum ON usuario_comum.email_usuario = postagem.email_usuario WHERE postagem.cod_rede = '".$_SESSION["id_rede"]."' ORDER BY postagem.id_postagem DESC";
        $resultadoPosts = mysqli_query($conexao,$selectPosts);

        $j = 0;
        while($linha = mysqli_fetch_assoc($resultadoPosts)){
            $matriz[]=$linha;
            $j++;
        }
        if($j == 0){
            $matriz = 0;
        }
        echo json_encode($matriz);


    }
    else if($_GET["identificador"] == 4){
        $selectLikeUser = "SELECT email_usuario as email_curtida, cod_postagem as postagem_like FROM curtida WHERE email_usuario = '".$_SESSION["email"]."' AND cod_postagem = '".$_GET["id"]."'";
        $resultadoLikeUser = mysqli_query($conexao,$selectLikeUser);

        $selectLikes = 'SELECT * FROM curtida WHERE cod_postagem = '.$_GET["id"].'';
        $resultadoLikes = mysqli_query($conexao,$selectLikes); 

        $matriz['qtdLikes'] = mysqli_num_rows($resultadoLikes);
        $matriz['verificaLikes'] = mysqli_num_rows($resultadoLikeUser);

        echo json_encode($matriz);
    }
?>