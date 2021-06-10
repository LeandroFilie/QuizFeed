<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include './inc/head.inc' ?>
    <link rel="stylesheet" href="./style/cadastro.css">
    <script src="./js/cadastro.js"></script>
    <title>Cadastro | TesteFeed</title>
</head>
<body>
    <header>
        <nav>
            <div><a href="index.php"><img src="./assets/logo.svg" alt="logo" class="logo"></a></div>
            <button id="js-open-menu" class="menu-button">
                <i class="menu-icon"></i>
            </button>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="register-title">
            <h3>Crie sua Conta</h3>
        </div>
        <div class="form">
            <div id="erro_cadastro"></div>  

            <section id="tabs">
                <div class="tab-links">
                    <button id="option-1">Sou um usuário</button>
                    <button id="option-2">Sou um psicólogo</button>
                </div>
                <div class="tab-content-user">
                    <section id="option-1-content">
                        <div>   
                            <input type="text" name="nome_completo" id="nome_completo" placeholder="Nome Completo" required />
                        </div>

                        <div>
                            <input type="text" name="nome_usuario" id="nome_usuario" placeholder="Nome de Usuário" required />
                            <div id="erro_nome"></div>
                        </div>

                        <div>
                            <input type="email" name="email" id="email" placeholder="E-mail" required />
                            <div id="erro_email"></div>
                        </div>

                        <div id="campo_senha" class="campo_senha">
                            <input type="password" name="senha" id="senha" placeholder="Senha" required />
                            <img src="./assets/eye.svg" alt="" id="mostrar_senha" class="button_mostrar_senha">
                        </div>

                        <div id="campo_confirma_senha" class="campo_senha">
                            <input type="password" name="confirma_senha" id="confirma_senha" placeholder="Confirme a Senha" required />
                            <img src="./assets/eye.svg" alt="" id="mostrar_confirma_senha" class="button_mostrar_senha">
                        </div>

                        <div id="erro_senha"></div>

                        <button id="cadastro_usuario" class="register-btn">Cadastrar</button>
                    </section>

                    <section id="option-2-content">
                        <div>   
                            <input type="text" name="nome_completo_psi" id="nome_completo_psi" placeholder="Nome Completo" required />
                        </div>

                        <div>
                            <input type="email" name="email_psi" id="email_psi" placeholder="E-mail" required />
                            <div id="erro_email"></div>
                        </div>

                        <div>
                            <input type="number" name="crp" id="crp" placeholder="CRP" required />
                        </div>
                        
                        <div id="campo_senha_psi" class="campo_senha">
                            <input type="password" name="senha_psi" id="senha_psi" placeholder="Senha" required />
                            <img src="./assets/eye.svg" alt="" id="mostrar_senha_psi" class="button_mostrar_senha">
                        </div>

                        <div id="campo_confirma_senha_psi" class="campo_senha">
                            <input type="password" name="confirma_senha_psi" id="confirma_senha_psi" placeholder="Confirme a Senha" required />
                            <img src="./assets/eye.svg" alt="" id="mostrar_confirma_senha_psi" class="button_mostrar_senha">
                        </div>

                        <div id="erro_senha"></div>

                        <button id="cadastro_usuario" class="register-btn">Cadastrar</button>
                    </section>

                </div>
            </section>


            
        </div>
    </main>

    <?php include './inc/footer.inc' ?>

    <script>
        $(function(){
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

            $('#mostrar_confirma_senha').click(function(){
                if($('#confirma_senha').attr('type') == 'password'){
                    $('#confirma_senha').attr('type', 'text');
                    $('#mostrar_confirma_senha').attr('src', './assets/eye-off.svg');
                }
                else{
                    $('#confirma_senha').attr('type', 'password');
                    $('#mostrar_confirma_senha').attr('src', './assets/eye.svg');
                }
            });

            $('#mostrar_senha_psi').click(function(){
                if($('#senha_psi').attr('type') == 'password'){
                    $('#senha_psi').attr('type', 'text');
                    $('#mostrar_senha_psi').attr('src', './assets/eye-off.svg');
                }
                else{
                    $('#senha_psi').attr('type', 'password');
                    $('#mostrar_senha_psi').attr('src', './assets/eye.svg');
                }
            });

            $('#mostrar_confirma_senha_psi').click(function(){
                if($('#confirma_senha_psi').attr('type') == 'password'){
                    $('#confirma_senha_psi').attr('type', 'text');
                    $('#mostrar_confirma_senha_psi').attr('src', './assets/eye-off.svg');
                }
                else{
                    $('#confirma_senha_psi').attr('type', 'password');
                    $('#mostrar_confirma_senha_psi').attr('src', './assets/eye.svg');
                }
            });
        })
        
    </script>
</body>
</html>