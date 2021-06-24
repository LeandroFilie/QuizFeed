<script>
$(function(){        
    define_alterar_remover();

    $(".reprovar").click(function(){
        var email = $(this).val();

        r = {
            "email":email,
            "situacao":3
        };

        $.post("atualizar_psicologo.php",r,function(r){
            $("#msg").removeClass("erro");
            $("#msg").removeClass("sucesso");
            if(r==0){
                atualizarListaSituacao1();
                atualizarListaSituacao2();
                $("#msg").addClass("sucesso");
                $('#msg').html('Psicólogo Reprovado com Sucesso.');

                $("button[value='"+ email +"']").closest(".data-user-details-adm").remove();

                

                $('.close').click();
            }
            else{
                $("#msg").addClass("erro");
                $('#msg').html('Falha ao reprovar pscicólogo.');
            }
        })
    })

    $(".aprovar").click(function(){
        var email = $(this).val();
        console.log('entrou aprovar');
        r = {
            "email":email,
            "situacao":2
        };

        $.post("atualizar_psicologo.php",r,function(r){
            $("#msg").removeClass("erro");
            $("#msg").removeClass("sucesso");
            if(r==0){
                atualizarListaSituacao1();
                atualizarListaSituacao2();
                $("#msg").addClass("sucesso");
                $('#msg').html('Psicólogo Aprovado com Sucesso.');

                $("button[value='"+ email +"']").closest(".data-user-details-adm").remove();

                $('#option-1-content').hide();
                $('#option-1').removeClass('active');

                $('#option-2-content').show();
                $('#option-2').toggleClass('active');

                $('.close').click();
                
            }
            else{
                $("#msg").addClass("erro");
                $('#msg').html('Falha ao aprovar pscicólogo.');
            }
        })
    })

    function define_alterar_remover(){ 

        $(".alterar").click(function(){

            console.log('alterar entrou');
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
                $("#nome_completo_modal").val(u.nome);
                $("#crp_modal").val(u.crp);
                $("#email_modal").val(u.email);

                var texto_estado = `<option>${u.uf}</option>`;
                $("#estado_modal").html(texto_estado);

                var texto_cidade = `<option>${u.cidade}</option>`;
                $("#cidade_modal").html(texto_cidade);

                $('#psicologo-aprovar').val(u.email);
                $('#psicologo-reprovar').val(u.email);
            });
        });

        /* $(".remover").click(function(){
            
        }); */
    }

    function atualizarListaSituacao1(){
        $.get("seleciona.php?identificador=2&situacao=1",function(d){
            var i = 0;
            t = '';
            $.each(d,function(i,u){
                console.log(`Nome ${u.nome}`);
                console.log(`Nome ${u.email}`);
                t += '<div class="data-user-details-adm">';
                t +=    '<div class="data-user-details-items-adm">';
                t +=        `<p>${u.nome} </p>`;
                t +=    '</div>';
                t +=    '<div class="data-user-details-items-adm">';
                t +=        `<button class="data-user-adm alterar" value="${u.email}" data-toggle="modal" data-target="#alterarDadosPsicologo">Ver Dados</button>`;
                t +=    '</div>';
                t +=   '</div>';
                i++;
            })
            if(i>0){
                $('#emptySituacao1').html('Não há pedidos pendentes');
            }
            
            $('#option-1-content').html(t);
        });
    }

    function atualizarListaSituacao2(){
        $.get("seleciona.php?identificador=2&situacao=2",function(d){
            var j = 0;
            t2 = '';
            $.each(d,function(i,u){
                console.log(`Nome ${u.nome}`);
                console.log(`Nome ${u.email}`);
                t2 += '<div class="data-user-details-adm">';
                t2 +=    '<div class="data-user-details-items-adm">';
                t2 +=        `<p>${u.nome} </p>`;
                t2 +=    '</div>';
                t2 +=    '<div class="data-user-details-items-adm">';
                t2 +=        `<button class="data-user-adm alterar" value="${u.email}" data-toggle="modal" data-target="#alterarDadosPsicologo">Ver Dados</button>`;
                t2+= `<button class="data-user-delete-adm" id="user-delete" value="${u.email}" data-toggle="modal" data-target="#excluirConta">Excluir Conta</button>`;
                t2 +=    '</div>';
                t2 +=   '</div>';
            })

            if(j>0){
                $('#emptySituacao2').html('Não há psicólogos cadastrados');
            }
            $('#option-2-content').html(t2);
        });
    }

    /* function atualizarDados(novo_email){
        $.get("seleciona.php?email="+novo_email,function(d){
            t = '';
            $.each(d,function(i,u){
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