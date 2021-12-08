function removerUser(email){
  $(".remover").click(function(){
    c = "email";
    t = "usuario";
    p = {tabela:t,email:email,coluna:c};

    $.post('seleciona.php',{identificador: '8'},function(permissao){
      
      $.post("remover.php",p,function(r){

        if(permissao[0] == 1){
          $("#msg").removeClass("erro");
          $("#msg").removeClass("sucesso");
          $('.modal').modal('hide'); 

          if(r=='1'){  
              Swal.fire({
                  title: 'Pronto',
                  text: "Psicólogo removido com sucesso",
                  icon: 'success',
                  confirmButtonColor: '#002539',
                  backdrop: true,
              }).then((result) => {
              if (result.isConfirmed) {
                  location.reload();
              }
              }) 
          }
          else{
              $("#msg").addClass("erro");            
              $("#msg").html("Não foi possível remover o usuário");
          }

        }
        else{
          location.href="index.php";
        }

      })

    })

  })
}

$(function(){   
  // ====================== DECLARAÇÃO DE FUNÇÕES =======================

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
    $("#erro_registro").html("CRP já está vinculado a uma conta.");
  }
  
  function define_alterar_remover(){ 
     $(".alterar").click(function(){
      i = $(this).val();

      $.post('seleciona.php',{identificador: '8'},function(permissao){
        
        if(permissao[0] != 3){
          $("#nome_completo_modal").attr("disabled", "disabled");
          $("#registro_modal").attr("disabled", "disabled");
          $("#tel_modal").attr("disabled", "disabled");
          $("#email_modal").attr("disabled", "disabled");
          $("#estado_modal").attr("disabled", "disabled");
          $("#cidade_modal").attr("disabled", "disabled");
        }

        dados = {
          'email': i,
          'identificador': '2'
        }
    
        $.post("seleciona.php",dados,function(r){
          u = r[0];
          $("#nome_completo_modal").val(u.nome);
          $("#registro_modal").val(u.registro);
          $("#tel_modal").val(u.telefone);
          $("#email_modal").val(u.email);
          jQuery(`#estado_modal option[value='${u.uf}']`).attr('selected', 'selected');
        
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
          
          if(permissao[0] == 3){
            if(u.situacao == 2){
                $("#registro_modal").attr("disabled", "disabled"); 
            }
          }
          if(permissao[0] == 1){
            if(u.situacao == 2){
                $('#buttonsSituacao1').hide();
            }
            else{
                $('#buttonsSituacao1').show();
            }
          }
        });

      });

    });
  }

  function enviarDados(dados){
    $.post("atualizar_psicologo.php",dados,function(r){
      
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
    dados = {
      email: novo_email,
      identificador: '2'
    }

    $.post("seleciona.php",dados,function(d){
      t = '';
      $.each(d,function(i,u){
          trocarCampos(u.nome, u.email, u.registro, u.uf, u.cidade, u.telefone);
      });
    });    
  }

  function trocarCampos(nome, email, registro, uf, cidade, telefone){
    $("#nome-psico").html(nome);
    $("#email-psico").html(email);
    $("#tel-psico").html(telefone);
    $("#registro-psico").html(registro);
    $('#local-psico').html(`${cidade} - ${uf}`);
    $(".alterar").val(email);
    $(".delete").attr('onclick', `removerUser('${email}')`);
  }


  // ====================== SCRIPTS =====================================

  define_alterar_remover();

  $('.salvar').click(function(){
    p = {
        nome:$("#nome_completo_modal").val(),
        email:$("#email_modal").val(),
        tel:$("#tel_modal").val(),
        registro:$("#registro_modal").val(),
        uf:$("#estado_modal").val(),
        cidade:$("#cidade_modal").val(),
        identificador:2
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


  $(".reprovar").click(function(){
    $('#alterarDadosPsicologo').hide();
    var email = $(this).val();

    r = {
        "email":email,
        "situacao":3,
        "identificador": 1
    };
    $.post("atualizar_psicologo.php",r,function(r){
        $("#msg").removeClass("erro");
        $("#msg").removeClass("sucesso");

        if(r==0){
            Swal.fire({
                title: 'Pronto',
                text: "Psicólogo reprovado com sucesso",
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
            $('.close').click();
            $("#msg").addClass("erro");
            $('#msg').html('Falha ao reprovar psicólogo.');
        }
    })
  })

  $(".aprovar").click(function(){
    $('#alterarDadosPsicologo').hide();
    
    var email = $(this).val();
    r = {
        "email":email,
        "situacao":2,
        "identificador": 1
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
            $('.close').click();
            $("#msg").addClass("erro");
            $('#msg').html('Falha ao aprovar psicólogo.');
        }
    }) 
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

  // ====================== OPÇÕES =====================================

  function initOptions(){
    $('#option-2-content').hide();
    $('#option-1').toggleClass('active');
  }

  initOptions();

  $('#option-1').click(function(){
    $('#option-2-content').hide();
    $('#option-1-content').show();

    $('#option-2').removeClass('active');
    $('#option-1').toggleClass('active');
  });

  $('#option-2').click(function(){
    $('#option-1-content').hide();
    $('#option-2-content').show();

    $('#option-1').removeClass('active');
    $('#option-2').toggleClass('active');
  });

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