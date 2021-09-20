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

      ocultarPost(id, 'tirarDenuncia');

    }
  })
}

function readURL(input) {

  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#preview-image').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
  }
}

$("#imagem").change(function(){
  $('#preview-image').toggleClass('show')
  $('#preview-image').removeClass('hide')
  readURL(this);
});