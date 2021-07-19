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
  emptyComment = jQuery(`.empty-comment[value='${id}']`);
  if(elemento.hasClass('hide')){
    elemento.removeClass('hide');
    elemento.toggleClass('show');

    emptyComment.css('display', 'none');
  }
  else{
    elemento.removeClass('show');
    elemento.toggleClass('hide');

    emptyComment.css('display', 'block');
  } 
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