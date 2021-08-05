<div class="modal fade " id="trocarArea" tabindex="-1" role="dialog" aria-labelledby="important-msg-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h2 class="modal-title">Mudar de Área</h2>
            </div>
            <div class="modal-body">
                <div id="">
                    <h3>É normal ter duvidas!</h3>
                    <p>Já que decidiu mudar de área, me conta, qual tem em mente?</p>
                    <select id="nome_rede">
                        <option value="">Selecione uma Área</option>
                        <?php
                        $selectAreas = 'SELECT * FROM area';
                        $resultadoAreas = mysqli_query($conexao, $selectAreas);
                        while($linha = mysqli_fetch_assoc($resultadoAreas)){
                            echo '
                                <option value="'.$linha["id_area"].'">'.$linha["nome"].'</option>
                            ';
                        }
                        ?> 
                    </select>

                    <span class="erro_entrar_rede"></span>
                    <button class="trocar-rede">Entrar na Rede</button>

                    <span class="obs">*Se quiser saber mais sobre cada area <a href="areas.php" target="_blank">clique aqui</a>!</span> 
                    <span class="separator">ou</span>
                    <p>Realize uma <a href="dados_psicologos.php" target="_blank">orientação vocacional</a> ou refaça os testes:</p>
                    <ul class="lista-testes">
                        <li class="link"><a href="https://www.guiadacarreira.com.br/teste-vocacional/" target="_blank">Guia da Carreira</a></li>
                        <li class="link"><a href="https://www.vix.com/pt/comportamento/546867/qual-profissao-mais-combina-com-voce-este-teste-vocacional-te-ajuda-a-descobrir" target="_blank">Vix</a></li>
                        <li class="link"><a href="https://querobolsa.com.br/teste-vocacional-gratis" target="_blank">Quero Bolsa</a></li>
                    </ul>
                </div>
            </div>
    </div>
</div>