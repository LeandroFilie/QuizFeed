<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include './inc/head.inc'; ?>
    
    <link rel="stylesheet" href="./style/areas.css">
    <title>Explicação das Áreas | TesteFeed</title>
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
        <div class="areas">
            <?php
			include "inc/conexao.php";
				$select = 'SELECT *FROM area';
				$resultado = mysqli_query($conexao,$select);
                while($linha=mysqli_fetch_assoc($resultado)){
					$selectCursos = 'SELECT * FROM curso WHERE cod_area = '.$linha["id_area"].'';
					$resultadoCursos = mysqli_query($conexao,$selectCursos);
                    echo '
                        <div class="card">
                            <div class="card-content">
                                <h5>'.$linha["nome"].'</h5>
                                <p>
                                    '.$linha["descricao"].'
                                </p>
                                <div class="cursos">
								<span class="separador"></span>';
								while ($linhaCursos=mysqli_fetch_assoc($resultadoCursos)){
									echo '<p>'.$linhaCursos["nome"].'</p>
                                    <span class="separador"></span>';
								}
								echo '
                                </div>
                            </div>
                        </div>
                    
                    ';
                }
            ?>
            </div>

    </main>

    <?php include './inc/footer.inc'; ?>

</body>
</html>