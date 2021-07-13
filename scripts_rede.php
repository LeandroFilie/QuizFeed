<script>
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

    $('.comentar').click(function(){
      if($('.enviar-comentario').hasClass('hide')){
        $('.enviar-comentario').removeClass('hide')
        $('.enviar-comentario').toggleClass('show')
      }
      else{
        $('.enviar-comentario').removeClass('show')
        $('.enviar-comentario').toggleClass('hide')
      }
      
    })

    function atualizarListaPosts(){
        $.get("seleciona.php?identificador=3",function(r){
          t = '';
          $.each(r,function(i,p){            
              t += `
                <div class="post">
                  <p>${p.conteudo}</p>
                  <div class="post-footer">
                    <div class="user-info">
                      <img src="./assets/avatar.svg" alt="Avatar" />
                      <span>${p.nome_usuario}</span>
                    </div>
                    <div class="interacoes">
                      <img src="./assets/answer.svg" alt="comentar" class="comentar">
                      <div class="like">
                        <span id="likeCount">10</span>
                        <img src="./assets/like.svg" alt="like">
                      </div>
                    </div>
                  </div>

                  <div class="section-comentarios">
                    <div class="enviar-comentario hide">
                      <input type="text" placeholder="Escreva seu comentário" />
                      <img src="./assets/send.svg" alt="" id="mostrar_senha" class="button_enviar_comentario">
                    </div>

                    <div class="comentario">
                      <div class="comentario-content">
                        <p>Seja o primeiro a comentar nesse post!</p>
                      </div>
                    </div>

                  </div>

                </div>
              `;
          });  
          $('.posts').html(t);
      });
      $('#conteudo').val('');
    }
  })
</script>