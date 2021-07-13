<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include './inc/head.inc' ?>
  <title>Rede Colaborativa | TesteFeed</title>
  <link rel="stylesheet" href="./style/rede.css">
</head>
<body>
  <?php include './inc/menu.inc'; ?>
  
  <?php
    include 'conexao.php';

    $selectNomeRede = "SELECT rede.nome as nome, rede.id_rede as id_rede FROM rede INNER JOIN inscricao ON inscricao.email_usuario = '".$_SESSION["email"]."' AND inscricao.cod_rede = rede.id_rede";
    $resultadoNomeRede = mysqli_query($conexao,$selectNomeRede); 
    while($linha = mysqli_fetch_assoc($resultadoNomeRede)){
      $nomeRede = $linha['nome'];
      $idRede = $linha["id_rede"];
    }    
    $selectPosts = "SELECT postagem.conteudo as conteudo, usuario_comum.nome_usuario as nome_usuario FROM postagem  INNER JOIN usuario_comum ON usuario_comum.email_usuario = postagem.email_usuario WHERE postagem.cod_rede = $idRede ORDER BY postagem.data, postagem.hora DESC";
    $resultadoPosts = mysqli_query($conexao,$selectPosts); 

    $_SESSION["id_rede"] = $idRede;
  
  ?>
  
<main>
  <div class="header-rede">
    <div class="rede-title">
      <h1>
        <?php echo $nomeRede; ?>
      </h1>
    </div>
    <div class="user-info">
      <img src="./assets/avatar.svg" alt="Avatar" />
      <span><?php echo $_SESSION['nome_usuario']; ?></span>
    </div>  
  </div>
  
  <form>
    <div id="erro_post"></div>
    <textarea id="conteudo" placeholder="O que você quer postar?"></textarea>
    <div class="form-footer">
      <button type='button' id="postar">Postar</button>
    </div>
  </form>

  <section class="posts">
    
    <?php
    $i = 0;
      while($linha = mysqli_fetch_assoc($resultadoPosts)){
        echo '
          <div class="post">
            <p>'.$linha["conteudo"].'</p>
            <div class="post-footer">
              <div class="user-info">
                <img src="./assets/avatar.svg" alt="Avatar" />
                <span>'.$linha["nome_usuario"].'</span>
              </div>
              <div class="interacoes">
                <img src="./assets/answer.svg" alt="comentar" class="comentar">
                <div class="like">
                  <span id="likeCount">10</span>
                  <img src="./assets/like.svg" alt="like">
                </div>
              </div>
            </div>

            <div class="section-comentarios">
              <div class="enviar-comentario hide">
                <input type="text" placeholder="Escreva seu comentário" />
                <img src="./assets/send.svg" alt="" id="mostrar_senha" class="button_enviar_comentario">
              </div>

              <div class="comentario">
                <div class="comentario-content">
                  <p>Seja o primeiro a comentar nesse post!</p>
                </div>
              </div>

            </div>

          </div>
        ';

        $i++;
      }

      if($i == 0){
        echo '
          <div class="empty-post">
            <img src="./assets/empty_post.svg" alt="Icone de Mensagem">
            <p>Nenhum post por aqui...</p>
            <span>Seja o primeiro a postar!</span>
          </div>
        ';
      }
    ?>

  </section>
</main>

<?php include './inc/footer.inc' ?>
<?php include './scripts_rede.php' ?>

</body>
</html>