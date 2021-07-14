function removerUser(email){
  console.log(email);
  $(".remover").click(function(){
    permissao = $("#permissao").val();
    c = "email";
    t = "usuario";
    p = {tabela:t,email:email,coluna:c};

    $.post("remover.php",p,function(r){
      if(permissao == 1){
          $("#msg").removeClass("erro");
          $("#msg").removeClass("sucesso");
          $('.modal').modal('hide'); 
          if(r=='1'){   
              $("#msg").addClass("sucesso");             
              $("#msg").html("Usuário removido com sucesso");
              $("button[value='"+ email +"']").closest(".data-user-details-adm").remove();

          }
          else{
              $("#msg").addClass("erro");            
              $("#msg").html("Não foi possível remover o usuário");
          }
      }
      else{
          location.href="index.php";
      }
        
    });
  })
}

$(document).ready(function(){
  // ======================== DECLARAÇÃO DE FUNÇÕES =========================
  function limparMensagensErro(){        
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
  }

  function define_alterar_remover(){ 
    $(".alterar").click(function(){
        i = $(this).val();
        permissao = $('#permissao').val();

        if(permissao == 1){
            $("#nome_completo_modal").attr("disabled", "disabled");
            $("#nome_usuario_modal").attr("disabled", "disabled");
            $("#email_modal").attr("disabled", "disabled");
        }
        $.get("seleciona.php?email="+i+"&identificador=1",function(r){
          console.log('foi');
            u = r[0];
            $("#nome_completo_modal").val(u.nome);
            $("#nome_usuario_modal").val(u.nome_usuario);
            $("#email_modal").val(u.email);
        });
    });
  }
  function atualizarDados(novo_email){
    $.get("seleciona.php?email="+novo_email+"&identificador=1",function(d){
      t = '';
      $.each(d,function(i,u){
          trocarCampos(u.nome, u.nome_usuario, u.email);
      });
    })    
  }

  function trocarCampos(nome, nome_usuario, email){
    $("#nome-user").html(nome);
    $("#nome-usuario-user").html(nome_usuario);
    $("#email-user").html(email);
    $(".alterar").val(email);
    $(".delete").attr('onclick', `removerUser('${email}')`);
  }

  // =========================== SCRIPTS ===============================

  define_alterar_remover();


  $('.salvar').click(function(){
    p = {
        nome:$("#nome_completo_modal").val(),
        nome_usuario:$("#nome_usuario_modal").val(),
        email:$("#email_modal").val()
    };    
      
    $.post("atualizar_usuario.php",p,function(r){
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
  });

});