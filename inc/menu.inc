<?php
    echo '
        <header>
            <nav>
                <a href="home.php"><img src="./assets/logo.svg" alt="logo" class="logo"></a>
                <button id="js-open-menu" class="menu-button">
                    <i class="menu-icon"></i>
                </button>
                <ul class="menu">
                ';
                if($_SESSION["permissao"] == 2){
                    echo '<li><a href="dados_usuarios.php">Meus Dados</a></li>';
                }
                echo '
                    <li><a href="logout.php">Sair</a></li>
                </ul>
            </nav>
        </header>
    ';
?>