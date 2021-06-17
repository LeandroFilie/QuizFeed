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
                            <button id="option-2">Gerenciar Quiz e Redes</button>
                        </div>

                        <div class="tab-content-adm">
                            <section id="option-1-content">
                                <div class="card">
                                    <p>Usuários</p>
                                    <a href="./lista_usuarios.php"><button>Ver todos</button></a>
                                </div>
                                <div class="card">
                                    <p>Psicólogos</p>
                                    <button>Ver todas</button>
                                </div>
                            </section>
                            <section id="option-2-content">
                                <div class="card">
                                    <p>Sites dos Testes</p>
                                    <button>Cadastrar</button>
                                </div>
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
                                <p>Então bora fazer um quiz?</p>
                                <div class="section-cta">
                                    <a href="teste.html"><button>Iniciar Quiz</button></a>
                                </div>
                            </section>
                        </div>
                    </section>
                ';
            }
            else if($_SESSION["permissao"] == 3){
                if($_SESSION["situacao"] == 1){
                    echo '
                        <div class="section-title">
                            <h1 class="title">Seja bem-vindo!<br/> Aguarde o administrador aprovar o seu cadastro</h1>
                        </div>
                    ';
                }
            }
        ?>
    </main>
    <footer>
        <span> Site desenvolvido por: Carol, Julia Costa e Leandro</span>
    </footer>

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