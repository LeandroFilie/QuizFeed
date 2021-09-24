<?php
  session_start();

  if(!isset($_SESSION["email"])){
    echo "<script>location.href='index.php'</script>";
  }
  
  include './inc/conexao.php';

  if(empty($_POST)){
    $selectNomeRede = "SELECT rede.nome as nome, rede.id_rede as id_rede FROM rede INNER JOIN inscricao ON inscricao.email_usuario = '".$_SESSION["email"]."' AND inscricao.cod_rede = rede.id_rede";
    $resultadoNomeRede = mysqli_query($conexao,$selectNomeRede); 
    while($linha = mysqli_fetch_assoc($resultadoNomeRede)){
      $nomeRede = $linha['nome'];
      $idRede = $linha["id_rede"];
    }  
    $_SESSION["id_rede"] = $idRede;

    if(mysqli_num_rows($resultadoNomeRede) == 0){
      echo "<script>location.href='home.php'</script>";
    }
  }else{
    $selectNomeRede = "SELECT rede.nome as nome, rede.id_rede as id_rede FROM rede WHERE id_rede = '".$_POST["nome_rede"]."'";
    $resultadoNomeRede = mysqli_query($conexao,$selectNomeRede); 
    while($linha = mysqli_fetch_assoc($resultadoNomeRede)){
      $nomeRede = $linha['nome'];
      $idRede = $linha["id_rede"];
    }  
    
  }
  date_default_timezone_set('America/Sao_Paulo');
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

  <div class="form-vazio"></div>

  <form enctype="multipart/form-data" action="insere_post.php" method="POST">
    <div id="erro_post"></div>
    <div class="input-content-image">
      <textarea id="conteudo" name="conteudo" placeholder="O que você quer postar?"></textarea>
      <img id="preview-image" class="preview-image hide" alt="Preview imagem post"/>
      <div class="error-image"></div>
      <label class="input-image">
        <img src="./assets/images/image.svg" alt="Enviar Imagem" />
        <input type="file" name="imagem" id="imagem" accept="image/png, image/jpeg" />
        Foto/Vídeo
      </label>     
    </div>

    
    <div class="form-footer">
      <div class="user-info">
        <img src="<?php echo $_SESSION['avatar']; ?>" alt="Avatar" class="avatar" loading="lazy"/>
        <span><?php echo $_SESSION['nome_usuario']; ?></span>
      </div> 
      <button type='submit' id="postar">Postar</button>
    </div>
  </form>

  <section class="posts">
    
    <?php
      $selectPosts = "SELECT postagem.conteudo as conteudo, postagem.imagem as imagem, usuario_comum.nome_usuario as nome_usuario, usuario_comum.avatar as avatar, postagem.id_postagem as id_postagem, postagem.data as data, postagem.hora as hora, postagem.situacao as situacao FROM postagem INNER JOIN usuario_comum ON usuario_comum.email_usuario = postagem.email_usuario WHERE postagem.cod_rede = $idRede ";
      
      if($_SESSION["permissao"] != 1){
        $selectPosts .= "AND postagem.situacao = 1";
      }

      $selectPosts .= " ORDER BY postagem.id_postagem DESC";
      
      $resultadoPosts = mysqli_query($conexao,$selectPosts); 
  
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

          if($linha["situacao"] == 2){
            echo ' 
              <span class="msg-denuncia" value="'.$linha["id_postagem"].'">Post Denunciado. Tome alguma providência</span>
              <div class="post post-denunciado-adm" value="'.$linha["id_postagem"].'">
                  
            ';
          }
          else{
            echo ' <div class="post" value="'.$linha["id_postagem"].'">';
          }

          include "./inc/post.inc";
          
          echo ' </div>
        ';
        $i++;
      }

      if($i == 0){
        echo '
          <div class="empty-post">
            <img src="./assets/images/empty_post.svg" alt="Icone de Mensagem" loading="lazy">
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