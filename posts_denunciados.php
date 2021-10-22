<?php
  session_start();

  if(!isset($_SESSION["email"]) || $_SESSION["permissao"] != 1){
    echo "<script>location.href='index.php'</script>";
  }

  include './inc/conexao.php';

  date_default_timezone_set('America/Sao_Paulo');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include './inc/head.inc' ?>
  <title>Posts Denunciados | TesteFeed</title>
  <link rel="stylesheet" href="./style/rede.css">
  <script src="./js/rede.js" defer></script>
</head>
<body>
  <?php include './inc/menu.inc'; ?>

<main>

  <?php
    $selectPosts = "SELECT cod_rede, rede.nome as rede, postagem.conteudo as conteudo, postagem.imagem as imagem, usuario_comum.nome_usuario as nome_usuario, usuario_comum.avatar as avatar, postagem.id_postagem as id_postagem, postagem.data as data, postagem.hora as hora, postagem.situacao as situacao FROM postagem  INNER JOIN usuario_comum ON usuario_comum.email_usuario = postagem.email_usuario INNER JOIN rede ON rede.id_rede = postagem.cod_rede WHERE postagem.situacao = 2 ";

    $title = 'Posts Denunciados';
    if(!empty($_POST)){
      if($_POST["areas_post"] != ""){
        $area = $_POST["areas_post"];

        $selectAreaPosts = "SELECT nome FROM rede WHERE id_rede = $area";
        $resultadoAreaPosts = mysqli_query($conexao,$selectAreaPosts); 
        $resultadoAreaPosts = implode("", mysqli_fetch_row($resultadoAreaPosts));
        $title .= " - $resultadoAreaPosts";

        $selectPosts .= " AND cod_rede = '$area'";
      }
    }

    $selectPosts .= "ORDER BY postagem.id_postagem DESC";  
    $resultadoPosts = mysqli_query($conexao,$selectPosts); 
    $qtdPostsDenunciados = mysqli_num_rows($resultadoPosts);
  ?>
  <div class="header-rede">
    <div class="rede-title">
      <h1><?php echo $title ?></h1>
    </div>
      <?php  
        echo "<p>Pendentes: <span id='qtdPosts'>$qtdPostsDenunciados</span></p>";
      ?> 
  </div>
  <form action="posts_denunciados.php" method="post" class="filtro-areas">
      <select id="areas_post" name="areas_post">
          <option value="">Selecione uma Area</option>
      <?php 
        $selectAreas = 'SELECT * FROM area';
        $resultadoAreas = mysqli_query($conexao, $selectAreas);

        while($linha = mysqli_fetch_assoc($resultadoAreas)){
            echo '
                <option value="'.$linha["id_area"].'">'.$linha["nome"].'</option>
            ';
        }
      ?>      
      </select>
      <button>Pesquisar</button>
  </form>

  <section class="posts">

    <?php
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
        echo '
            <div class="rede-info">
                <span>'.$linha["rede"].'</span>
            </div> ';

            include './inc/post.inc';
          echo '
          </div>
          ';
        $i++;
      }

      if($i == 0){
        echo '
          <div class="empty-post">
            <img src="./assets/images/empty_post.svg" alt="Icone de Mensagem" loading="lazy" />
            <p>Nenhum post denunciado por aqui!</p>
          </div>
        ';
      }
    ?>

  </section>
</main>

<?php include './inc/footer.inc' ?>

</body>
</html>