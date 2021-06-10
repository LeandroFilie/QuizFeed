<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include './inc/head.inc' ?>    
    <link rel="stylesheet" href="./Bootstrap/bootstrap.min.css" />
    <script src="./Bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./style/dados.css">
    <title>Dados | TesteFeed</title>
</head>
<body>
  <?php
    include 'conexao.php';
    include './inc/menu.inc';
  ?>
  <main>
    <?php
      $select = 'SELECT * FROM usuario';

      if($_SESSION["permissao"] == 1){
        echo '
          <div class="filtro">
            <h3>Filtrar usuários</h3>
            <form method="POST" action="lista_usuarios.php">
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
              $select .= " AND nome_usuario like '$nome_usuario'";
          }
        }

        echo '<span id="msg"></span>';

        $resultado = mysqli_query($conexao,$select);
                
        while($linha = mysqli_fetch_assoc($resultado)){
          if($linha["id_usuario"] != 0){
            echo '
              <div class="data-user-details-adm">
                <div class="data-user-details-items-adm">
                  <p>@'.$linha["nome_usuario"].' </p>
                </div>
                <div class="data-user-details-items-adm">
                  <button class="data-user-adm alterar" value="'.$linha["id_usuario"].'" data-toggle="modal" data-target="#alterarDados">Ver mais</button>
                  <button class="data-user-delete-adm" id="user-delete" value="'.$linha["id_usuario"].'" data-toggle="modal" data-target="#excluirConta">Excluir Conta</button>
                </div>
              </div>  
              ';
          }
        }
      }
      else{
        $select .= " WHERE nome_usuario='".$_SESSION["nome_usuario"]."'";

        $resultado = mysqli_query($conexao,$select);

        echo '
            <div class="data-user-title">
              <img src="assets/dados.svg" Alt="user" class="icon-user"/>
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
                        <p>'.$linha["nome"].' </p>
                    </div>

                    <div class="data-user-details-items">
                      <h3>Nome de Usuário</h3>
                      <p>'.$linha["nome_usuario"].' </p>
                    </div>

                    <div class="data-user-details-items">
                      <h3>Endereço de E-mail</h3>
                      <p>'.$linha["email"].'</p>
                    </div>
                  </div>  
                  <div class="buttons-action">
                      <button class="data-user-action alterar" value="'.$linha["id_usuario"].'" data-toggle="modal" data-target="#alterarDados">Alterar Dados</button>
                      <button class="data-user-delete" id="user-delete" value="'.$linha["id_usuario"].'" data-toggle="modal" data-target="#excluirConta">Excluir Conta</button>
                  </div>
                ';
              }
        echo '</div>';
      } 
    ?>
  </main>
  
  <?php
    include './inc/footer.inc';

    include './inc/modal_editar.inc';
    include './inc/modal_excluir.inc';

    include 'scripts_usuario.php'; 
    echo '<input type="hidden" value="'.$_SESSION["permissao"].'" id="permissao">';
  ?>
</body>
</html>