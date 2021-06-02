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
    <header>
        <nav>
            <div><a href="index.html"><img src="./assets/logo.svg" alt="logo" class="logo"></a></div>
            <button id="js-open-menu" class="menu-button">
                <i class="menu-icon"></i>
            </button>
            <ul class="menu">
                <li><a href="dados.html">Meus Dados</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="section-title">
            <h1 class="title">Sejá bem-vindo, <?php echo $_SESSION["nome_usuario"]; ?></h1>
        </div>
        <div class="section-cta">
            <a href="teste.html"><button>Iniciar Teste</button></a>
        </div>
        <div class="section-description">
            <div class="description-title">
                <i data-feather="help-circle"></i>
                <p>
                    Como Funciona o Teste
                </p>
            </div>
            <p class="description-content">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
            </p>
        </div>
    </main>

    <footer>
        <span> Site desenvolvido por: Carol, Julia Costa e Leandro</span>
    </footer>

    <script>
        feather.replace();
    </script>
</body>
</html>