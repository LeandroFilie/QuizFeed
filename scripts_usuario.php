<script>
$(function(){
    function define_alterar_remover(){ 
        $(".alterar").click(function(){
            i = $(this).val();
            permissao = $('#permissao').val();
            if(permissao == 1){
                $("#nome_completo_modal").attr("disabled", "disabled");
                $("#nome_usuario_modal").attr("disabled", "disabled");
                $("#email_modal").attr("disabled", "disabled");
            }
            $.get("seleciona.php?id="+i,function(r){
                u = r[0];
                $("#nome_completo_modal").val(u.nome);
                $("#nome_usuario_modal").val(u.nome_usuario);
                $("#email_modal").val(u.email);
            });
        });

        $(".remover").click(function(){
            permissao = $("#permissao").val();
            i = $("#user-delete").val();
            c = "id_usuario";
            t = "usuario";
            p = {tabela:t,id:i,coluna:c}
            console.log(p);
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
                    location.href="index.html";
                }
                    
            });
        });
    }

    define_alterar_remover();

    $('.salvar').click(function(){
        p = {
            nome:$("#nome_completo_modal").val(),
            nome_usuario:$("#nome_usuario_modal").val(),
            email:$("#email_modal").val(),
            id_usuario: $(".alterar").val()
        };    
        
        $.post("atualizar.php",p,function(r){
            console.log(r);
            $("#msg").removeClass("erro");
            $("#msg").removeClass("sucesso");
            if(r=='1'){
                $("#msg").addClass("sucesso");
                $("#msg").html("Dados alterados com sucesso.");
                $(".close").click();
                atualizarDados();            
            }else{
                $("#msg").addClass("erro"); 
                $("#msg").html("Falha ao atualizar os dados.");
            }
        });
    });

    function atualizarDados(){
        id = $(".alterar").val();
        $.get("seleciona.php?id="+id,function(d){
            t = '';
            $.each(d,function(i,u){
                t += '<div class="data-user-details">';
                t +=     '<div class="data-user-details-items">';
                t +=         '<h3>Nome</h3>';
                t +=         `<p>${u.nome} </p>`;
                t +=     '</div>';

                t +=     '<div class="data-user-details-items">';
                t +=         '<h3>Nome de Usuário</h3>';
                t +=         `<p>${u.nome_usuario} </p>`;
                t +=     '</div>';

                t +=     '<div class="data-user-details-items">';
                t +=         '<h3>Endereço de E-mail</h3>';
                t +=         `<p>${u.email} </p>`;
                t +=     '</div>';
                t += '</div>';
            });
            $(".data-user-details").html(t);
        })  
    }

});
</script>