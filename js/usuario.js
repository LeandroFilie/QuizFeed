function removerUser(email){
  $(".remover").click(function(){
    c = "email";
    t = "usuario";
    p = {tabela:t,email:email,coluna:c};

    $.post('seleciona.php',{identificador: '8'},function(permissao){
      $.post("remover.php",p,function(r){
        if(permissao[0] == 1){
            $("#msg").removeClass("erro_adm");
            $("#msg").removeClass("sucesso_adm");
            $('.modal').modal('hide'); 

            if(r=='1'){   
                $("#msg").addClass("sucesso");     
                $("#msg").css('margin-top', '24px');        
                $("#msg").css('margin-bottom  ', '24px');        
                $("#msg").html("Usuário removido com sucesso");
                $("button[value='"+ email +"']").closest(".data-user-details-adm").remove();
                qtdUsers = Number($("#qtdUser").html());
                $("#qtdUser").text(--qtdUsers);
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
  })
}

$(document).ready(function(){
  // ======================== DECLARAÇÃO DE FUNÇÕES =========================
  function verificaSenhaAtual(senhaAtual){
    $('#senha_atual_modal').keyup(function(){
      novaSenha = $.md5($(this).val());
      
      if(novaSenha === senhaAtual){
        $('#senha_atual_modal').removeClass('erro-input');

        $('#senha_nova_modal').removeAttr('disabled');
        $('#confere_senha_modal').removeAttr('disabled');
      }
      else{
        $('#senha_atual_modal').addClass('erro-input');
        $('#senha_nova_modal').attr('disabled','disabled');
        $('#confere_senha_modal').attr('disabled','disabled');
        $('#senha_nova_modal').val('');
        $('#confere_senha_modal').val('');
      }
    })
  }
  
  function confereSenha(senha, confirmaSenha){
    return senha === confirmaSenha ? true : false;
  }

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

        $.post('seleciona.php',{identificador: '8'},function(permissao){
          if(permissao[0] == 1){
            $("#nome_completo_modal").attr("disabled", "disabled");
            $("#nome_usuario_modal").attr("disabled", "disabled");
            $("#email_modal").attr("disabled", "disabled");
          }

          dados = {
            email: i,
            identificador: '1'
          }

          
          $.post("seleciona.php",dados,function(r){

              u = r[0];
              $("#nome_completo_modal").val(u.nome);
              $("#nome_usuario_modal").val(u.nome_usuario);
              $("#email_modal").val(u.email);
          });

        })

    });
  }

  function atualizarDados(novo_email){
    dados = {
      email: novo_email,
      identificador: '1'
    }
    $.post("seleciona.php",dados,function(d){
      t = '';
      $.each(d,function(i,u){
          trocarCampos(u.nome, u.nome_usuario, u.email);
      });
    })    
  }

  $('#alterarSenha').change(function(){
    console.log($(this).val());

    console.log('foi');
  })

  function enviarDados(dados){
    $.post("atualizar_usuario.php",dados,function(r){
      $("#msg").removeClass("erro");
      $("#msg").removeClass("sucesso");

      if($('#alterarSenha:checked').val() === 'on'){
        $('#alterarSenha:checked').prop('checked',false)
        $('#senha_atual_modal').val('');
        $('#senha_nova_modal').val('');
        $('#confere_senha_modal').val('');
        $('#camposAlterarSenha').css('display','none');
      }

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
  }

  function trocarCampos(nome, nome_usuario, email){
    $("#nome-user").html(nome);
    $("#nome-usuario-user").html(nome_usuario);
    $("#email-user").html(email);
    $(".alterar").val(email);
    $(".delete").attr('onclick', `removerUser('${email}')`);
  }

  function atualizarRede(nova_area){
    console.log(nova_area);
    dados = {
      id: nova_area,
      identificador: '7'
    }
    
    $.post("seleciona.php",dados,function(d){
      $("#area-user").html(d.nome);

    })    
  }

  function confereImagem(inputAvatar){
    var avatar = inputAvatar.files[0];
    var tipoImagem = avatar.type;
    var sizeImagem = avatar.size;
    var tiposPermitidos = ['image/png', 'image/jpeg'];
    
    if(tiposPermitidos.includes(tipoImagem)){
      if(sizeImagem < 2097152){
        $('#formAvatar').submit();
      }
      else{
        alert('O tamanho máximo para sua foto de perfil é de 5MB')
      }
    }
    else{
      alert('Formato de arquivo inválido')
    }
  }

  // =========================== SCRIPTS ===============================

  define_alterar_remover();

  $('.salvar').click(function(){

    p = {
      nome:$("#nome_completo_modal").val(),
      nome_usuario:$("#nome_usuario_modal").val(),
      email:$("#email_modal").val()
    }; 

    senhaNova = $('#senha_nova_modal').val();
    senhaConfere = $('#confere_senha_modal').val();

    if($('#alterarSenha:checked').val() === 'on'){
      $('#erroConfereSenha').text('');
      $('#erroConfereSenha').removeClass('erro');

      if(senhaNova != '' && senhaConfere != ''){
        if(!confereSenha(senhaNova, senhaConfere)){
          $('#erroConfereSenha').text('As senhas são diferentes');
          $('#erroConfereSenha').addClass('erro');
        }
        else{
          p.senha = $.md5(senhaNova);
          enviarDados(p);
        }
      }
      else{
        $('#erroConfereSenha').text('Preencha os campos restantes');
        $('#erroConfereSenha').addClass('erro');
      }

    }
    else{
      $('#erroConfereSenha').text('');
      $('#erroConfereSenha').removeClass('erro');
      enviarDados(p);
    }
  });

   $('.trocar-rede').click(function(){
    area = $("#nome_rede").val();
    if(area != ''){
      p = {
        area,
        identificador: '2'
      };

      $.post("gerenciamento_rede.php",p,function(r){
        $("#msg").removeClass("erro");
        $("#msg").removeClass("sucesso");

        if(r == 0){
          $("#msg").addClass("sucesso");
          $("#msg").html("Sua área da rede foi alterada!");
          $(".close").click();
          atualizarRede(p.area);
        }
      });

      $("#nome_rede").val('');
    }

  });

  $('#editarAvatar').change(function(){
    confereImagem(this);
  })

  $('#alterarSenha').change(function(){
    elemento = $('#alterarSenha:checked').val();

    if(elemento === 'on'){
      $('#camposAlterarSenha').css('display','flex');
      $('#senha_atual_modal').focus();

      $.post('seleciona.php',{identificador: '9'},function(r){
        verificaSenhaAtual(r.senha);
      })
    }
    else{
      $('#camposAlterarSenha').css('display','none');

      $('#senha_atual_modal').val('');
      $('#senha_nova_modal').val('');
      $('#confere_senha_modal').val('');

      $('#senha_atual_modal').removeClass('erro-input');

      $('#senha_nova_modal').attr('disabled','disabled');
      $('#confere_senha_modal').attr('disabled','disabled');

      $('#erroConfereSenha').text('');
      $('#erroConfereSenha').removeClass('erro');
    }
  })

  // ========================= MOSTRAR/OCULTAR SENHA ===========================

  $('#mostrar_senha_atual').click(function(){
      if($('#senha_atual_modal').attr('type') == 'password'){
          $('#senha_atual_modal').attr('type', 'text');
          $('#mostrar_senha_atual').attr('src', './assets/images/eye-off.svg');
      }
      else{
          $('#senha_atual_modal').attr('type', 'password');
          $('#mostrar_senha_atual').attr('src', './assets/images/eye.svg');
      }
  });

  $('#mostrar_senha_nova').click(function(){
    if($('#senha_nova_modal').attr('type') == 'password'){
        $('#senha_nova_modal').attr('type', 'text');
        $('#mostrar_senha_nova').attr('src', './assets/images/eye-off.svg');
    }
    else{
        $('#senha_nova_modal').attr('type', 'password');
        $('#mostrar_senha_nova').attr('src', './assets/images/eye.svg');
    }
  });

  $('#mostrar_senha_confere').click(function(){
  if($('#confere_senha_modal').attr('type') == 'password'){
      $('#confere_senha_modal').attr('type', 'text');
      $('#mostrar_senha_confere').attr('src', './assets/images/eye-off.svg');
  }
  else{
      $('#confere_senha_modal').attr('type', 'password');
      $('#mostrar_senha_confere').attr('src', './assets/images/eye.svg');
  }
  });
});