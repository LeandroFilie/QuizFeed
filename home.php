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
                    <h1 class="title">Sejá bem-vindo, '.$_SESSION["nome_usuario"].'</h1>
                </div>
        ';
    
        if($_SESSION["permissao"] == 1){
            //painel do adm
        }
        else{
            echo '

                <div class="section-description-question">
                    <p>Me fala, você já fez alguma orientação vocacional com algum especialista?</p>
                </div>
                <div id="tabs">
                    <div class="tab-links">
                        <button id="sim_button">Sim, já fiz</button>
                        <button id="nao_button">Não, nunca fiz</button>
                    </div>

                    <div class="tab-content">
                        <section id="sim_content">
                            <p>Então escolha a sua área de maior afinidade</p>
                        </section>
                        <section id="nao_content">
                            <p>Então bora fazer um quiz?</p>
                            <div class="section-cta">
                                <a href="teste.html"><button>Iniciar Quiz</button></a>
                            </div>
                        </section>
                    </div>
                </div>
                
                
               
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
            $('#sim_content').hide();
            $('#nao_content').hide();

            $('#sim_button').click(function(){
                $('#nao_content').hide();
                $('#sim_content').show();

                $('#nao_button').removeClass('active');
                $('#sim_button').toggleClass('active');
            });

            $('#nao_button').click(function(){
                $('#sim_content').hide();
                $('#nao_content').show();

                $('#sim_button').removeClass('active');
                $('#nao_button').toggleClass('active');
            });
        });

    </script>
</body>
</html>