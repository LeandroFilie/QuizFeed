function curtir(id){
  dados = {
    'cod_postagem': id,
    'situacao': 1 //curtindo
  }

  $.post('interacoes_rede.php',dados,function(r){
    if(r == 0){
      $.get('seleciona.php?identificador=4&id='+id,function(r){
        $("#like[value='"+ id +"'] #likeCount").text(`${r.qtdLikes}`);
        $("#like[value='"+ id +"'] img").attr('src', '././assets/images/liked.svg');
      }) 
    }
    else{
      dados.situacao = 2
      $.post('interacoes_rede.php',dados,function(r){
        if(r == 0){
          $.get('seleciona.php?identificador=4&id='+id,function(r){
            $("#like[value='"+ id +"'] #likeCount").text(`${r.qtdLikes}`);
            $("#like[value='"+ id +"'] img").attr('src', '././assets/images/like.svg');
          })
        }
      })

    }

  })
}

function comentar(id){
  elemento = jQuery(`.enviar-comentario[value='${id}']`);
  if(elemento.hasClass('hide')){
    elemento.removeClass('hide')
    elemento.toggleClass('show')
  }
  else{
    elemento.removeClass('show')
    elemento.toggleClass('hide')
  } 
}

$(document).ready(function(){
  $('#postar').click(function(){
    var p = {
      'conteudo': $('#conteudo').val()
    }

    $.post("insere_post.php",p,function(r){
      $('#erro_post').html('');
      $('#erro_post').removeClass('erro');
      if(r == 0){
        atualizarListaPosts();
      }
      else if(r == 1){
        $('#erro_post').html('Erro ao fazer post. Por favor, contate o admistrador');
        $('#erro_post').addClass('erro');
      }
    })
  })

  function atualizarListaPosts(){
    $.get("seleciona.php?identificador=3",function(r){
      t = '';
      $.each(r,function(i,p){     
        $.get("seleciona.php?identificador=4&id="+p.id_postagem,function(resultado){
          console.log(resultado);
            t += `
            <div class="post">
              <p>${p.conteudo}</p>
              <div class="post-footer">
                <div class="user-info">
                  <img src="./assets/images/avatar.svg" alt="Avatar" />
                  <span>${p.nome_usuario}</span>
                </div>
                <div class="interacoes">
                  <img src="./assets/images/answer.svg" alt="comentar" class="comentar" onclick="comentar(${p.id_postagem})">
                  <div class="like" id="like" value="${p.id_postagem}" onclick="curtir(${p.id_postagem})" >
                    <span id="likeCount">${resultado.qtdLikes}</span>`;
                    if(resultado.verificaLikes > 0){
                      t += `<img src="././assets/images/liked.svg" alt="liked">`;
                    }
                    else{
                      t += `<img src="././assets/images/like.svg" alt="like">`;
                    } 
                    console.log(resultado.verificaLikes);

              t +=`      
                  </div>
                </div>
              </div>

              <div class="section-comentarios">
                <div class="enviar-comentario hide" value="${p.id_postagem}">
                  <input type="text" placeholder="Escreva seu comentário" />
                  <img src="./assets/images/send.svg" alt="" id="mostrar_senha" class="button_enviar_comentario">
                </div>

                <div class="comentario">
                  <div class="comentario-content">
                    <p>Seja o primeiro a comentar nesse post!</p>
                  </div>
                </div>

              </div>

            </div>
            `;
            $('.posts').html(t);
          
        })
      });  
    }); 
  $('#conteudo').val('');

  }

})