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
        $("#like[value='"+ id +"'] #likeCount").text(`${r.qtdLikes}`);
        $("#like[value='"+ id +"'] img").attr('src', '././assets/images/liked.svg');
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
            $("#like[value='"+ id +"'] #likeCount").text(`${r.qtdLikes}`);
            $("#like[value='"+ id +"'] img").attr('src', '././assets/images/like.svg');
          })
        }
      })

    }

  })
}

function exibeCampoComentar(id){
  elemento = jQuery(`.enviar-comentario[value='${id}']`);
  emptyComment = jQuery(`.empty-comment[value='${id}']`);
  if(elemento.hasClass('hide')){
    elemento.removeClass('hide');
    elemento.toggleClass('show');

    $(`input[name="${id}"]`).focus();

    emptyComment.css('display', 'none');
  }
  else{
    elemento.removeClass('show');
    elemento.toggleClass('hide');

    emptyComment.css('display', 'block');
  } 
}

function atualizarComentarios(id_postagem){

  dadosPost = {
    id_postagem: id_postagem,
    identificador: '4'
  }

  allComentarios(id_postagem)
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
      atualizarComentarios(id);
    }

  })

}

function partComentarios(id_postagem){
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
}

function allComentarios(id_postagem){
  dadosPost = {
    id_postagem: id_postagem,
    identificador: '5'
  }

  $.post('seleciona.php',dadosPost,function(r){
    console.log(r);
    t = '';
    j = 0;
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
}







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

//gerenciamento_rede.php
  $('#entrar_rede').click(function(){

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