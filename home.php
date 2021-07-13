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
    ?>
    <main>
        <?php
            if($_SESSION["permissao"] == 1){
                echo '
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

                ';
            }
            else if($_SESSION["permissao"] == 2){
                //USUÁRIO SEM REDE
                if(){
                    echo '
                        <div class="section-title">
                            <h1 class="title">Seja bem-vindo, @'.$_SESSION["nome_usuario"].'</h1>
                         </div>
                        <section class="section-description-question">
                            <p>Me fala, você já fez alguma orientação vocacional com algum especialista?</p>
                        </section>
                        <section id="tabs">
                            <div class="tab-links">
                                <button id="option-1">Sim, já fiz</button>
                                <button id="option-2">Não, nunca fiz</button>
                            </div>
    
                            <div class="tab-content">
                                <section id="option-1-content">
                                    <p>Então escolha a sua área de maior afinidade</p>
                                </section>
                                <section id="option-2-content">
                                    <div class="section-cta">
                                        <div class="cta-psicologos">
                                            <p>Veja profissionais especializados para você fazer uma orientação vocacional</p>
                                            <a href="./dados_psicologos.php"><button>Ver mais</button></a>
                                        </div>
                                        <div class="cta-testes">
                                            <p>Veja testes vocacionais online que podem te ajudar também</p>
                                            <button>Ver mais</button>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </section>
                    ';
                }
                else{ //USUÁRIO COM REDE
                    echo '
                        <section class="cards">

                            <section class="card-area">
                                <p>Sua área de maior afinidade é</p>
                                <h2>Ciências Exatas</h2>
                                <span>Ainda está em dúvida? Quer ir para outra rede? <a href="" class="link">Clique Aqui</a></span>
                                <button>Meus Posts</button>
                                <button>Meus Dados</button>
                            </section>
                    
                            <section class="card-rede">
                                <h2>Últimos Posts</h2>
                                <div class="last-posts">
                        
                                    <div class="post">
                                    <div class="data-user">
                                        <img src="./assets/avatar.svg" alt="avatar">
                                        <span>NomeUsuario</span>
                                    </div>
                        
                                    <div class="conteudo">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit sint quasi dolorem eligendi, modi consectetur a! At aut corrupti culpa sint saepe error, eum, porro velit ipsa, voluptas quo placeat.
                                    </div>
                                    </div>
                        
                                    <div class="post">
                                    <div class="data-user">
                                        <img src="./assets/avatar.svg" alt="avatar">
                                        <span>NomeUsuario</span>
                                    </div>
                        
                                    <div class="conteudo">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit sint quasi dolorem eligendi, modi consectetur a! At aut corrupti culpa sint saepe error, eum, porro velit ipsa, voluptas quo placeat.
                                    </div>
                                    </div>
                        
                                </div>
                                <button>Ver Mais</button>
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

    <script>
        $(function(){
            ocultarOptions();

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
        
            function ocultarOptions(){
                $('#option-1-content').hide();
                $('#option-2-content').hide();
            }
        });
    </script>
</body>
</html>