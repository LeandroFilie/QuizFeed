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
    <link rel="stylesheet" href="./style/dados.css">
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
        echo '
          <div class="data-user-title">
            <h1>Psicólogos</h1>
            <div>
              <p><a href="https://cadastro.cfp.org.br/" target="_blank">Clique aqui</a> para consultar o registro do profissional</p>
            </div>
          </div>
          <div id="msg"></div>
          <section id="tabs">
            <div class="tab-links">
                <button id="option-1">Aguardando Aprovação</button>
                <button id="option-2">Cadastrados</button>
            </div>
            <div class="tab-content-user">
              
              <section id="option-1-content">
                
        ';
                  $selectSituacao1 = 'SELECT nome, email_usuario, situacao FROM usuario_psicologo INNER JOIN usuario ON usuario.email = usuario_psicologo.email_usuario WHERE usuario_psicologo.situacao = "1"';
                  
                  $resultadoSituacao1 = mysqli_query($conexao,$selectSituacao1);

                  $i = 0;     
                  while($linha = mysqli_fetch_assoc($resultadoSituacao1)){
                    echo '
                          <div class="data-user-details-adm">
                            <div class="data-user-details-items-adm">
                              <p>'.$linha["nome"].' </p>
                            </div>
                            <div class="data-user-details-items-adm">
                              <button class="data-user-adm alterar" value="'.$linha["email_usuario"].'" data-toggle="modal" data-target="#alterarDadosPsicologo">Ver Dados</button>
                            </div>
                          </div>
                    ';
                    $i++;
                  }
                  if($i == 0){
                    echo '<h4 id="emptySituacao1">Não há pedidos pendentes</h4>';
                  }
        echo '</section>';

              $selectSituacao2 = 'SELECT nome, email_usuario FROM usuario_psicologo INNER JOIN usuario ON usuario.email = usuario_psicologo.email_usuario WHERE usuario_psicologo.situacao = "2 "';
                                
              $resultadoSituacao2 = mysqli_query($conexao,$selectSituacao2);

            echo '<section id="option-2-content">';

                  $j = 0;     
                  while($linha = mysqli_fetch_assoc($resultadoSituacao2)){
                    echo '
                        <div class="data-user-details-adm">
                          <div class="data-user-details-items-adm">
                            <p>'.$linha["nome"].' </p>
                          </div>
                          <div class="data-user-details-items-adm">
                            <button class="data-user-adm alterar" value="'.$linha["email_usuario"].'" data-toggle="modal" data-target="#alterarDadosPsicologo">Ver mais</button>
                            <button class="data-user-delete-adm delete" onclick="removerUser(\''.$linha['email_usuario'].'\')" data-toggle="modal" data-target="#excluirConta">Excluir Conta</button>
                          </div>
                        </div> 
                    ';
                      $j++;
                  }
                  if($j == 0){
                    echo '<h2 id="emptySituacao2">Não há psicólogos cadastrados</h2>';
                  }

        echo '
                
              </section>
          </section>
        ';
        
      }
      else if($_SESSION["permissao"] == 2){
        echo '
          <div class="filtro">
            <h3>Encontre psicólogos na sua cidade!</h3>
            <form method="POST" action="dados_psicologos.php">
              <div class="select-estados-cidades">
                  <select id="estado_filtro" name="estado_filtro">
                      <option value="" label="Estado"></option>';
                      include './inc/select_estados.inc';
                    echo '
                  </select>
                  <input type="text" name="cidade" placeholder="Cidade" />
              </div>
              <button>Pesquisar</button>
            </form>
          </div>
        ';

        $selectSituacao2 = 'SELECT nome, email_usuario, situacao FROM usuario_psicologo INNER JOIN usuario ON usuario.email = usuario_psicologo.email_usuario WHERE usuario_psicologo.situacao = "2"';

        if(!empty($_POST)){
          if($_POST["estado_filtro"] != ""){
            $uf = $_POST["estado_filtro"];
            $selectSituacao2 .= " AND uf = '$uf'";
          }
          if($_POST["cidade"] != ""){
            $cidade = $_POST["cidade"];
            $selectSituacao2 .= " AND cidade like '%$cidade%'";
          }
        }
        
        $resultadoSituacao2 = mysqli_query($conexao,$selectSituacao2);

        echo '<div id="data-user">';
          $i = 0;     
          while($linha = mysqli_fetch_assoc($resultadoSituacao2)){
            echo '
                  <div class="data-user-details-adm">
                    <div class="data-user-details-items-adm">
                      <p>'.$linha["nome"].' </p>
                    </div>
                    <div class="data-user-details-items-adm">
                      <button class="data-user-adm alterar" value="'.$linha["email_usuario"].'" data-toggle="modal" data-target="#alterarDadosPsicologo">Ver Dados</button>
                    </div>
                  </div>
            ';
            $i++;
          }
          if($i == 0){
            echo '<h2 id="emptySituacao1">Não há psicólogos cadastrados</h2>';
          }
        echo '</div>';
      } 
      else if($_SESSION["permissao"] == 3){
        if(($_SESSION["situacao"] == 2)||($_SESSION["situacao"] == 3)){
          $selectPsico = "SELECT nome, email, registro, cidade, uf, telefone FROM usuario INNER JOIN usuario_psicologo ON usuario.email = usuario_psicologo.email_usuario WHERE email='".$_SESSION["email"]."'";

          $resultado = mysqli_query($conexao,$selectPsico);

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
                        <p id="nome-psico">'.$linha["nome"].' </p>
                      </div>

                      <div class="data-user-details-items">
                        <h3>Endereço de Email</h3>
                        <p id="email-psico">'.$linha["email"].' </p>
                        <div id="erro_email"></div>
                      </div>

                      <div class="data-user-details-items">
                        <h3>Telefone</h3>
                        <p id="tel-psico">'.$linha["telefone"].' </p>
                      </div>

                      <div class="data-user-details-items">
                        <h3>Registro Federal de Psicologia</h3>
                        <p id="registro-psico">'.$linha["registro"].'</p>
                        <div id="erro_registro"></div>
                      </div>

                      <div class="data-user-details-items">
                        <h3>Localidade</h3>
                        <p id="local-psico">'.$linha["cidade"].' - '.$linha["uf"].'</p>
                      </div>

                    </div>  
                    <div class="buttons-action">
                        <button class="data-user-action alterar" value="'.$linha["email"].'" data-toggle="modal" data-target="#alterarDadosPsicologo">Alterar Dados</button>
                        <button class="data-user-delete delete" onclick="removerUser(\''.$linha['email'].'\')" data-toggle="modal" data-target="#excluirConta">Excluir Conta</button>
                    </div>
                  ';
                }
          echo '</div>';
        }
      }
    ?>
  </main>
  
  <?php
    include './inc/footer.inc';

    include './inc/modal_psicologo.inc';
  ?>

  <script src="./assets/bootstrap/bootstrap.min.js"></script>
  <script src="./assets/libs/sweetalert2.all.min.js"></script>
  <script src="./js/select_estados.js"></script>
  <script src="./assets/libs/jquery.mask.min.js"></script>
  <script src="./js/psicologo.js"></script>

</body>
</html>