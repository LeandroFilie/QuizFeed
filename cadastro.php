<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include './inc/head.inc' ?>
    <link rel="stylesheet" href="./style/cadastro.css">
    
    <title>Cadastro | TesteFeed</title>
</head>
<body>
    <header class="header">
        <nav>
            <div><a href="index.php"><img src="./assets/images/logo.svg" alt="logo" class="logo"></a></div>
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
            <section id="tabs">
                <div class="tab-links">
                    <button id="option-1">Sou um usuário</button>
                    <button id="option-2">Sou um psicólogo</button>
                </div>
                <div class="tab-content-user">
                    <section id="option-1-content">
                        <div id="erro_cadastro"></div>  
                        <div>   
                            <input type="text" name="nome_completo" id="nome_completo" placeholder="Nome Completo" required />
                        </div>

                        <div>
                            <input type="text" name="nome_usuario" id="nome_usuario" placeholder="Nome de Usuário" maxlength="20" required />
                            <div id="erro_nome"></div>
                        </div>

                        <div>
                            <input type="email" name="email" id="email" placeholder="E-mail" required />
                            <div id="erro_email"></div>
                        </div>

                        <div id="campo_senha" class="campo_senha">
                            <input type="password" name="senha" id="senha" placeholder="Senha" required />
                            <img src="./assets/images/eye.svg" alt="" id="mostrar_senha" class="button_mostrar_senha">
                        </div>

                        <div id="campo_confirma_senha" class="campo_senha">
                            <input type="password" name="confirma_senha" id="confirma_senha" placeholder="Confirme a Senha" required />
                            <img src="./assets/images/eye.svg" alt="" id="mostrar_confirma_senha" class="button_mostrar_senha">
                        </div>

                        <div id="erro_senha"></div>

                        <button id="cadastro_usuario" class="register-btn">Cadastrar</button>
                    </section>

                    <section id="option-2-content">
                        <div id="erro_cadastro_psi"></div>
                        <div>   
                            <input type="text" name="nome_completo_psi" id="nome_completo_psi" placeholder="Nome Completo" required />
                        </div>

                        <div>
                            <input type="email" name="email_psi" id="email_psi" placeholder="E-mail" required />
                            <div id="erro_email_psi"></div>
                        </div>

                        <div>
                            <input type="text" name="tel_psi" id="tel_psi" placeholder="Telefone" required />
                        </div>

                        <div class="select-estados-cidades">
                            <select id="estado" name="estado">
                                <option value="0" label="Estado"></option>
                                <?php include './inc/select_estados.inc' ?>
                            </select>
                            <select id="cidade" disabled>
                                <option value="" label="Cidade"></option>
                            </select>
                        </div>

                        <div>
                            <input type="text" name="registro" id="registro" placeholder="Registro" maxlength="11" required />
                            <div id="erro_registro"></div>
                        </div>
                        
                        <div id="campo_senha_psi" class="campo_senha">
                            <input type="password" name="senha_psi" id="senha_psi" placeholder="Senha" required />
                            <img src="./assets/images/eye.svg" alt="" id="mostrar_senha_psi" class="button_mostrar_senha">
                        </div>

                        <div id="campo_confirma_senha_psi" class="campo_senha">
                            <input type="password" name="confirma_senha_psi" id="confirma_senha_psi" placeholder="Confirme a Senha" required />
                            <img src="./assets/images/eye.svg" alt="" id="mostrar_confirma_senha_psi" class="button_mostrar_senha">
                        </div>

                        <div id="erro_senha_psi"></div>

                        <button id="cadastro_usuario_psi" class="register-btn">Cadastrar</button>
                    </section>

                </div>
            </section>
        </div>
    </main>

    <?php include './inc/footer.inc' ?>

    <script src="./assets/libs/sweetalert2.all.min.js"></script>
    <script src="./assets/libs/jquery.mask.min.js"></script>
    <script src="./js/cadastro.js"></script>
    <script src="./js/select_estados.js"></script>
</body>
</html>