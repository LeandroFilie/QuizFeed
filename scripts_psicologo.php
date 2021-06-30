<script>
$(function(){       
    $('.salvar').click(function(){
        p = {
            nome:$("#nome_completo_modal").val(),
            email:$("#email_modal").val(),
            registro:$("#registro_modal").val(),
            cidade:$("#cidade_modal").val()
        };    
        $.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+$("#estado_modal").val(),function(f){
            p.uf = f.sigla;
            enviarDados(p);
        });
        
    });

    define_alterar_remover();

    $(".reprovar").click(function(){
        
        $('#alterarDadosPsicologo').hide();
        var email = $(this).val();

        r = {
            "email":email,
            "situacao":3
        };
        $.post("atualizar_psicologo.php",r,function(r){
            $("#msg").removeClass("erro");
            $("#msg").removeClass("sucesso");

            if(r==0){
                Swal.fire({
                    title: 'Pronto',
                    text: "Psicólogo reprovado com sucesso",
                    icon: 'success',
                    confirmButtonColor: '#ed7201',
                    backdrop: false,
                }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
                })
            }
            else{
                $("#msg").addClass("erro");
                $('#msg').html('Falha ao reprovar pscicólogo.');
            }
        })
    })

    $(".aprovar").click(function(){
        $('#alterarDadosPsicologo').hide();
        
        var email = $(this).val();
        r = {
            "email":email,
            "situacao":2
        };

        $.post("atualizar_psicologo.php",r,function(r){
            $("#msg").removeClass("erro");
            $("#msg").removeClass("sucesso");
            if(r==0){
                Swal.fire({
                    title: 'Pronto',
                    text: "Psicólogo aprovado com sucesso",
                    icon: 'success',
                    confirmButtonColor: '#002539',
                    backdrop: false,
                }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
                }) 
                
            }
            else{
                $("#msg").addClass("erro");
                $('#msg').html('Falha ao aprovar psicólogo.');
            }
        }) 
    })
    

    

    function define_alterar_remover(){ 

        $(".alterar").click(function(){

            i = $(this).val();
            permissao = $('#permissao').val();

            if(permissao != 3){
                $("#nome_completo_modal").attr("disabled", "disabled");
                $("#registro_modal").attr("disabled", "disabled");
                $("#email_modal").attr("disabled", "disabled");
                $("#estado_modal").attr("disabled", "disabled");
                $("#cidade_modal").attr("disabled", "disabled");
            }
        
            $.get("seleciona.php?email="+i+"&identificador=2",function(r){
                u = r[0];
                $("#nome_completo_modal").val(u.nome);
                $("#registro_modal").val(u.registro);
                $("#email_modal").val(u.email);

                $.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+u.uf,function(f){
                    jQuery(`option[value='${f.id}']`).attr('selected', 'selected');
                });
                console.log(u.uf)
                $.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+u.uf+'/municipios',function(c){
                    t = "";
                    $.each(c,function(i,v){
                        t += `<option value="${v.nome}" `;
                        if(v.nome == u.cidade){
                            t += 'selected';
                        }
                        t += `>${v.nome}</option>`
                    })
                    $('#cidade_modal').html(t);
                })
                
                $('#psicologo-aprovar').val(u.email);
                $('#psicologo-reprovar').val(u.email);
                
                if(permissao == 3){
                    if(u.situacao == 2){
                        $("#registro_modal").attr("disabled", "disabled"); 
                    }
                }
                if(permissao == 1){
                    t='';
                    if(u.situacao == 2){
                        $('#buttonsSituacao1').hide();
                    }
                    else{
                        $('#buttonsSituacao1').show();
                    }
                }
            });
        });

        $(".remover").click(function(){
            permissao = $("#permissao").val();
            i = $(".delete").val();
            c = "email";
            t = "usuario";
            p = {tabela:t,email:i,coluna:c}
            $.post("remover.php",p,function(r){
                if(permissao == 1){
                    $("#msg").removeClass("erro");
                    $("#msg").removeClass("sucesso");
                    $('.modal').modal('hide'); 
                    if(r=='1'){   
                        $("#msg").addClass("sucesso");             
                        $("#msg").html("Usuário removido com sucesso");
                        $("button[value='"+ i +"']").closest(".data-user-details-adm").remove();
                    }
                    else{
                        $("#msg").addClass("erro");            
                        $("#msg").html("Não foi possível remover o usuário");
                    }
                }                    
            });
        }); 
    }

    function enviarDados(dados){
        $.post("atualizar_psicologo.php",dados,function(r){
            console.log(`R: ${r}`);
            $("#msg").removeClass("erro");
            $("#msg").removeClass("sucesso");

            limparMensagensErro();

            if(r == 0){
                $("#msg").addClass("sucesso");
                $("#msg").html("Dados alterados com sucesso.");
                $(".close").click();
                atualizarDados(dados.email);
            }
            else if(r == 1){
                mensagemErroEmail();
                $(".close").click();
                define_alterar_remover();
            }
            else if(r == 2){
                mensagemErroRegistro();
                $(".close").click();
                define_alterar_remover();
            }
            else if(r == 3){
                mensagemErroEmail();
                mensagemErroRegistro();
                $(".close").click();
                define_alterar_remover();
            }
        });
    }
    function atualizarDados(novo_email){
        $.get("seleciona.php?email="+novo_email+"&identificador=2",function(d){
            t = '';
            $.each(d,function(i,u){
                
                trocarCampos(u.nome, u.email, u.registro, u.uf, u.cidade);
            });
        });    
    }

    function trocarCampos(nome, email, registro, uf, cidade){
        $("#nome-psico").html(nome);
        $("#email-psico").html(email);
        $("#registro-psico").html(registro);
        $('#local-psico').html(`${cidade} - ${uf}`);
    }

    function limparMensagensErro(){        
        $("#erro_email").removeClass("erro");
        $("#erro_email").html("");

        $("#erro_registro").removeClass("erro");
        $("#erro_registro").html("");

        $("#msg").html("");
    }

    function mensagemErroEmail(){
        $("#erro_email").addClass("erro");
        $("#erro_email").html("E-mail já cadastrado");
    }

    function mensagemErroRegistro(){
        $("#erro_registro").addClass("erro");
        $("#erro_registro").html("CFP já etsa vinculado a uma conta.");
    }
});
</script>