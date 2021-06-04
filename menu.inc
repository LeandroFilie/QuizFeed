<?php
    echo '
        <header>
            <nav>
                <div><a href="index.html"><img src="./assets/logo.svg" alt="logo" class="logo"></a></div>
                <button id="js-open-menu" class="menu-button">
                    <i class="menu-icon"></i>
                </button>
                <ul class="menu">
                ';
                if($_SESSION["permissao"] == 2){
                    echo '<li><a href="lista_usuarios.php">Meus Dados</a></li>';
                }
                echo '
                    <li><a href="logout.php">Sair</a></li>
                </ul>
            </nav>
        </header>
    ';
?>