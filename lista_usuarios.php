<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./assets/favicon.png" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados | TesteFeed</title>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/main.js"></script>
    <link rel="stylesheet" href="./Bootstrap/bootstrap.min.css" />
    <script src="./Bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/dados.css">
    <link rel="stylesheet" href="./style/menu_mobile.css"> 
</head>
<body>
  <?php
    include 'conexao.php';
    include 'menu.inc';
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
                  <button class="data-user-adm">Ver mais</button>
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
            <div class="data-user-details">
              <div class="data-user-details-items">
                <h3>Nome</h3>
        ';
        while($linha = mysqli_fetch_assoc($resultado)){
          echo '
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
                <button class="data-user-action" data-toggle="modal" data-target="#alterarDados">Alterar Dados</button>
                <button class="data-user-delete" id="user-delete" value="'.$linha["id_usuario"].'" data-toggle="modal" data-target="#excluirConta">Excluir Conta</button>
            </div>
          ';
        }
      } 
    ?>
  </main>
  <footer>
      <span> Site desenvolvido por: Carol, Julia Costa e Leandro</span>
  </footer>

    <!-- Modal Alterar Dados -->
    <div class="modal fade " id="alterarDados" tabindex="-1" role="dialog" aria-labelledby="important-msg-label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title">Alterar Dados</h4>
            </div>
            <div class="modal-body modal-form">
              <input type="text" name="nome" placeholder="Nome Completo" />
              <input type="text" name="nome" placeholder="Nome Completo" />
              <input type="text" name="nome" placeholder="Nome Completo" />
            </div>
            <div class="modal-footer">
              <button class="data-user-action-cancel" data-dismiss="modal">Cancelar</button>
              <button class="data-user-action-save">Salvar</button>
            </div>
          </div>
        </div>
    </div>

    <!-- Modal Excluir Conta -->
    <div class="modal fade " id="excluirConta" tabindex="-1" role="dialog" aria-labelledby="important-msg-label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title">Excluir Conta</h4>
            </div>
            <div class="modal-body">
              <p class="modal-text">Tem certeza que deseja excluir sua conta?</p>
            </div>
            <div class="modal-footer">
              <button class="data-user-action-cancel" data-dismiss="modal">Não</button>
              <button class="data-user-action-save remover">Sim</button>
            </div>
          </div>
        </div>
    </div>
<?php 
  include 'scripts_usuario.php'; 
  echo '<input type="hidden" value="'.$_SESSION["permissao"].'" id="permissao">';
  
?>
</body>
</html>