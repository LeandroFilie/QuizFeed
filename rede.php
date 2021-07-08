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

<main>
  <div class="header-rede">
    <div class="rede-title">
      <h1>Ciências Exatas</h1>
    </div>
    <div class="user-info">
      <img src="./assets/avatar.svg" alt="Avatar" />
      <span><?php echo $_SESSION['nome_usuario']; ?></span>
    </div>  
  </div>
  
  <form>
    <textarea name="" id="" placeholder="O que você quer postar?"></textarea>
    <div class="form-footer">
      <button>Postar</button>
    </div>
  </form>

  <section class="posts">
    <div class="post">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus facere adipisci animi accusantium fuga sunt quod, ocabo nisi. Adipisci laborum aut praesentium modi deserunt nihil.</p>
      <div class="post-footer">
        <div class="user-info">
          <img src="./assets/avatar.svg" alt="Avatar" />
          <span>NomeUsuário</span>
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
            <div class="avatar">
              <img src="./assets/avatar.svg" alt="Avatar" />
            </div>
            <div class="comentario-content">
              <span>@NomeUsuário</span>
              <p>Comentário aquiii!!</p>
            </div>
          </div>

          <div class="comentario">
            <div class="avatar">
              <img src="./assets/avatar.svg" alt="Avatar" />
            </div>
            <div class="comentario-content">
              <span>@NomeUsuário</span>
              <p>Comentário aquiii!!</p>
            </div>
          </div>
        </div>
    </div>

    <div class="post">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus facere adipisci animi accusantium fuga sunt quod, ocabo nisi. Adipisci laborum aut praesentium modi deserunt nihil.</p>
      <div class="post-footer">
        <div class="user-info">
          <img src="./assets/avatar.svg" alt="Avatar" />
          <span>NomeUsuário</span>
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
  </section>
</main>

<?php include './inc/footer.inc' ?>
<?php include './scripts_rede.php' ?>

</body>
</html>