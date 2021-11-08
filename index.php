<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include './inc/head.inc' ?>
    <link rel="stylesheet" href="./style/index.css">
    <title>Home | QuizFeed</title>
</head>
<body>
    <header class="header-index">   
        <div class="nav">
            <nav class="nav-index">
                <a href="home.php"><img src="./assets/images/logo.svg" alt="logo" class="logo"></a>
                <button id="js-open-menu" class="menu-button">
                    <i class="menu-icon"></i>
                </button>
                <ul class="menu">
                    <li><a href="cadastro.php">Cadastre-se</a></li>
                    <li><a href="#about">Sobre</a></li>
                    <li><a href="#faq">Faq</a></li>
                    <li><a href="areas.php">Áreas</a></li>
                </ul>
            </nav>   
        </div> 
             
        <div class="header-content">
            <div class="card-login">
                <h1>Login</h1>   
                <div id="erro_aut"></div>
                <form method="post" class="form" id="form">
                    <input type="text" name="email" id="email" placeholder="E-mail" />
                    <div id="campo_senha" class="campo_senha">
                        <input type="password" name="senha" id="senha" placeholder="Senha" required />
                        <img src="./assets/images/eye.svg" alt="mostrar_ocultar_senha" id="mostrar_senha">
                    </div>
                    <button type="submit" id="autenticar">Entrar</button>
                </form>
            </div>
        </div>
    </header>

    <section  id="about" class="about">
        <h1 class="about-title">Sobre</h1>
        <div class="about-card">
            <div class="card">
                <div class="card-content">
                    <h3>Nossa Motivação</h3>
                    <p>
                        O motivo de criarmos um sistema relacionado a faculdade, foi observarmos que há uma grande responsabilidade e pressão sobre jovens e adolescentes em relação a vida profissional e carreira.</strong>
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <h3>Fique Calmo!</h3>
                    <p>
                        A maioridade chega, e sente-se uma necessidade forte de escolher um caminho que parece que será trilhado pela vida toda, mas não precisa ser assim.</strong>
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <h3>Um Cantinho Pra Geral!</h3>
                <p>
                    Além da rede colaborativa auxiliar os jovens que estão entrando na vida adulta, também pode dar uma mão para quem não sente que está no caminho certo e gostaria de mudar, é um lugar em que há espaço para todas as faixas etárias, então sejam todos/as bem vindos/as!</strong>
                </p>
                </div>
            </div>
        </div>
    </section>
    <section class="faq" id="faq">
        <h1 class="faq-title">Perguntas Frequentes</h1>
        <div class="faq-content">
            <div class="faq-item">
                <button class="accordion">O que é Orientação Vocacional?</button>
                <div class="panel">
                    <p>Orientação Vocacional é uma especialidade que psicólogos podem escolher seguir. Eles irão utilizar de métodos comprovados e autorizados cientificamente, que apenas eles podem ter acesso, juntamente com todos os conhecimentos adquiridos pelos mesmos em suas experiências acadêmicas. Então, após um período de terapia vocacional, você poderá estar no caminho mais certo para seguir de acordo com o seu perfil, gostos e escolhas.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="accordion">A Orientação Vocacional é apenas um teste rápido?</button>
                <div class="panel">
                    <p>Não! A Orientação Vocacional possui sim os testes devidamente autorizados para auxiliar o profissional a entender seu paciente, mas não é somente isso. O atendimento é personalizado, já que você pode ter suas próprias dúvidas, medos e curiosidades, principalmente relacionados a sua vida pessoal!</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="accordion">E se eu estiver muito perdida (o)?</button>
                <div class="panel">
                    <p>Tudo bem estar perdido! O profissional está preparado para receber você de qualquer forma, você pode tirar todas as suas dúvidas e compartilhar seus pensamentos a respeito disso também, já que não deixa de ser uma terapia. Além de tudo, é um processo de auto conhecimento, onde você vai conhecer e entender o seu próprio perfil e personalidade</p>
                </div>
            </div>
        </div>
    </section>

    <?php include './inc/footer.inc' ?>

    <script src="./assets/libs/md5.js"></script>
    <script>
        $(document).ready(function(){
            $('#form').submit(function(event){
                event.preventDefault();
                var email = $("#email").val();
                var senha_md5 = $.md5($("#senha").val());

                $.post("autenticacao.php",{"email":email,"senha":senha_md5},function(r){
                    if(r == 1){
                        location.href="home.php";
                    }
                    else if(r == 2){
                        $("#erro_aut").addClass("erro_aut");
                        $("#erro_aut").html("Erro na autentificação");
                    }
                });
            })
/*             $("#autenticar").click(function(){
                var email = $("#email").val();
                var senha_md5 = $.md5($("#senha").val());

                $.post("autenticacao.php",{"email":email,"senha":senha_md5},function(r){
                    if(r == 1){
                        location.href="home.php";
                    }
                    else if(r == 2){
                        $("#erro_aut").addClass("erro_aut");
                        $("#erro_aut").html("Erro na autentificação");
                    }
                });
            }); */

            $('#mostrar_senha').click(function(){
                if($('#senha').attr('type') == 'password'){
                    $('#senha').attr('type', 'text');
                    $('#mostrar_senha').attr('src', './assets/images/eye-off.svg');
                }
                else{
                    $('#senha').attr('type', 'password');
                    $('#mostrar_senha').attr('src', './assets/images/eye.svg');
                }
            });

            function itemsAccordion(){
                var items = $('.accordion');

                for(let i = 0; i < items.length; i++){
                    $(items[i]).click(function(){
                        $(items[i]).toggleClass('active');
                        var panel = $(items[i]).next();

                        if(panel.css('display') == 'block') {
                            panel.css('display', 'none');
                        } 
                        else{
                            panel.css('display', 'block');
                        }
                        
                        if(panel.css('maxHeight') === '0px'){
                            panelScrollHeight = `${panel.prop("scrollHeight")}px`;
                            panel.css('maxHeight', panelScrollHeight);
                        } 
                        else{
                            panel.css('maxHeight', '0px');
                        } 
                    })
                }
                
            }

            itemsAccordion();
        });
    </script>
</body>
</html>