<?php
  session_start();

  if(!isset($_SESSION["email"])){
    echo "<script>location.href='index.php'</script>";
  }

  include './inc/conexao.php';

  $selectNomeRede = "SELECT rede.nome as nome, rede.id_rede as id_rede FROM rede INNER JOIN inscricao ON inscricao.email_usuario = '".$_SESSION["email"]."' AND inscricao.cod_rede = rede.id_rede";
  $resultadoNomeRede = mysqli_query($conexao,$selectNomeRede); 
  while($linha = mysqli_fetch_assoc($resultadoNomeRede)){
    $nomeRede = $linha['nome'];
    $idRede = $linha["id_rede"];
  }  

  if(mysqli_num_rows($resultadoNomeRede) == 0){
    echo "<script>location.href='home.php'</script>";
  }

  date_default_timezone_set('America/Sao_Paulo');


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include './inc/head.inc' ?>
  <title>Meus Posts | TesteFeed</title>
  <link rel="stylesheet" href="./style/rede.css">
</head>
<body>
  <?php include './inc/menu.inc'; ?>

<main>
  <div class="header-rede">
    <div class="rede-title">
      <h1>
        <?php echo "Meus Posts"; ?>
      </h1>
    </div> 
  </div>
  <form action="posts.php" method="post" class="filtro-areas">
      <select id="areas_post" name="areas_post">
          <option value="">Selecione uma Area</option>
      <?php 
        $selectAreaPost = "SELECT DISTINCT cod_rede, nome FROM postagem INNER JOIN rede ON rede.id_rede = postagem.cod_rede WHERE email_usuario = '".$_SESSION["email"]."'";
        $resultadoAreaPost = mysqli_query($conexao, $selectAreaPost);

        while($linha = mysqli_fetch_assoc($resultadoAreaPost)){
            echo '
                <option value="'.$linha["cod_rede"].'">'.$linha["nome"].'</option>
            ';

        }
      ?>      
      </select>
      <button>Pesquisar</button>
  </form>

  <section class="posts">

    <?php
      $selectPosts = "SELECT cod_rede, rede.nome as rede, postagem.conteudo as conteudo, usuario_comum.nome_usuario as nome_usuario, postagem.id_postagem as id_postagem, postagem.data as data, postagem.hora as hora FROM postagem  INNER JOIN usuario_comum ON usuario_comum.email_usuario = postagem.email_usuario INNER JOIN rede ON rede.id_rede = postagem.cod_rede WHERE usuario_comum.email_usuario = '".$_SESSION["email"]."' ";

      if(!empty($_POST)){
        if($_POST["areas_post"] != ""){
          $area = $_POST["areas_post"];
          $selectPosts .= " AND cod_rede = '$area'";
        }
      }
      $selectPosts .= "ORDER BY postagem.id_postagem DESC";  
      $resultadoPosts = mysqli_query($conexao,$selectPosts); 

      $_SESSION["id_rede"] = $idRede;  
      $i = 0;
      while($linha = mysqli_fetch_assoc($resultadoPosts)){
        $selectLikes = "SELECT email_usuario as email_curtida, cod_postagem as postagem_like FROM curtida";

        $dataPost = date('d/m/Y', strtotime($linha["data"]));
        $anoPost = date('Y', strtotime($linha["data"]));

        $dataAtual = date('d/m/Y');
        $anoAtual = date('Y');


        if($dataPost == $dataAtual){
          $dataFormatada = 'Hoje';
        }
        else if($anoPost == $anoAtual){
          $dataFormatada = date('d/m', strtotime($linha["data"]));
        }
        else{
          $dataFormatada = $dataPost;
        }

        $horaPost = date('H:i', strtotime($linha["hora"]));



        echo '
          <div class="post">
            <div class="rede-info">
                <span>'.$linha["rede"].'</span>
            </div> 
            <div class="post-info">
              <div class="post-info-details">
                
                <div class="user-info">
                  <img src="./assets/images/avatar.svg" alt="Avatar" />
                  <span>'.$linha["nome_usuario"].'</span>
                </div> 
                  
                <div class="post-info-content">
                  <span>'.$dataFormatada.'</span>
                  <span>'.$horaPost.'</span>
                </div>
              </div>
              <div class="denunciar">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
              </div>
            </div>
            <p>'.$linha["conteudo"].'</p>
            <div class="post-footer">';

            $selectLikes .= ' WHERE cod_postagem = '.$linha["id_postagem"].'';
            $resultadoLikes = mysqli_query($conexao,$selectLikes); 
            $qtdLikes = mysqli_num_rows($resultadoLikes);

            $selectCountComentarioPost = "SELECT conteudo FROM comentario WHERE cod_postagem = '".$linha["id_postagem"]."'";
            $resultadoCountComentarioPost = mysqli_query($conexao,$selectCountComentarioPost); 
            $qtdComentarios = mysqli_num_rows($resultadoCountComentarioPost);

              echo '
              <div class="info-interacoes" value="'.$linha["id_postagem"].'">
                <span id="likeCount">'.$qtdLikes.' Curtidas</span>
                <span id="comentarioCount">'.$qtdComentarios.' Comentários</span>
              </div>';

                $selectInteracoes = "SELECT email_usuario FROM inscricao WHERE email_usuario = '".$_SESSION["email"]."' AND cod_rede = '".$linha['cod_rede']."'";
                $resultadoInteracoes = mysqli_query($conexao,$selectInteracoes); 

                $selectLikeUser = "SELECT email_usuario as email_curtida, cod_postagem as postagem_like FROM curtida WHERE email_usuario = '".$_SESSION["email"]."' AND cod_postagem = '".$linha["id_postagem"]."'";
                $resultadoLikeUser = mysqli_query($conexao,$selectLikeUser);

               if(mysqli_num_rows($resultadoInteracoes) > 0){
                    echo '
                      <div class="interacoes">
                        <div class="like" value="'.$linha["id_postagem"].'" onclick="curtir('.$linha["id_postagem"].')">
                        ';
                        echo '  
                          <span >Curtir</span>
                        ';      
                          if(mysqli_num_rows($resultadoLikeUser) > 0){
                            echo '<img src="./assets/images/liked.svg" alt="liked"  />';
                          }
                          else{
                            echo '<img src="./assets/images/like.svg" alt="like"  />';
                          }
      
                          echo '
                        </div>
      
                        <div class="comentario" onclick="focusComentar('.$linha["id_postagem"].')">
                          <span>Comentar</span>
                        <img src="./assets/images/answer.svg" alt="comentar" class="comentar" />
                      </div>
                    </div>
                    ';
              }else{
                  echo '
                    <div class="not-interacoes">
                     
                    </div>
                  ';
                }

              echo '
            </div>
            
            <div class="section-comentarios">';

              echo '
                <div id="'.$linha["id_postagem"].'">';

                $selectComentarioPost = "SELECT usuario_comum.nome_usuario as nome_usuario, comentario.conteudo as conteudo, comentario.data as data, comentario.hora as hora FROM comentario INNER JOIN usuario_comum ON comentario.email_usuario = usuario_comum.email_usuario WHERE cod_postagem = '".$linha["id_postagem"]."' ORDER BY comentario.data ASC, comentario.hora ASC";
                
                  if($qtdComentarios > 3){
                    $initial = $qtdComentarios - 3;
    
                    $selectComentarioPost .= " LIMIT $initial, 3";

                    echo '<span class="ver-mais" onclick="allComentarios('.$linha["id_postagem"].')">Ver comentários mais antigos</span>';
                  }
    
                  $resultadoComentarioPost = mysqli_query($conexao,$selectComentarioPost); 


                  while(($linhaComentarios = mysqli_fetch_assoc($resultadoComentarioPost))){
                    $dataComentario = date('d/m/Y', strtotime($linhaComentarios["data"]));
                    $anoComentario = date('Y', strtotime($linhaComentarios["data"]));
            
                    $dataAtual = date('d/m/Y');
                    $anoAtual = date('Y');
            
            
                    if($dataComentario == $dataAtual){
                      $dataFormatadaComentario = 'Hoje';
                    }
                    else if($anoComentario == $anoAtual){
                      $dataFormatadaComentario = date('d/m', strtotime($linhaComentarios["data"]));
                    }
                    else{
                      $dataFormatadaComentario = $dataComentario;
                    }

                    $horaComentario = date('H:i', strtotime($linhaComentarios["hora"]));

                    echo '
                      <div class="comentario">
                        <div class="avatar">
                          <img src="./assets/images/avatar.svg" alt="Avatar" />
                        </div>
                        <div class="comentario-content">
                          <span>'.$linhaComentarios["nome_usuario"].'</span>
                          <p>'.$linhaComentarios["conteudo"].'</p>
                          <div class="comentario-info">
                            <span>'.$dataFormatadaComentario.'</span>
                            <span>'.$horaComentario.'</span>
                          </div>
                        </div>

                      </div> 
                    ';
                  }

              echo '
                </div>
              ';

              if(mysqli_num_rows($resultadoInteracoes) > 0){
                echo '
                  <div class="enviar-comentario" value='.$linha["id_postagem"].'>
                    <input type="text" name="'.$linha["id_postagem"].'" placeholder="Escreva seu comentário" maxlength="500" />
                    <img src="./assets/images/send.svg" alt="" class="button_enviar_comentario" onclick="comentar('.$linha["id_postagem"].')">
                  </div>
                ';
              }
                
            echo '
            </div>

          </div>
        ';
        $i++;
      }

      if($i == 0){
        echo '
          <div class="empty-post">
            <img src="./assets/images/empty_post.svg" alt="Icone de Mensagem">
            <p>Você não postou nada ainda...</p>
          </div>
        ';
      }
    ?>

  </section>
</main>

<?php include './inc/footer.inc' ?>

<script src="./js/rede.js" ></script>

</body>
</html>