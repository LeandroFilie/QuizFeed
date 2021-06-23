<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include './inc/head.inc' ?>    
    <link rel="stylesheet" href="./Bootstrap/bootstrap.min.css" />
    <script src="./Bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./style/dados_psicologo.css">
    <script src="./js/select_estados.js"></script>
    <title>Dados | TesteFeed</title>
</head>
<body>
  <?php
    include 'conexao.php';
    include './inc/menu.inc';
  ?>
  <main>
    <?php
        echo '
        <div class="filtro">
          <h3>Filtrar Psicólogos</h3>
          <form method="POST" action="dados_psicologos.php">
            <input type="text" name="nome" id="nome" placeholder="Nome" />
            <input type="text" name="crp" id="crp" placeholder="CRP" />
            <div class="select-estados-cidades">
                <select id="estado" name="estado">
                    <option value="0" label="Estado"></option>';
                    include './inc/select_estados.inc';
                  echo '
                </select>
                <input type="hidden" name="estado_uf" id="estado_uf" />
                <input type="text" name="cidade" placeholder="Cidade" />
            </div>
            <button>Pesquisar</button>
            <div id="msg"></div>
          </form>
        </div>
      ';
      if($_SESSION["permissao"] == 1){
        echo '
          <section id="tabs">
            <div class="tab-links">
                <button id="option-1">Aguardando Aprovação</button>
                <button id="option-2">Cadastrados</button>
            </div>
            <div class="tab-content-user">
              <section id="option-1-content">
                <div class="data-user-details-adm">
        ';

                  $selectSituacao1 = 'SELECT nome, email_usuario FROM usuariopsicologo INNER JOIN usuario ON usuario.email = usuariopsicologo.email_usuario WHERE usuariopsicologo.situacao = "1"';
                  
                  if(!empty($_POST)){
                    if($_POST["nome"] != ""){
                      $nome = $_POST["nome"];
                      $selectSituacao1 .= " AND usuario.nome like '%$nome%'";
                    }
                    if($_POST["crp"] != ""){
                      $crp = $_POST["crp"];
                      $selectSituacao1 .= " AND crp = '$crp'";
                    }
                    if($_POST["estado"] != 0){
                      $uf = $_POST["estado_uf"];
                      $selectSituacao1 .= " AND uf = '$uf'";
                    }
                    if($_POST["cidade"] != ""){
                      $cidade = $_POST["cidade"];
                      $selectSituacao1 .= " AND cidade like '%$cidade%'";
                    }
                  }

                  
                  
                  $resultadoSituacao1 = mysqli_query($conexao,$selectSituacao1);

                  $i = 0;     
                  while($linha = mysqli_fetch_assoc($resultadoSituacao1)){
                    echo '
                          <div class="data-user-details-items-adm">
                            <p>'.$linha["nome"].' </p>
                          </div>
                          <div class="data-user-details-items-adm">
                            <button class="data-user-adm alterar" value="'.$linha["email_usuario"].'" data-toggle="modal" data-target="#alterarDadosPsicologo">Ver Dados</button>
                            <button class="data-user-adm alterar" value="'.$linha["email_usuario"].'" data-toggle="modal" data-target="#alterarDadosPsicologo">Aprovar</button>
                            <button class="data-user-delete-adm" id="user-delete" value="'.$linha["email_usuario"].'" data-toggle="modal" data-target="#excluirConta">Reprovar</button>
                          </div>
                    ';
                    $i++;
                  }
                  if($i == 0){
                    echo '<h2>Não há pedidos pendentes</h2>';
                  }
        echo '
                </div> 
              </section>';

              $selectSituacao2 = 'SELECT nome, email_usuario FROM usuariopsicologo INNER JOIN usuario ON usuario.email = usuariopsicologo.email_usuario WHERE usuariopsicologo.situacao = "2 "';
              
              if(!empty($_POST)){
                if($_POST["nome"] != ""){
                  $nome = $_POST["nome"];
                  $selectSituacao2 .= " AND usuario.nome like '%$nome%'";
                }
                if($_POST["crp"] != ""){
                  $crp = $_POST["crp"];
                  $selectSituacao2 .= " AND crp = '$crp'";
                }
                if($_POST["estado"] != 0){
                  $uf = $_POST["estado_uf"];
                  $selectSituacao2 .= " AND uf = '$uf'";
                }
                if($_POST["cidade"] != ""){
                  $cidade = $_POST["cidade"];
                  $selectSituacao2 .= " AND cidade like '%$cidade%'";
                }
              }
                  
              $resultadoSituacao2 = mysqli_query($conexao,$selectSituacao2);


            echo '
              <section id="option-2-content">
                <div class="data-user-details-adm">
            ';
                  $j = 0;     
                  while($linha = mysqli_fetch_assoc($resultadoSituacao2)){
                    echo '
                        <div class="data-user-details-items-adm">
                          <p>'.$linha["nome"].' </p>
                        </div>
                        <div class="data-user-details-items-adm">
                          <button class="data-user-adm alterar" value="'.$linha["email_usuario"].'" data-toggle="modal" data-target="#alterarDadosPsicologo">Ver mais</button>
                          <button class="data-user-delete-adm" id="user-delete" value="'.$linha["email_usuario"].'" data-toggle="modal" data-target="#excluirConta">Excluir Conta</button>
                        </div>
                    ';
                      $j++;
                  }
                  if($j == 0){
                    echo '<h2>Não há usuários cadastrados</h2>';
                  }

        echo '
                </div> 
              </section>
          </section>
        ';
        
        
      }
      /* else if($_SESSION["permissao"] == 2){
        $selectUsuario = "SELECT nome, email, nome_usuario FROM usuario INNER JOIN usuariocomum ON usuario.email = usuariocomum.email_usuario WHERE email='".$_SESSION["email"]."'";

        $resultado = mysqli_query($conexao,$selectUsuario);

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
                    </div>
                  </div>  
                  <div class="buttons-action">
                      <button class="data-user-action alterar" value="'.$linha["email"].'" data-toggle="modal" data-target="#alterarDados">Alterar Dados</button>
                      <button class="data-user-delete" id="user-delete" value="'.$linha["email"].'" data-toggle="modal" data-target="#excluirConta">Excluir Conta</button>
                  </div>
                ';
              }
        echo '</div>';
      }  */
    ?>
  </main>

  <?php
    function filtro($select){
      
        // $select .= " WHERE(1=1)";
        
      }
    
  ?>
  
  <?php
    include './inc/footer.inc';

    include './inc/modal_editar_psicologo.inc';
    include './inc/modal_excluir.inc';

    include 'scripts_psicologo.php'; 
    echo '<input type="hidden" value="'.$_SESSION["permissao"].'" id="permissao">';
    echo '<input type="hidden" value="'.$_SESSION["email"].'" id="email_oculto">';
  ?>

  <script>
    $(function(){
      $('#estado').change(function(){
          $.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+$(this).val(),function(u){
            $('#estado_uf').val(u.sigla);
            console.log(u.sigla);
          }) 
      })

      initOptions();

      $('#option-1').click(function(){
          $('#option-2-content').hide();
          $('#option-1-content').show();
  
          $('#option-2').removeClass('active');
          $('#option-1').toggleClass('active');
      });
  
      $('#option-2').click(function(){
          $('#option-1-content').hide();
          $('#option-2-content').show();
  
          $('#option-1').removeClass('active');
          $('#option-2').toggleClass('active');
      });
  
      function initOptions(){
          $('#option-2-content').hide();
          $('#option-1').toggleClass('active');
      }
    })
    
  </script>
</body>
</html>