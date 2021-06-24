<div class="modal fade " id="alterarDadosPsicologo" tabindex="-1" role="dialog" aria-labelledby="important-msg-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Alterar Dados</h4>
        </div>
        <div class="modal-body modal-form">
            <input type="text" name="nome_completo_modal" id="nome_completo_modal" placeholder="Nome Completo" />
            <input type="text" name="email_modal" id="email_modal" placeholder="E-mail" />
            <input type="text" name="registro_modal" id="registro_modal" placeholder="Registro" />
            <div class="select-estados-cidades">
                <select id="estado_modal" name="estado">
                    <option value="0" label="Estado"></option>
                    <?php include './inc/select_estados.inc' ?>
                </select>
                <select id="cidade_modal" disabled>
                    <option value="" label="Cidade"></option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="data-user-action-cancel" data-dismiss="modal">Cancelar</button>
            <?php
                if($_SESSION["permissao"] != 1){
                    echo '<button class="data-user-action-save salvar">Salvar</button>';
                }   
                else{
                    if($_SESSION["situacao"] == 1){
                        echo '
                            <button class="data-user-adm reprovar" id="psicologo-reprovar" value="" data-toggle="modal">Reprovar</button>
                            <button class="data-user-adm aprovar" value="" id="psicologo-aprovar" data-toggle="modal">Aprovar</button>
                        ';
                        $_SESSION["situacao"] = 2;
                    }
                }
            ?>
        </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $("#registro_modal").keyup(function() {
            $("#registro_modal").val(this.value.match(/[0-9]*/));
        });
    })
  
</script>