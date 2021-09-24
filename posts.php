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
      $selectPosts = "SELECT cod_rede, rede.nome as rede, postagem.conteudo as conteudo, postagem.imagem as imagem, usuario_comum.nome_usuario as nome_usuario, usuario_comum.avatar as avatar, postagem.id_postagem as id_postagem, postagem.data as data, postagem.hora as hora, postagem.situacao as situacao FROM postagem  INNER JOIN usuario_comum ON usuario_comum.email_usuario = postagem.email_usuario INNER JOIN rede ON rede.id_rede = postagem.cod_rede WHERE usuario_comum.email_usuario = '".$_SESSION["email"]."' ";

      if(!empty($_POST)){
        if($_POST["areas_post"] != ""){
          $area = $_POST["areas_post"];
          $selectPosts .= " AND cod_rede = '$area'";
        }
      }
      $selectPosts .= "ORDER BY postagem.id_postagem DESC";  
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
            <span class="msg-denuncia" value="'.$linha["id_postagem"].'">Seu Post foi denunciado e o administrador está tomando providências</span>
            <div class="post post-denunciado-adm" value="'.$linha["id_postagem"].'">
          ';
        }
        else{
          echo ' <div class="post" value="'.$linha["id_postagem"].'">';
        }

        echo '
            <div class="rede-info">
                <span>'.$linha["rede"].'</span>
            </div>';

          include "./inc/post.inc";
          echo '</div>
        ';
        $i++;
      }

      if($i == 0){
        echo '
          <div class="empty-post">
            <img src="./assets/images/empty_post.svg" alt="Icone de Mensagem" loading="lazy" />
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