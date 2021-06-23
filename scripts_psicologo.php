<script>
$(function(){
    /* $('.salvar').click(function(){
        p = {
            nome:$("#nome_completo_modal").val(),
            nome_usuario:$("#nome_usuario_modal").val(),
            email:$("#email_modal").val()
        };    

        console.log(p);
        
        $.post("atualizar.php",p,function(r){
            console.log(`R: ${r}`);
            $("#msg").removeClass("erro");
            $("#msg").removeClass("sucesso");

            limparMensagensErro();

            if(r == 0){
                $("#msg").addClass("sucesso");
                $("#msg").html("Dados alterados com sucesso.");
                $(".close").click();
                atualizarDados(p.email);
            }
            else if(r == 1){
                mensagemErroEmail();
                $(".close").click();
                define_alterar_remover();
            }
            else if(r == 2){
                mensagemErroNomeUsuario();
                $(".close").click();
                define_alterar_remover();
            }
            else if(r == 3){
                mensagemErroEmail();
                mensagemErroNomeUsuario();
                $(".close").click();
                define_alterar_remover();
            }
        });
    }); */

    define_alterar_remover();

    function define_alterar_remover(){ 
        $(".alterar").click(function(){
            i = $(this).val();
            permissao = $('#permissao').val();
            if(permissao == 1){
                $("#nome_completo_modal").attr("disabled", "disabled");
                $("#crp_modal").attr("disabled", "disabled");
                $("#email_modal").attr("disabled", "disabled");
                $("#estado_modal").attr("disabled", "disabled");
                $("#cidade_modal").attr("disabled", "disabled");
            }
            $.get("seleciona.php?email="+i+"&identificador=2",function(r){
                u = r[0];
                console.log(r); 
                $("#nome_completo_modal").val(u.nome);
                $("#crp_modal").val(u.crp);
                $("#email_modal").val(u.email);
                var texto_estado = `<option>${u.uf}</option>`;
                $("#estado_modal").html(texto_estado);
                var texto_cidade = `<option>${u.cidade}</option>`;
                $("#cidade_modal").html(texto_cidade);
            });
        });

        /* $(".remover").click(function(){
            permissao = $("#permissao").val();
            i = $("#user-delete").val();
            c = "email";
            t = "usuario";
            p = {tabela:t,email:i,coluna:c}
            $.post("remover.php",p,function(r){
                if(permissao == 1){
                    $("#msg").removeClass("error");
                    $("#msg").removeClass("sucess");
                    $('.modal').modal('hide'); 
                    if(r=='1'){   
                        $("#msg").addClass("sucess");             
                        $("#msg").html("Usuário removido com sucesso");
                        $("button[value='"+ i +"']").closest(".data-user-details-adm").remove();

                    }
                    else{
                        $("#msg").addClass("error");            
                        $("#msg").html("Não foi possível remover o usuário");
                    }
                }
                else{
                    location.href="index.php";
                }
                    
            });
        }); */
    }

    /* function atualizarDados(novo_email){
        $.get("seleciona.php?email="+novo_email,function(d){
            t = '';
            $.each(d,function(i,u){
                console.log(`Nome ${u.nome}`);
                console.log(`Nome ${u.nome_usuario}`);
                console.log(`Nome ${u.email}`);
                trocarCampos(u.nome, u.nome_usuario, u.email);
            });
        })    
    } */

    /* function trocarCampos(nome, nome_usuario, email){
        $("#nome-user").html(nome);
        $("#nome-usuario-user").html(nome_usuario);
        $("#email-user").html(email);
    } */

    /* function limparMensagensErro(){        
        $("#erro_email").removeClass("erro");
        $("#erro_email").html("");

        $("#erro_nome").removeClass("erro");
        $("#erro_nome").html("");

        $("#msg").html("");
    }

    function mensagemErroEmail(){
        $("#erro_email").addClass("erro");
        $("#erro_email").html("E-mail já cadastrado");
    }

    function mensagemErroNomeUsuario(){
        $("#erro_nome").addClass("erro");
        $("#erro_nome").html("Nome de Usuário já existe");
    } */
});
</script>