function curtir(id){
  console.log(id);
  dados = {
    'cod_postagem': id,
    'situacao': 1, //curtindo
    'acao': 1
  }

  $.post('interacoes_rede.php',dados,function(r){
    console.log(r);
    if(r == 0){
      dadosLike = {
        id: id,
        identificador: '3'
      }
      $.post('seleciona.php',dadosLike,function(r){
        $(".info-interacoes[value='"+ id +"'] #likeCount").text(`${r.qtdLikes} Curtidas`);
        $(".like[value='"+ id +"'] img").attr('src', '././assets/images/liked.svg');
      }) 
    }
    else{
      dados.situacao = 2
      $.post('interacoes_rede.php',dados,function(r){
        if(r == 0){
          dadosLike = {
            id: id,
            identificador: '3'
          }
          $.post('seleciona.php',dadosLike,function(r){
            $(".info-interacoes[value='"+ id +"'] #likeCount").text(`${r.qtdLikes} Curtidas`);
            $(".like[value='"+ id +"'] img").attr('src', '././assets/images/like.svg');
          })
        }
      })

    }

  })
}

function focusComentar(id){
  $(`.enviar-comentario [name='${id}']`).focus();
}

function atualizarComentarios(id_postagem, identificador){
  dadosPost = {
    id_postagem,
    identificador
  }

  $.post('seleciona.php',dadosPost,function(r){
    t = '';
    j = 0;
    $(`.info-interacoes[value="${id_postagem}"] #comentarioCount`).text(`${r.qtdComentarios} Comentários`)
    if(r.qtdComentarios > 3 && identificador == 5){
      t += `<span class="ver-mais" onclick="allComentarios(${id_postagem})">Ver comentários mais antigos</span>`;
    }
    $.each(r, function(i, v){

      if(v.nome_usuario != undefined){
        t += `
          <div class="comentario">
            <div class="avatar">
              <img src="./assets/images/avatar.svg" alt="Avatar" />
            </div>
            <div class="comentario-content">
              <span>${v.nome_usuario}</span>
              <p>${v.conteudo}</p>
              <div class="comentario-info">
                <span>${v.data}</span>
                <span>${v.hora}</span>
              </div>
            </div>
          </div> 
        `;
        j++;
      }

    })
    if(identificador == 4){
      t+= `<span class="ver-mais" onclick="atualizarComentarios(${id_postagem}, 5)">Ver menos</span>`;
    }

    $(`#${id_postagem}`).html(t);

  })


  $(`input[name="${id_postagem}"]`).val('');

}

function comentar(id){
  conteudo = $(`input[name="${id}"]`).val();

  dados = {
    'conteudo': conteudo,
    'cod_postagem': id, //curtindo
    'acao': 2
  }

  $.post('interacoes_rede.php',dados,function(r){
    if(r == 0){
      atualizarComentarios(id, 5);
    }

  })
}

function allComentarios(id_postagem){
  atualizarComentarios(id_postagem, 4);
}

function abrirMenu(id){
  elemento = $(`.more-menu[value="${id}"]`);

  if(elemento.css('display') == 'none'){
    elemento.css('display', 'flex');
  }
  else{
    elemento.css('display', 'none');
  }
}

function ocultarPost(id, acao){
  elemento = $(`.post[value="${id}"]`);
  if(acao == 'remover'){
    elemento.toggleClass('post-removido');
    elemento.html('<p>Pronto! O post foi removido com sucesso</p>')
  
    elemento.removeClass('post');
  }
  else if(acao == 'denunciar'){
    elemento.toggleClass('post-denunciado');
    elemento.html('<p>Que pena que houve essa inconveniência. Obrigado por nos ajudar, vamos tomar providências</p>')
  
    elemento.removeClass('post');
  }

}

function removerPost(id){
  p = {
    tabela:'postagem',
    id,
    coluna:'id_postagem',
  };

  $.post('remover.php',p,function(r){
    if(r == 1){
        ocultarPost(id, 'remover');
    }
  })
}

function denunciarPost(id){
  dados = {
    'cod_postagem': id,
    'situacao': 2, //denunciado
    'acao': 3
  }

  $.post('interacoes_rede.php',dados,function(r){
    if(r == 0){
      ocultarPost(id, 'denunciar');

    }
  })

}

function tirarDenuncia(id){
  console.log(id);
  dados = {
    'cod_postagem': id,
    'situacao': 1, //tirando denuncia
    'acao': 3
  }



  $.post('interacoes_rede.php',dados,function(r){
    if(r == 0){

      $(`.post-denunciado-adm[value="${id}"] .tirar-denuncia`).css('display', 'none');

      $(`.post-denunciado-adm[value="${id}"]`).removeClass('post-denunciado-adm');
      $(`.msg-denuncia[value="${id}"]`).text('');
      $(`.msg-denuncia[value="${id}"]`).removeClass('msg-denuncia');

    }
  })
}

$(document).ready(function(){
//rede.php
  $('#postar').click(function(){
    var p = {
      'conteudo': $('#conteudo').val()
    }

    console.log(p);

    $.post("insere_post.php",p,function(r){
      console.log(r);
      $('#erro_post').html('');
      $('#erro_post').removeClass('erro');
      if(r == 0){
        location.reload();
      }
      else if(r == 1){
        $('#erro_post').html('Erro ao fazer post. Por favor, contate o admistrador');
        $('#erro_post').addClass('erro');
      }
    })
  })

//home.php ==> usuário entrar na rede
  function entrarRede(id){
    $('.erro_entrar_rede').html('');
    $('.erro_entrar_rede').removeClass('erro');
    $('.erro_entrar_rede').css('display','none');

    if(id.id!=""){
      $.post("gerenciamento_rede.php",id,function(r){
        console.log(r);
        if(r==0){
          location.href="rede.php";
        }else{
          $('.erro_entrar_rede').css('display','block');
          $('.erro_entrar_rede').html('Erro ao entrar na rede. Por favor, contate o administrador.');
          $('.erro_entrar_rede').addClass('erro');
        }
      })
    }else{
      $('.erro_entrar_rede').css('display','block')
        $('.erro_entrar_rede').html('Selecione uma rede para entrar.');
        $('.erro_entrar_rede').addClass('erro');
    }

  }

  $('.btn-entrar-rede-option-1').click(function(){
    var id = {
      'id': $('.nome_rede_option-1').val()
    }

    entrarRede(id);
  })

  $('.btn-entrar-rede-option-2').click(function(){
    var id = {
      'id': $('.nome_rede_option-2').val()
    }

    entrarRede(id);
  })
})