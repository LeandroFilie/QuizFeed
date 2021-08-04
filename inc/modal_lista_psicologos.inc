<div class="modal fade " id="listaPsicologos" tabindex="-1" role="dialog" aria-labelledby="important-msg-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h2 class="modal-title">Psicólogos</h2>
            </div>
            <div class="modal-body">
                <div class="filtro">
                    <h3>Encontre psicólogos na sua cidade!</h3>
                    <div class="select-estados-cidades">
                        <select id="estado_filtro" name="estado_filtro">
                            <option value="" label="Estado"></option>
                            <?php include './inc/select_estados.inc'; ?>
                        </select>
                        <input type="text" name="cidade" id="cidade" placeholder="Cidade" />
                    </div>
                    <button id="filtrarPsicologos">Pesquisar</button>
                </div>
                <?php

                    $selectSituacao2 = 'SELECT nome, email_usuario, uf, cidade, telefone FROM usuario_psicologo INNER JOIN usuario ON usuario.email = usuario_psicologo.email_usuario WHERE usuario_psicologo.situacao = "2"';
                    
                    $resultadoSituacao2 = mysqli_query($conexao,$selectSituacao2);

                    echo '<div id="psicologos">';
                    $i = 0;     
                    while($linha = mysqli_fetch_assoc($resultadoSituacao2)){
                        echo '
                            <span class="accordion">'.$linha["nome"].'</span>
                            <div class="dados">
                                <p>Email: '.$linha["email_usuario"].'</p>
                                <p>Telefone: '.$linha["telefone"].'</p>
                                <p>'.$linha["cidade"].' - '.$linha["uf"].'</p>
                            </div>
                        ';
                        $i++;
                    }
                    if($i == 0){
                    echo '<h2 id="emptySituacao1">Não há psicólogos cadastrados</h2>';
                    }

                    echo '</div>';
                ?>
            
            </div>
        </div>
    </div>
</div>