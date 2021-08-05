<?php
    session_start();
    header('Content-Type: application/json');

    include "./inc/conexao.php";

    if($_POST["identificador"] == 1){
        $select = "SELECT usuario.nome as nome, email, nome_usuario, rede.nome as rede FROM usuario INNER JOIN usuario_comum ON usuario.email = usuario_comum.email_usuario INNER JOIN inscricao ON usuario.email = inscricao.email_usuario INNER JOIN rede ON rede.id_rede=inscricao.cod_rede ";

        if(isset($_POST["email"])){
            $email = $_POST["email"];
            $select .= " WHERE usuario.email='$email'";
        }
        if(isset($_POST["area"])){
            $select .= " WHERE usuario.email='".$_SESSION["email"]."'";
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
    else if($_POST["identificador"] == 2){
        $select = "SELECT nome, email, registro, cidade, uf, situacao, telefone FROM usuario INNER JOIN usuario_psicologo ON usuario.email = usuario_psicologo.email_usuario";

        if(isset($_POST["situacao"])){
            $situacao = $_POST["situacao"];
            $select .= " WHERE usuario_psicologo.situacao='$situacao'";
        }

        if(isset($_POST["email"])){
            $email = $_POST["email"];
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
    else if($_POST["identificador"] == 3){
        $selectLikes = 'SELECT * FROM curtida WHERE cod_postagem = '.$_POST["id"].'';
        $resultadoLikes = mysqli_query($conexao,$selectLikes); 

        $matriz['qtdLikes'] = mysqli_num_rows($resultadoLikes);

        echo json_encode($matriz);
    }
    else if($_POST["identificador"] == 4){
        $id_postagem = $_POST["id_postagem"];
        $selectComentarioPost = "SELECT usuario_comum.nome_usuario as nome_usuario, comentario.conteudo as conteudo, comentario.data as data, comentario.hora as hora FROM comentario INNER JOIN usuario_comum ON comentario.email_usuario = usuario_comum.email_usuario WHERE cod_postagem = '$id_postagem' ORDER BY comentario.data ASC, comentario.hora ASC";
        $resultadoComentarioPost = mysqli_query($conexao,$selectComentarioPost); 

        $selectCountComentarioPost = "SELECT conteudo FROM comentario WHERE cod_postagem = '$id_postagem'";
        $resultadoCountComentarioPost = mysqli_query($conexao,$selectCountComentarioPost); 

        $j = 0;
        while($linha = mysqli_fetch_assoc($resultadoComentarioPost)){
            $dataComentario = date('d/m/Y', strtotime($linha["data"]));
            $anoComentario = date('Y', strtotime($linha["data"]));
    
            $dataAtual = date('d/m/Y');
            $anoAtual = date('Y');
    
    
            if($dataComentario == $dataAtual){
              $dataFormatadaComentario = 'Hoje';
            }
            else if($anoComentario == $anoAtual){
              $dataFormatadaComentario = date('d/m', strtotime($linha["data"]));
            }
            else{
              $dataFormatadaComentario = $dataComentario;
            }

            $horaComentario = date('H:i', strtotime($linha["hora"]));

            $linha['data'] = $dataFormatadaComentario;
            $linha['hora'] = $horaComentario;

            $matriz[]=$linha; 
            
            $j++;
        }
        if($j == 0){
            $matriz = 0;
        }

        $matriz["qtdComentarios"] = mysqli_num_rows($resultadoCountComentarioPost);
        echo json_encode($matriz);
    }
    else if($_POST["identificador"] == 5){
        $id_postagem = $_POST["id_postagem"];

        $selectCountComentarioPost = "SELECT conteudo FROM comentario WHERE cod_postagem = '$id_postagem'";
        $resultadoCountComentarioPost = mysqli_query($conexao,$selectCountComentarioPost); 
        $qtdComentarios = mysqli_num_rows($resultadoCountComentarioPost);

        $selectComentarioPost = "SELECT usuario_comum.nome_usuario as nome_usuario, comentario.conteudo as conteudo, comentario.data as data, comentario.hora as hora FROM comentario INNER JOIN usuario_comum ON comentario.email_usuario = usuario_comum.email_usuario WHERE cod_postagem = '$id_postagem' ORDER BY comentario.data ASC, comentario.hora ASC";


        if($qtdComentarios > 3){
            $initial = $qtdComentarios - 3;

            $selectComentarioPost .= " LIMIT $initial, 3";
        }


        
        $resultadoComentarioPost = mysqli_query($conexao,$selectComentarioPost); 

        $resultado = mysqli_query($conexao,$selectComentarioPost)
        or die(mysqli_error($conexao));

        $j = 0;
        while($linha = mysqli_fetch_assoc($resultadoComentarioPost)){
            $dataComentario = date('d/m/Y', strtotime($linha["data"]));
            $anoComentario = date('Y', strtotime($linha["data"]));
    
            $dataAtual = date('d/m/Y');
            $anoAtual = date('Y');
    
    
            if($dataComentario == $dataAtual){
              $dataFormatadaComentario = 'Hoje';
            }
            else if($anoComentario == $anoAtual){
              $dataFormatadaComentario = date('d/m', strtotime($linha["data"]));
            }
            else{
              $dataFormatadaComentario = $dataComentario;
            }

            $horaComentario = date('H:i', strtotime($linha["hora"]));

            $linha['data'] = $dataFormatadaComentario;
            $linha['hora'] = $horaComentario;

            $matriz[]=$linha;    

            $j++;
        }
        if($j == 0){
            $matriz = 0;
        }

        $matriz["qtdComentarios"] = $qtdComentarios;
        echo json_encode($matriz);
    }
    else if($_POST["identificador"] == 6){
        $selectFiltro = $_POST["select"];
        $resultadoFiltro = mysqli_query($conexao,$selectFiltro); 

        $j = 0;
        while($linha = mysqli_fetch_assoc($resultadoFiltro)){
            $matriz[]=$linha;
            $j++;
        }
        if($j == 0){
            $matriz = 0;
        }
        echo json_encode($matriz);

    }
    else if($_POST["identificador"] == 7){
        $id_area = $_POST["id"];

        $selectArea = "SELECT * FROM area WHERE id_area = $id_area";
        $resultadoArea = mysqli_query($conexao,$selectArea);

        while($linha = mysqli_fetch_assoc($resultadoArea)){
            $matriz[] = $linha;
        }

        echo json_encode($matriz);
    }
?>