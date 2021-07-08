<script>
  $(function(){

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
  })
</script>