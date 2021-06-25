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
});
</script>