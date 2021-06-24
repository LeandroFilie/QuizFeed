<script>
$(function(){        
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
                $('#msg').html('Falha ao aprovar pscicólogo.');
            }
        }) 
    })
    

    

    function define_alterar_remover(){ 

        $(".alterar").click(function(){

            i = $(this).val();
            permissao = $('#permissao').val();

            if(permissao == 1){
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

                var texto_estado = `<option>${u.uf}</option>`;
                $("#estado_modal").html(texto_estado);

                var texto_cidade = `<option>${u.cidade}</option>`;
                $("#cidade_modal").html(texto_cidade);
                
                $('#psicologo-aprovar').val(u.email);
                $('#psicologo-reprovar').val(u.email);

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

        /* $(".remover").click(function(){
            
        }); */
    }

    function atualizarLista(situacao){
        $.get("seleciona.php?identificador=2&situacao="+situacao,function(d){
            
            if(d != 0){
                t = '';
                $.each(d,function(i,u){
                    t += '<div class="data-user-details-adm">';
                    t +=    '<div class="data-user-details-items-adm">';
                    t +=        `<p>${u.nome} </p>`;
                    t +=    '</div>';
                    t +=    '<div class="data-user-details-items-adm">';
                    t +=        `<button class="data-user-adm alterar" value="${u.email}" data-toggle="modal" data-target="#alterarDadosPsicologo">Ver Dados</button>`;
                    if(situacao == 1){
                        t+=     `<button class="data-user-delete-adm" id="user-delete" value="${u.email}" data-toggle="modal" data-target="#excluirConta">Excluir Conta</button>`;
                    }
                    t +=    '</div>';
                    t +=   '</div>';
                })

                if(situacao == 1){
                    $('#option-1-content').html(t);
                }
                else{
                    $('#option-2-content').html(t);
                }
            }
            else{
                if(situacao == 1){
                    $('#emptySituacao1').html('Não há pedidos de aprovação');
                }
                else{
                    $('#emptySituacao2').html('Não há nenhum pscicólogo cadastrado');
                }
            }
        });
    }
});
</script>