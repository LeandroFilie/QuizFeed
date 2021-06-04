<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./assets/favicon.png" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/home.css">
    <link rel="stylesheet" href="./style/menu_mobile.css">
    <title>Home | TesteFeed</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/main.js"></script>
</head>
<body>

    
    
    <?php 
    
        include 'menu.inc'; 

        echo '
            <main>
                <div class="section-title">
                    <h1 class="title">Seja bem-vindo, '.$_SESSION["nome_usuario"].'</h1>
                </div>
        ';
    
        if($_SESSION["permissao"] == 1){
            echo '

                <section id="tabs">
                    <div class="tab-links">
                        <button id="option-1">Gerenciar Rede Colaborativa</button>
                        <button id="option-2">Gerenciar Quiz</button>
                    </div>

                    <div class="tab-content-adm">
                        <section id="option-1-content">
                            <div class="card">
                                <p>Usuários Cadastrados</p>
                                <button>Ver todos</button>
                            </div>
                            <div class="card">
                                <p>Redes Colaborativas</p>
                                <button>Ver todas</button>
                            </div>
                        </section>
                        <section id="option-2-content">
                            <div class="card">
                                <p>Perguntas do Quiz</p>
                                <button>Cadastrar</button>
                            </div>
                            <div class="card">
                                <p>Perguntas do Quiz</p>
                                <button>Listar</button>
                            </div>
                        </section>
                    </div>
                </section>

            ';

        }
        else{
            echo '

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
    
    ?>

    </main>
    <footer>
        <span> Site desenvolvido por: Carol, Julia Costa e Leandro</span>
    </footer>

    <script>
        feather.replace();

        $(document).ready(function(){
            $('#option-1-content').hide();
            $('#option-2-content').hide();

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
        });

    </script>
</body>
</html>