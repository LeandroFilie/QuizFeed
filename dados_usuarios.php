<?php
  session_start();

  if(!isset($_SESSION["email"])){
    echo "<script>location.href='index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include './inc/head.inc' ?>    
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap.min.css" />
    <script src="./assets/bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./style/dados_usuario.css">
    <title>Dados | TesteFeed</title>
</head>
<body>
  <?php
    include './inc/conexao.php';
    include './inc/menu.inc';
  ?>
  <main>
    <?php
      if($_SESSION["permissao"] == 1){

        $select = 'SELECT nome_usuario, email_usuario FROM usuario_comum';

        echo '
          <div class="filtro">
            <h3>Filtrar usuários</h3>
            <form method="POST" action="dados_usuarios.php">
              <input type="text" name="nome_usuario" id="nome_usuario" placeholder="Nome de Usuário" />
              <button>Pesquisar Usuário</button>
              <div id="msg"></div>
            </form>
          </div>
        ';

        if(!empty($_POST)){
          $select .= " WHERE(1=1)";
          if($_POST["nome_usuario"] != ""){
              $nome_usuario = $_POST["nome_usuario"];
              $select .= " AND nome_usuario like '%$nome_usuario%'";
          }
        }

        echo '<span id="msg"></span>';

        $resultado = mysqli_query($conexao,$select);

        $i = 0;
                
        while($linha = mysqli_fetch_assoc($resultado)){
          if($linha["nome_usuario"] != 'admin'){
            echo '
              <div class="data-user-details-adm">
                <div class="data-user-details-items-adm">
                  <p>@'.$linha["nome_usuario"].' </p>
                </div>
                <div class="data-user-details-items-adm">
                  <button class="data-user-adm alterar" value="'.$linha["email_usuario"].'" data-toggle="modal" data-target="#alterarDados">Ver mais</button>
                  <button class="data-user-delete-adm delete" onclick="removerUser(\''.$linha['email_usuario'].'\')" data-toggle="modal" data-target="#excluirConta">Excluir Conta</button>
                </div>
              </div>  
              ';

              $i++;
          }
        }
        
        if($i == 0){
          echo '<h2>Não há usuários cadastrados</h2>';
        }
        
      }
      else if($_SESSION["permissao"] == 2){
        $selectUsuario = "SELECT nome, email, nome_usuario FROM usuario INNER JOIN usuario_comum ON usuario.email = usuario_comum.email_usuario WHERE email='".$_SESSION["email"]."'";

        $resultado = mysqli_query($conexao,$selectUsuario);
        echo '
            <div class="data-user-title">
              
              <h1>Dados Pessoais</h1>
            </div>
            <div id="msg"></div>
            <div id="data-user">
        ';
              while($linha = mysqli_fetch_assoc($resultado)){
                echo '
                  <div class="data-user-details">
                    <div class="data-user-details-items">
                      <h3>Nome</h3>
                      <p id="nome-user">'.$linha["nome"].' </p>
                    </div>

                    <div class="data-user-details-items">
                      <h3>Nome de Usuário</h3>
                      <p id="nome-usuario-user">'.$linha["nome_usuario"].' </p>
                      <div id="erro_nome"></div>
                    </div>

                    <div class="data-user-details-items">
                      <h3>Endereço de E-mail</h3>
                      <p id="email-user">'.$linha["email"].'</p>
                      <div id="erro_email"></div>
                    </div>';

                    $selectNomeRede = "SELECT nome FROM rede INNER JOIN inscricao ON inscricao.email_usuario = '".$_SESSION["email"]."' AND inscricao.cod_rede = rede.id_rede";
                    $resultadoNomeRede = mysqli_query($conexao,$selectNomeRede); 
                    if(mysqli_num_rows($resultadoNomeRede) > 0){
                      while($linhaNomeRede = mysqli_fetch_assoc($resultadoNomeRede)){
                        echo '
                          <div class="data-user-details-items-area">
                            <div class="area">
                              <h3>Sua Área</h3>
                              <p id="area-user">'.$linhaNomeRede["nome"].'</p>
                            </div>
                            <div class="btn-area">
                              <button class="data-user-action-rede " data-toggle="modal" data-target="#trocarArea">Mudar de Rede</button>
                            </div>
                          </div>
                        ';
                      }
                    }
                  echo '
                  </div>  
                  <div class="buttons-action">
                      <button class="data-user-action alterar" value="'.$linha["email"].'" data-toggle="modal" data-target="#alterarDados">Alterar Dados</button>
                      <button class="data-user-delete delete" onclick="removerUser(\''.$linha['email'].'\')" data-toggle="modal" data-target="#excluirConta">Excluir Conta</button>
                  </div>
                ';
              }
        echo '</div>';
      } 
    ?>
  </main>
  
  <?php
    include './inc/footer.inc';

    include './inc/modal_usuario.inc';
    include './inc/modal_trocar_area.inc';

    echo '<input type="hidden" value="'.$_SESSION["permissao"].'" id="permissao">';
    echo '<input type="hidden" value="'.$_SESSION["email"].'" id="email_oculto">';
  ?>
  
  <script src="./js/usuario.js"></script>

</body>
</html>