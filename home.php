<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include './inc/head.inc' ?>
    <title>Home | TesteFeed</title>
    <link rel="stylesheet" href="./style/home.css">
</head>
<body>
    <?php 
        include './inc/menu.inc'; 
        include './inc/conexao.php';    
    ?>
    <main>
        <?php
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
                            <select id="nome_rede">
                                <option value="">Selecione uma Rede</option>
                            ';
                            
                            $selectAreas = 'SELECT * FROM area';
                            $resultadoAreas = mysqli_query($conexao, $selectAreas);

                            while($linha = mysqli_fetch_assoc($resultadoAreas)){
                                echo '
                                    <option value="'.$linha["id_area"].'">'.$linha["nome"].'</option>
                                ';
                            }
                            echo '
                            </select>

                            <button>Ir para a Rede</button>

                        </section>

                    </section>
                    ';
                /* echo '
                    <div class="section-title">
                        <h1 class="title">Seja bem-vindo, @'.$_SESSION["nome_usuario"].'</h1>
                     </div>
                    <section id="tabs">
                        <div class="tab-links">
                            <button id="option-1">Gerenciar Usuários</button>
                            <button id="option-2">Gerenciar Redes Colaborativas</button>
                        </div>

                        <div class="tab-content-adm">
                            <section id="option-1-content">
                                <div class="card">
                                    <p>Usuários</p>
                                    <a href="./dados_usuarios.php"><button>Ver todos</button></a>
                                </div>
                                <div class="card">
                                    <p>Psicólogos</p>
                                    <a href="./dados_psicologos.php"><button>Ver todos</button></a>
                                </div>
                            </section>
                            <section id="option-2-content">
                                <div class="card">
                                    <p>Redes Colaborativas</p>
                                    <button>Listar</button>
                                </div>
                            </section>
                        </div>
                    </section>

                '; */
            }
            else if($_SESSION["permissao"] == 2){
                $selectNomeRede = "SELECT rede.nome as nome, rede.id_rede as id_rede FROM rede INNER JOIN inscricao ON inscricao.email_usuario = '".$_SESSION["email"]."' AND inscricao.cod_rede = rede.id_rede";
                $resultadoNomeRede = mysqli_query($conexao,$selectNomeRede); 
          
                if(mysqli_num_rows($resultadoNomeRede) == 0){
                    echo '
                        <div class="section-title">
                            <h1 class="title">Seja bem-vindo, @'.$_SESSION["nome_usuario"].'</h1>
                        </div>

                        <section class="cards">

                            <section class="card-inicio">
                                <div class="card-title">Está completamente perdido? Comece por aqui!</div>
                                <p>Quer fazer uma orientação vocaional? <a href="#">Clique aqui</a> e veja profissionais da área.</p>
                                <span class="separator">ou</span>
                                <div class="lista-testes">
                                    <p class="text-testes">Faça testes vocacionais online</p>
                                    <div class="testes">
                                        <a href="https://www.guiadacarreira.com.br/teste-vocacional/" target="_blank" >Guia da Carreira</a>
                                        <a href="https://querobolsa.com.br/teste-vocacional-gratis" target="_blank" >Quero Bolsa</a>
                                        <a href="https://www.vix.com/pt/comportamento/546867/qual-profissao-mais-combina-com-voce-este-teste-vocacional-te-ajuda-a-descobrir" target="_blank" >Vix</a>
                                    </div>
                                </div>
                                <span class="obs">* O recomendado é você se consultar com um profissional especializado</span>
                            </section>

                            <section class="card-redes">
                                <div class="card-title">Já tem uma área em mente? Já fez um teste ou orientação vocaional? Selecione aqui!</div>
                                <select id="nome_rede">
                                    <option value="">Selecione uma Rede</option>
                                ';
                                
                                $selectAreas = 'SELECT * FROM area';
                                $resultadoAreas = mysqli_query($conexao, $selectAreas);

                                while($linha = mysqli_fetch_assoc($resultadoAreas)){
                                    echo '
                                        <option value="'.$linha["id_area"].'">'.$linha["nome"].'</option>
                                    ';
                                }
                                echo '
                                </select>
                                
                                <button>Entrar na Rede</button>

                                <span class="separator">ou</span>

                                <p><a href="#">Clique aqui</a> para saber mais sobre as áreas de conhecimento e os cursos mais populares</p>

                            </section>

                        </section>
                    ';
                        
                }
                else{
                    while($linha = mysqli_fetch_assoc($resultadoNomeRede)){
                        $nomeRede = $linha['nome'];
                        $idRede = $linha["id_rede"];
                    } 

                    $selectPosts = "SELECT postagem.conteudo as conteudo, usuario_comum.nome_usuario as nome_usuario FROM postagem  INNER JOIN usuario_comum ON usuario_comum.email_usuario = postagem.email_usuario WHERE postagem.cod_rede = $idRede ORDER BY postagem.id_postagem DESC LIMIT 3";
                    $resultadoPosts = mysqli_query($conexao,$selectPosts);
                    echo '
                        <section class="cards">

                            <section class="card-area">
                                <p>Sua área de maior afinidade é</p>
                                <h2>'.$nomeRede.'</h2>
                                <span>Ainda está em dúvida? Quer ir para outra rede? <a href="" class="link">Clique Aqui</a></span>
                                <a href="rede.php"><button>Meus Posts</button></a>
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
                                                    <img src="./assets/images/avatar.svg" alt="avatar">
                                                    <span>'.$linha["nome_usuario"].'</span>
                                                </div>
                                
                                                <div class="conteudo">
                                                    '.$linha["conteudo"].'
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
                            <h1 class="title">Seu cadastro não foi aprovado!<br /> Regularize seu registro e solicite novamente</h1>
                        </div>
                    ';
                }
            }
        ?>
    </main>
    <?php include './inc/footer.inc';  ?>
</body>
</html>