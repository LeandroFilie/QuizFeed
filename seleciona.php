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
        $selectLikes = 'SELECT * FROM curtida WHERE cod_postagem = '.$_GET["id"].'';
        $resultadoLikes = mysqli_query($conexao,$selectLikes); 

        $matriz['qtdLikes'] = mysqli_num_rows($resultadoLikes);

        echo json_encode($matriz);
    }
    else if($_GET["identificador"] == 4){
        $id_postagem = $_GET["id_postagem"];
        $selectComentarioPost = "SELECT usuario_comum.nome_usuario as nome_usuario, comentario.conteudo as conteudo FROM comentario INNER JOIN usuario_comum ON comentario.email_usuario = usuario_comum.email_usuario WHERE cod_postagem = '$id_postagem' ORDER BY comentario.data DESC, comentario.hora DESC LIMIT 3";
        $resultadoComentarioPost = mysqli_query($conexao,$selectComentarioPost); 

        $selectCountComentarioPost = "SELECT conteudo FROM comentario WHERE cod_postagem = '$id_postagem'";
        $resultadoCountComentarioPost = mysqli_query($conexao,$selectCountComentarioPost); 

        $j = 0;
        while($linha = mysqli_fetch_assoc($resultadoComentarioPost)){
            $matriz[]=$linha;
            $j++;
        }
        if($j == 0){
            $matriz = 0;
        }

        $matriz["qtdComentarios"] = mysqli_num_rows($resultadoCountComentarioPost);
        echo json_encode($matriz);
    }
    else if($_GET["identificador"] == 5){
        $id_postagem = $_GET["id_postagem"];
        $selectComentarioPost = "SELECT usuario_comum.nome_usuario as nome_usuario, comentario.conteudo as conteudo FROM comentario INNER JOIN usuario_comum ON comentario.email_usuario = usuario_comum.email_usuario WHERE cod_postagem = '$id_postagem' ORDER BY comentario.data DESC, comentario.hora DESC";
        $resultadoComentarioPost = mysqli_query($conexao,$selectComentarioPost); 

        $resultado = mysqli_query($conexao,$selectComentarioPost)
        or die(mysqli_error($conexao));

        $j = 0;
        while($linha = mysqli_fetch_assoc($resultadoComentarioPost)){
            $matriz[]=$linha;
            $j++;
        }
        if($j == 0){
            $matriz = 0;
        }
        echo json_encode($matriz);
    }
?>