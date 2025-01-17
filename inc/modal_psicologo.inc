<div class="modal fade " id="alterarDadosPsicologo" tabindex="-1" role="dialog" aria-labelledby="important-msg-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">
                <?php
                    if($_SESSION["permissao"] == 3){
                        echo 'Alterar Dados';
                    }   
                    else{
                        echo 'Dados do Psicólogo';
                    }
                ?>
            
            </h4>
        </div>
        <div class="modal-body modal-form">
            <input type="text" name="nome_completo_modal" id="nome_completo_modal" placeholder="Nome Completo" />
            <input type="text" name="email_modal" id="email_modal" placeholder="E-mail" />
            <input type="text" name="tel_modal" id="tel_modal" placeholder="Telefone" />
            <input type="text" name="registro_modal" id="registro_modal" placeholder="Registro" maxlength="11" />
            <div class="select-estados-cidades">
                <select id="estado_modal" name="estado">
                    <option value="0" label="Estado"></option>
                    <?php include './inc/select_estados.inc' ?>
                </select>
                <select id="cidade_modal">
                    <option value="" label="Cidade"></option>
                </select>
            </div>

            <?php
                if($_SESSION["permissao"] == 3){
                    echo '
                        <label class="label-alterar-senha">
                            <input type="checkbox" id="alterarSenha" class="check-alterar-senha"/>
                            Mudar Senha
                        </label>

                        <div class="alterar-senha" id="camposAlterarSenha">
                            <div class="campo-senha">
                                <input type="password" name="senha_atual_modal" id="senha_atual_modal" placeholder="Senha Atual" />
                                <img src="./assets/images/eye.svg" alt="" id="mostrar_senha_atual" class="button_mostrar_senha">
                            </div>
                            <div class="campo-senha">
                                <input type="password" name="senha_nova_modal" id="senha_nova_modal" placeholder="Nova Senha" disabled/>
                                <img src="./assets/images/eye.svg" alt="" id="mostrar_senha_nova" class="button_mostrar_senha">
                            </div>
                            <div class="campo-senha">
                                <input type="password" name="confere_senha_modal" id="confere_senha_modal" placeholder="Confirme a Senha" disabled/>
                                <img src="./assets/images/eye.svg" alt="" id="mostrar_senha_confere" class="button_mostrar_senha">
                            </div>
                            <div id="erroConfereSenha"></div>
                        </div>
                    ';
                }
            ?>

        </div>

        <div class="modal-footer">
            <button class="data-user-action-cancel" data-dismiss="modal">Cancelar</button>
            <?php
                if($_SESSION["permissao"] == 3){
                    echo '<button class="data-user-action-save salvar">Salvar</button>';
                }   
                else if($_SESSION["permissao"] == 1){
                    echo '<div id="buttonsSituacao1">
                        <button class="data-user-adm reprovar" id="psicologo-reprovar" value="" data-toggle="modal">Reprovar</button>
                        <button class="data-user-adm aprovar" value="" id="psicologo-aprovar" data-toggle="modal">Aprovar</button>
                    </div>';
                }
            ?>
        </div>
        </div>
    </div>
</div>

<div class="modal fade " id="excluirConta" tabindex="-1" role="dialog" aria-labelledby="important-msg-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Excluir Conta</h4>
        </div>
        <div class="modal-body">
            <p class="modal-text">Tem certeza que deseja excluir a conta?</p>
        </div>
        <div class="modal-footer">
            <button class="data-user-action-cancel" data-dismiss="modal">Não</button>
            <button class="data-user-action-save remover">Sim</button>
        </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $("#registro_modal").keyup(function() {
            $("#registro_modal").val(this.value.match(/[0-9]*/));
        });

        $('#estado_modal').change(function(){
        var uf = $(this).val();
        if(uf == '0'){
            $('#cidade_modal').attr("disabled", "disabled");
            t = '<option value="" label="Cidade"></option>';
            $('#cidade_modal').html(t);
        }
        else{
            $('#cidade_modal').removeAttr("disabled");
            $.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+uf+'/municipios',function(c){
                t = "";
                $.each(c,function(i,v){
                    t += `<option value="${v.nome}">${v.nome}</option>`;
                })
                $('#cidade_modal').html(t);
            })
        }
    });

    maskTel();

    function maskTel(){
        $('#tel_modal').mask('(00) 0000-00009');

        $('#tel_modal').keyup(function() {
            if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                $('#tel_modal').mask('(00) 00000-0009');
            } else {
                $('#tel_modal').mask('(00) 0000-00009');
            }
        });
    }
            
        
    })
  
</script>