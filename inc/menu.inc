<?php
    echo '
        <header class="header">
            <nav>
                <a href="home.php"><img src="./assets/logo.svg" alt="logo" class="logo"></a>
                <button id="js-open-menu" class="menu-button">
                    <i class="menu-icon"></i>
                </button>
                <ul class="menu">
                <li><a href="home.php">Home</a></li>
                ';
                if($_SESSION["permissao"] == 2){
                    echo '<li><a href="dados_usuarios.php">Meus Dados</a></li>';
                    echo '<li><a href="rede.php">Rede</a></li>';
                }
                if($_SESSION["permissao"] == 3){
                    if($_SESSION["situacao"] != 1)
                    echo '<li><a href="dados_psicologos.php">Meus Dados</a></li>';
                }
                echo '
                    
                    <li><a href="logout.php">Sair</a></li>
                </ul>
            </nav>
        </header>
    ';
?>