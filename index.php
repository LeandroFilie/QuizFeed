<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include './inc/head.inc' ?>
    <link rel="stylesheet" href="./style/index.css">
    <title>Home | TesteFeed</title>
</head>
<body>
    <header class="header-index">   
        <div class="nav">
            <nav class="nav-index">
                <a href="home.php"><img src="./assets/logo.svg" alt="logo" class="logo"></a>
                <button id="js-open-menu" class="menu-button">
                    <i class="menu-icon"></i>
                </button>
                <ul class="menu">
                
                    <li><a href="cadastro.php">Cadastre-se</a></li>
                
                
                    <li><a href="#about">Sobre</a></li>
                </ul>
            </nav>   
        </div> 
             
        <div class="header-content">
            <div class="card-login">
                <h1>Login</h1>   
                <div id="erro_aut"></div>
                <input type="text" name="email" id="email" placeholder="E-mail" />
                <div id="campo_senha" class="campo_senha">
                    <input type="password" name="senha" id="senha" placeholder="Senha" required />
                    <img src="./assets/eye.svg" alt="" id="mostrar_senha">
                </div>
                <button id="autenticar">Entrar</button>
                <span class="recovey">Recuperar Senha</span>
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

    <?php include './inc/footer.inc' ?>

    <script>
        $(document).ready(function(){
            $("#autenticar").click(function(){
                var email = $("#email").val();
                var senha_md5 = $.md5($("#senha").val());

                $.post("autenticacao.php",{"email":email,"senha":senha_md5},function(r){
                    console.log(r);
                    if(r == 1){
                        location.href="home.php";
                    }
                    else if(r == 2){
                        $("#erro_aut").addClass("erro_aut");
                        $("#erro_aut").html("Erro na autentificação");
                    }
                });
            });

            $('#mostrar_senha').click(function(){
                if($('#senha').attr('type') == 'password'){
                    $('#senha').attr('type', 'text');
                    $('#mostrar_senha').attr('src', './assets/eye-off.svg');
                }
                else{
                    $('#senha').attr('type', 'password');
                    $('#mostrar_senha').attr('src', './assets/eye.svg');
                }
            });
        });
    </script>
</body>
</html>