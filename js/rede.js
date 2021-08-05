function curtir(id){
  dados = {
    'cod_postagem': id,
    'situacao': 1, //curtindo
    'acao': 1
  }

  $.post('interacoes_rede.php',dados,function(r){
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
/* function allComentarios(id_postagem){
  dadosPost = {
    id_postagem: id_postagem,
    identificador: '5'
  }

  $.post('seleciona.php',dadosPost,function(r){
    console.log(r);
    t = '';
    j = 0;
    $(`info-interacoes[value="${id_postagem}"] #comentarioCount`).text(`${r.qtdComentarios} Comentários`)
    $.each(r, function(i, v){
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
    })
    if(j > 3){
      t+= `<span class="ver-mais" onclick="partComentarios(${id_postagem})">Ver menos</span>`;
    }

    $(`#${id_postagem}`).html(t);

  })
} */

/* function atualizarComentarios(id_postagem){

  dadosPost = {
    id_postagem: id_postagem,
    identificador: '4'
  }

  allComentarios(id_postagem)
  $(`input[name="${id_postagem}"]`).val('');
} */

/* function comentar(id){
  conteudo = $(`input[name="${id}"]`).val();

  dados = {
    'conteudo': conteudo,
    'cod_postagem': id, //curtindo
    'acao': 2
  }

  $.post('interacoes_rede.php',dados,function(r){
    if(r == 0){
      atualizarComentarios(id);
    }

  })

} */

/* function partComentarios(id_postagem){
  dadosPost = {
    id_postagem: id_postagem,
    identificador: '4'
  }

  $.post('seleciona.php',dadosPost,function(r){  
    console.log(r);
    t='';
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
      } 
      
    })
  
    if(r.qtdComentarios > 3){
      t += `<span class="ver-mais" onclick="allComentarios(${id_postagem})">Ver mais comentários</span>`;
    }

    $(`#${id_postagem}`).html(t);

  })
} */



$(document).ready(function(){
//rede.php
  $('#postar').click(function(){
    var p = {
      'conteudo': $('#conteudo').val()
    }

    $.post("insere_post.php",p,function(r){
      $('#erro_post').html('');
      $('#erro_post').removeClass('erro');
      if(r == 0){
        location.reload();
        // atualizarListaPosts();
      }
      else if(r == 1){
        $('#erro_post').html('Erro ao fazer post. Por favor, contate o admistrador');
        $('#erro_post').addClass('erro');
      }
    })
  })

//home.php ==> usuário entrar na rede
  $('.btn-entrar-rede').click(function(){
    var id = {
      'id': $('#nome_rede').val()
    }

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

  })
})