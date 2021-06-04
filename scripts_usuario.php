<script>
$(function(){
    function define_alterar_remover(){ 
        /* $(".alterar").click(function(){
            i = $(this).val();
            $("#id_especie_oculto").val(i);
            $.get("seleciona.php?cod=1&id="+i,function(r){
                e = r[0];
                $("#nome_modal").val(e.nome);
            });
        }); */

        $(".remover").click(function(){
            permissao = $("#permissao").val();
            console.log(`Permissao: ${permissao}`);
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
});
</script>