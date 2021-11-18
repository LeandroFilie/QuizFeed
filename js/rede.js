function curtir(id){
  dados = {
    'cod_postagem': id,
    'situacao': 1, //curtindo
    'acao': 1
  }

  $.post('interacoes_rede.php',dados,function(r){
    if(r == 0){
      numeroLikesAtual = parseInt($(".info-interacoes[value='"+ id +"'] #likeCount #numeroLikes").html());
      numeroLikesNovo = numeroLikesAtual + 1;

      $(".info-interacoes[value='"+ id +"'] #likeCount #numeroLikes").html(numeroLikesNovo);
      $(".like[value='"+ id +"'] img").attr('src', '././assets/images/liked.svg');
    }
    else{
      dados.situacao = 2
      $.post('interacoes_rede.php',dados,function(r){
        if(r == 0){
          numeroLikesAtual = parseInt($(".info-interacoes[value='"+ id +"'] #likeCount #numeroLikes").html());
          numeroLikesNovo = numeroLikesAtual - 1;
          
          $(".info-interacoes[value='"+ id +"'] #likeCount #numeroLikes").html(numeroLikesNovo);
          $(".like[value='"+ id +"'] img").attr('src', '././assets/images/like.svg');

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
    $(`.info-interacoes[value="${id_postagem}"] #comentarioCount`).html(`<span id="numeroComentarios">${r.qtdComentarios}</span> Comentários`)
    if(r.qtdComentarios > 3 && identificador == 5){
      t += `<span class="ver-mais" onclick="allComentarios(${id_postagem})">Ver comentários mais antigos</span>`;
    }
    nome_usuario = $('#nome_usuario').val();
    permissao = $('#permissao').val();
    $.each(r, function(i, v){
      if(v.nome_usuario != undefined){
        t += `
          <div class="comentario" data-user="${v.email_usuario}" data-time="${v.hora_default}" data-date="${v.data_default}">
          <div class="avatar">
            <img src="${v.avatar}" alt="Avatar" class="avatar" loading="lazy"/>
          </div>
          <div class="comentario-content">
            <div class="comentario-header">
              <span>${v.nome_usuario}</span>`;
              if(v.nome_usuario ==  nome_usuario || permissao == 1){
                  t += `
                  <div class="more-menu-comentario" onclick='abrirMenuComentarios("${v.data_default}", "${v.hora_default}", "${v.email_usuario}")'>
                  <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></div>
                  <div class="menu" data-user="${v.email_usuario}" data-time="${v.hora_default}" data-date="${v.data_default}">
                    <div class="more-menu-comentario excluir" onclick='removerComentario("${v.data_default}", "${v.hora_default}", "${v.email_usuario}", "${id_postagem}")'>
                      <img src="./assets/images/trash.svg" alt="Excluir" loading="lazy" />
                      <p>Excluir</p>
                    </div>
                  </div>
                </div>`;
              } 
            t += `</div>
            
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

function abrirMenuComentarios(data, hora, email){
  elemento = $(`.menu[data-user='${email}']`).filter(`[data-time='${hora}']`).filter(`[data-date='${data}']`);
  if(elemento.css('display') == 'none'){
    elemento.css('display', 'flex');
  }
  else{
    elemento.css('display', 'none');
  }
}

function removerComentario(data, hora, email, id){
  p = {
    data,
    hora,
    email
  };

  $.post('remover_comentario.php',p,function(r){
    if(r == 1){
      elemento = $(`.comentario[data-user='${email}']`).filter(`[data-time='${hora}']`).filter(`[data-date='${data}']`);
      elemento.css('display', 'none');

      countComentarios = $(".info-interacoes[value='"+ id +"'] #comentarioCount #numeroComentarios");
      qtdComentarios = Number(countComentarios.text());
      countComentarios.text(--qtdComentarios);
    }
  })
}

function ocultarPost(id, acao){
  elemento = $(`.post[value="${id}"]`);
  $(`.msg-denuncia[value="${id}"]`).html('');
  $(`.msg-denuncia[value="${id}"]`).removeClass('msg-denuncia');
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
  else if(acao == 'tirarDenuncia'){
    elemento.toggleClass('post-denunciado');
    elemento.html('<p>Pronto! A denuncia foi retirada e o post voltará a aparecer para os usuários</p>')
  
    elemento.removeClass('post');
  }

}

function removerPost(id){
  p = {
    tabela:'postagem',
    id,
    coluna:'id_postagem',
  };
  ocultarPost(id, 'remover');

  $.post('remover.php',p,function(r){
    if(r == 1){
        ocultarPost(id, 'remover');
    }
  })
}

function removerPostAdm(id){
  qtdPosts = Number($("#qtdPosts").html());

  $("#qtdPosts").text(--qtdPosts);

  p = {
    tabela:'postagem',
    id,
    coluna:'id_postagem',
  };
  ocultarPost(id, 'remover');

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

      qtdPosts = Number($("#qtdPosts").html().slice(11));

      $("#qtdPosts").text(`Pendentes: ${--qtdPosts}`);

      ocultarPost(id, 'tirarDenuncia');

    }
  })
}

function showPreviewImage(imagem){
  if (imagem.files && imagem.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e){
      if($('#preview-image').hasClass('hide')){
        $('#preview-image').toggleClass('show')
        $('#preview-image').removeClass('hide')
      }
      $('#preview-image').attr('src', e.target.result);
    }

    reader.readAsDataURL(imagem.files[0]);
}
}

function confereImagem(input) {
  var imagem = input.files[0];
  var tipoImagem = imagem.type;
  var sizeImagem = imagem.size;
  var tiposPermitidos = ['image/png', 'image/jpeg'];
  
  if(tiposPermitidos.includes(tipoImagem)){
    if(sizeImagem < 20971520){
      showPreviewImage(input)
    }
    else{
      $('.error-image').text('O tamanho máximo para fotos/vídeos é de 20MB');
      $('.error-image').css('display', 'block');
      $('.error-image').addClass('erro');
    }
  }
  else{
    $('.error-image').text('Formato de arquivo inválido');
    $('.error-image').css('display', 'block');
    $('.error-image').addClass('erro');
  }

}

function resetPreview(){
  $('#preview-image').attr('src', '');

  if($('#preview-image').hasClass('show')){
    $('#preview-image').toggleClass('hide')
    $('#preview-image').removeClass('show')
  }

  $('.error-image').text('');
  $('.error-image').removeClass('erro');
}

$("#imagem").change(function(){
  resetPreview();
  confereImagem(this);
});

$('form').submit(function(event){

  conteudo = $('[name="conteudo"]').val() !== '';
  imagem = $('[name="imagem"]').val() !== '';

  if(!conteudo && !imagem){
    event.preventDefault();
    $('.form-vazio').text('Não há como fazer uma postagem vazia')
    $('.form-vazio').addClass('erro')
  }
  else{
    $('.form-vazio').text('')
    $('.form-vazio').removeClass('erro')
  }

})