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

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include './inc/head.inc' ?>
  <title><?php echo $nomeRede?> | TesteFeed</title>
  <link rel="stylesheet" href="./style/rede.css">
</head>
<body>
  <?php include './inc/menu.inc'; ?>
  
<main>
  <div class="header-rede">
    <div class="rede-title">
      <h1>
        <?php echo $nomeRede; ?>
      </h1>
    </div> 
  </div>

  <form>
    <div id="erro_post"></div>
    <textarea id="conteudo" placeholder="O que você quer postar?"></textarea>
    <div class="form-footer">
      <div class="user-info">
        <img src="./assets/images/avatar.svg" alt="Avatar" />
        <span><?php echo $_SESSION['nome_usuario']; ?></span>
      </div> 
      <button type='button' id="postar">Postar</button>
    </div>
  </form>

  <section class="posts">
    
    <?php
      $selectPosts = "SELECT postagem.conteudo as conteudo, usuario_comum.nome_usuario as nome_usuario, postagem.id_postagem as id_postagem FROM postagem  INNER JOIN usuario_comum ON usuario_comum.email_usuario = postagem.email_usuario WHERE postagem.cod_rede = $idRede ORDER BY postagem.id_postagem DESC";
      $resultadoPosts = mysqli_query($conexao,$selectPosts); 

      $_SESSION["id_rede"] = $idRede;  
      $i = 0;
      while($linha = mysqli_fetch_assoc($resultadoPosts)){
        $selectLikes = "SELECT email_usuario as email_curtida, cod_postagem as postagem_like FROM curtida";
        echo '
          <div class="post">
            <p>'.$linha["conteudo"].'</p>
            <div class="post-footer">
              <div class="user-info">
                <img src="./assets/images/avatar.svg" alt="Avatar" />
                <span>'.$linha["nome_usuario"].'</span>
              </div>
              <div class="interacoes">
                <img src="./assets/images/answer.svg" alt="comentar" class="comentar" onclick="exibeCampoComentar('.$linha["id_postagem"].')"/>
                <div class="like" id="like" value="'.$linha["id_postagem"].'" onclick="curtir('.$linha["id_postagem"].')">
                ';
                $selectLikes .= ' WHERE cod_postagem = '.$linha["id_postagem"].'';
                $resultadoLikes = mysqli_query($conexao,$selectLikes); 
                $qtdLikes = mysqli_num_rows($resultadoLikes);

                echo '  
                  <span id="likeCount">'.$qtdLikes.'</span>
                ';

                $selectLikeUser = "SELECT email_usuario as email_curtida, cod_postagem as postagem_like FROM curtida WHERE email_usuario = '".$_SESSION["email"]."' AND cod_postagem = '".$linha["id_postagem"]."'";
                $resultadoLikeUser = mysqli_query($conexao,$selectLikeUser); 

                if(mysqli_num_rows($resultadoLikeUser) > 0){
                  echo '<img src="./assets/images/liked.svg" alt="liked"  />';
                }
                else{
                  echo '<img src="./assets/images/like.svg" alt="like"  />';
                }
                echo '
                </div>
              </div>
            </div>

            <div class="section-comentarios">

              <div class="enviar-comentario hide" value='.$linha["id_postagem"].'>
                <input type="text" name="'.$linha["id_postagem"].'" placeholder="Escreva seu comentário" maxlength="500" />
                <img src="./assets/images/send.svg" alt="" class="button_enviar_comentario" onclick="comentar('.$linha["id_postagem"].')">
              </div>
              ';

              $selectComentarioPost = "SELECT usuario_comum.nome_usuario as nome_usuario, comentario.conteudo as conteudo FROM comentario INNER JOIN usuario_comum ON comentario.email_usuario = usuario_comum.email_usuario WHERE cod_postagem = '".$linha["id_postagem"]."' ORDER BY comentario.data ASC, comentario.hora ASC LIMIT 4";
              $resultadoComentarioPost = mysqli_query($conexao,$selectComentarioPost); 

              echo '<div id="'.$linha["id_postagem"].'">';
              $c = 0;
              while(($linhaComentarios = mysqli_fetch_assoc($resultadoComentarioPost)) && ($c < 3)){
                echo '
                  <div class="comentario">
                    <div class="avatar">
                      <img src="./assets/images/avatar.svg" alt="Avatar" />
                    </div>
                    <div class="comentario-content">
                      <span>'.$linhaComentarios["nome_usuario"].'</span>
                      <p>'.$linhaComentarios["conteudo"].'</p>
                    </div>
                  </div> 
                ';
                $c++;
              }

              if($c == 0){
                echo '<span class="empty-comment comentario-content" value='.$linha["id_postagem"].'>Seja o primeiro a comentar nesse post!</span>';
              }
              else{
                if(mysqli_num_rows($resultadoComentarioPost) > 3){
                  echo '<span class="ver-mais" onclick="allComentarios('.$linha["id_postagem"].')">Ver mais comentários</span>';
                  
                }
              }
              echo '
                  </div>';

              
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
            <p>Nenhum post por aqui...</p>
            <span>Seja o primeiro a postar!</span>
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