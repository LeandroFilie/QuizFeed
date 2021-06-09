<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include './inc/head.inc' ?>
    <link rel="stylesheet" href="./style/index.css">
    <title>Home | TesteFeed</title>
</head>
<body>
    <header>
        <nav class="nav-index">
            <div><a href="#"><img src="./assets/logo.svg" alt="logo" class="logo"></a></div>
            <button id="js-open-menu" class="menu-button">
                <i class="menu-icon"></i>
            </button>
            <ul class="menu">
                <li><a href="cadastro.php">Cadastre-se</a></li>
                <li><a href="#about" class="go-about">Sobre</a></li>
            </ul>
        </nav>
        
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
                    <h3>Sobre o Trabalho</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <h3>Sobre o Quiz</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <h3>Sobre a Rede Colaborativa</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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