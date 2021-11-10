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
    <title>Home | QuizFeed</title>
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="./style/home.css">
    <script src="./assets/bootstrap/bootstrap.min.js" defer></script>
    <script src="js/home.js" defer></script>
    <script src="js/rede.js" defer></script>
</head>
<body>
    <?php 
        include './inc/menu.inc'; 
        include './inc/conexao.php';    
    ?>
    <main>
        <?php

            function exibeAreas(){
                include './inc/conexao.php';   
                $selectAreas = 'SELECT * FROM area';
                $resultadoAreas = mysqli_query($conexao, $selectAreas);

                while($linha = mysqli_fetch_assoc($resultadoAreas)){
                    echo '
                        <option value="'.$linha["id_area"].'">'.$linha["nome"].'</option>
                    ';

                }
            }

            if($_SESSION["permissao"] == 1){
                echo '
                    <div class="section-title">
                        <h1 class="title">Seja bem-vindo, @'.$_SESSION["nome_usuario"].'</h1>
                    </div>

                    <section class="cards">

                        <section class="card-adm">
                            <div class="card-title">Gerenciamento de Usuários</div>
                            <div class="item">
                                <p>Comuns</p>
                                <a href="./dados_usuarios.php"><button>Ver todos</button></a>
                            </div>
                            <div class="item">
                                <p>Psicólogos</p>
                                <a href="./dados_psicologos.php"><button>Ver todos</button></a>
                            </div>
                        </section>

                        <section class="card-adm">
                            <div class="card-title">Gerenciamento das Redes</div>
                            <div class="item">
                                <form action="rede.php" method="get">
                                    <select id="nome_rede" name="nome_rede">
                                        <option value="">Selecione uma Rede</option>
                                    ';
                                    exibeAreas();
                                    echo '
                                    </select>

                                    <button type="submit">Ir para a Rede</button>
                                </form>
                            </div>
                            <div class="item">
                                <p>Posts Denunciados</p>
                                <button><a href="posts_denunciados.php">Ver Mais</a></button>
                            </div>

                        </section>

                    </section>
                    ';
            }
            else if($_SESSION["permissao"] == 2){
                $selectNomeRede = "SELECT rede.nome as nome, rede.id_rede as id_rede FROM rede INNER JOIN inscricao ON inscricao.email_usuario = '".$_SESSION["email"]."' AND inscricao.cod_rede = rede.id_rede";
                $resultadoNomeRede = mysqli_query($conexao,$selectNomeRede); 
          
                if(mysqli_num_rows($resultadoNomeRede) == 0){ //Usuário sem Rede
                    echo '
                        <div class="section-title">
                            <h1 class="title">Seja bem-vindo, @'.$_SESSION["nome_usuario"].'</h1>
                        </div>
                    ';
                    echo '
                        <section id="steps">

                            <ul class="steps-bar">
                                <li data-step="1" class="active">1</li>
                                <span data-step="2" class="divider"></span>
                                <li data-step="2">2</li>
                                <span data-step="3" class="divider"></span>
                                <li data-step="3">3</li>
                            </ul>

                            <div class="steps">
                                <div class="steps-options">
                                    
                                    <div class="step active" data-step="1">
                                        <div class="step-content">
                                            <p>Você tem alguma ideia de área que quer seguir ou está completamente perdido?</p>
                                            <div class="buttons-options">
                                                <button class="select-option" value="1" >Tenho uma ideia</button>
                                                <button class="select-option" value="2" >Estou perdido</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="option-1">
                                    <div class="step" data-step="2">
                                        <div class="step-content">
                                            <h3>Que legal que você está decidido!</h3>
                                            <p>Entre em uma área aqui</p>
                                            
                                            <select id="nome_rede" class="nome_rede_option-1">
                                                <option value="">Selecione uma Rede</option>';
                                                exibeAreas();
                                            echo '
                                            </select>

                                            <span class="erro_entrar_rede"></span>
                                            <button class="btn-entrar-rede-option-1">Entrar na Rede</button>

                                            <span class="obs">* Fique tranquilo, se você se arrepender poderá trocar!</span>

                                            <span class="separator">ou</span>

                                            <p>Veja detalhes sobre as áreas para ajudar em sua escolha</p>

                                            <select id="nome_rede" class="detalhe-area">
                                                <option value="">Selecione uma Área</option>';
                                                exibeAreas();

                                            echo '
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="option-2">
                                    <div class="step" data-step="2">
                                        <div class="step-content">
                                            <h3>Já que você está perdido, temos duas opções:</h3>
                                            <p>Faça uma orientação Vocacional com um profissional!<br /> 
                                            <span data-toggle="modal" data-target="#listaPsicologos" class="link">Clique aqui</span> e veja profissionais </p>

                                            <span class="separator">ou</span>

                                            <p>Faça testes vocacionais online</p>
                                            <ul class="lista-testes">
                                                <li class="link"><a href="https://www.guiadacarreira.com.br/teste-vocacional/" target="_blank">Guia da Carreira</a></li>
                                                <li class="link"><a href="https://www.vix.com/pt/comportamento/546867/qual-profissao-mais-combina-com-voce-este-teste-vocacional-te-ajuda-a-descobrir" target="_blank">Vix</a></li>
                                                <li class="link"><a href="https://querobolsa.com.br/teste-vocacional-gratis" target="_blank">Quero Bolsa</a></li>
                                            </ul>

                                            <span class="obs">* O recomendado é você se consultar com um profissional especializado</span>
                                        </div>
                                    </div>

                                    <div class="step" data-step="3">
                                        <div class="step-content">
                                            <h3>Agora é com você!</h3>
                                            <p>Já está decidido? Entre em uma área aqui</p>
                                            <select id="nome_rede" class="nome_rede_option-2">
                                                <option value="">Selecione uma Área</option>';
                                                exibeAreas();
                                            echo '
                                            </select>

                                            <span class="erro_entrar_rede"></span>
                                            <button class="btn-entrar-rede-option-2">Entrar na Rede</button>

                                            <span class="obs">* Fique tranquilo, se você se arrepender poderá trocar!</span>

                                            <span class="separator">ou</span>

                                            <p>Veja detalhes sobre as áreas para ajudar em sua escolha</p>

                                            <select id="nome_rede_detalhes" class="detalhe-area">
                                                <option value="">Selecione uma Rede</option>';
                                                exibeAreas();
                                            echo '
                                            </select>


                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="buttons">
                                <button class="prev-btn">Anterior</button>
                                <button class="next-btn">Próximo</button>
                            </div>
                        </section>
                    ';
                }
                else{ // Usuário na rede
                    while($linha = mysqli_fetch_assoc($resultadoNomeRede)){
                        $nomeRede = $linha['nome'];
                        $_SESSION["id_rede"] = $linha["id_rede"];
                    } 

                    $selectPosts = "SELECT postagem.conteudo as conteudo, usuario_comum.avatar as avatar, usuario_comum.nome_usuario as nome_usuario FROM postagem  INNER JOIN usuario_comum ON usuario_comum.email_usuario = postagem.email_usuario WHERE postagem.cod_rede = '".$_SESSION["id_rede"]."' AND postagem.situacao = 1 ORDER BY postagem.id_postagem DESC LIMIT 3 ";
                    $resultadoPosts = mysqli_query($conexao,$selectPosts);
                    echo '
                        <section class="cards">

                            <section class="card-area">
                                <p>Sua área de maior afinidade é</p>
                                <h2 id="nomeRede">'.$nomeRede.'</h2>
                                <span>Ainda está em dúvida? Quer ir para outra rede? <a href="" class="link" data-toggle="modal" data-target="#trocarArea">Clique Aqui</a></span>
                                <a href="posts.php"><button>Meus Posts</button></a>
                                <a href="dados_usuarios.php"><button>Meus Dados</button></a>
                            </section>
                    
                            <section class="card-rede">
                                <h2>Últimos Posts</h2>
                                <div class="last-posts">
                    ';              
                                    $i = 0;
                                    while($linha = mysqli_fetch_assoc($resultadoPosts)){
                                        echo '
                                            <div class="post">
                                                <div class="data-user">
                                                    <img src="'.$linha["avatar"].'" alt="avatar">
                                                    <span>'.$linha["nome_usuario"].'</span>
                                                </div>
                                
                                                <div class="conteudo">';
                                                if($linha["conteudo"] != ''){
                                                    echo ''.$linha["conteudo"].'';
                                                }
                                                else{
                                                    echo 'Imagem';
                                                }
                                                    
                                                echo '
                                                </div>
                                            </div>
                                        ';
                                        $i++;
                                    }
                                    if($i == 0){
                                        echo '
                                          <div class="empty-post">
                                            <img src="./assets/images/empty_post.svg" alt="Icone de Mensagem">
                                            <p>Nenhum post por aqui...</p>
                                            <span>Seja o primeiro a postar!</span>
                                          </div>
                                        ';
                                    }
                    echo '
                        </div>
                        <a href="rede.php"><button>Ir à Rede</button></a>
                    </section>
                </section>
                    ';                
                    
                }
            }
            else if($_SESSION["permissao"] == 3){
                if($_SESSION["situacao"] == 1){
                    echo '
                        <div class="section-title">
                            <h1 class="title">Seja bem-vindo!<br/> Aguarde o administrador aprovar o seu cadastro</h1>
                        </div>
                    ';
                }
                else if($_SESSION["situacao"] == 2){
                    echo '
                        <div class="section-title">
                            <h1 class="title">Seja bem-vindo!<br/> Seu cadastro foi aprovado</h1>
                            
                        </div>
                    ';
                }
                else if($_SESSION["situacao"] == 3){
                    echo '
                        <div class="section-title">
                            <h1 class="title">Seu cadastro não foi aprovado!<br /> Confira seus dados e/ou regularize seu registro e solicite novamente</h1>
                        </div>
                    ';
                }
            }
        ?>
    </main>
    <?php include './inc/footer.inc';  ?>
    <?php 
        include './inc/modal_lista_psicologos.inc';
        include './inc/modal_area.inc';
        include './inc/modal_trocar_area.inc';
    ?>
</body>
</html>