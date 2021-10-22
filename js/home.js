$(function(){

  activeStep = 1;

  maxStep = 0;

  // =============== DECLARAÇÃO DE FUNÇÕES ====================

  function checkButtonState() {
    if(activeStep == 1){
      activeStep = 1;
      maxStep = 0;

      $('.buttons').css('display', 'none')
    }
    else{
      $('.buttons').css('display', 'flex')
      $('.next-btn').css('visibility', 'visible')

      if(activeStep == maxStep){
        $('.next-btn').css('visibility', 'hidden')
      }
    }
  }

  function next(){
    $(`.steps [data-step="${activeStep}"]`).removeClass('active');

    activeStep++;

    if(activeStep != 1){
      $('.steps').css('justify-content', 'flex-start');
    } 

    $(`.option-${option} [data-step="${activeStep}"]`).toggleClass('active');
    $(`.steps-bar [data-step="${activeStep}"]`).toggleClass('active');

    checkButtonState();
  }

  function prev(){
    $(`[data-step="${activeStep}"]`).removeClass('active');

    activeStep--;

    if(activeStep == 1){
      $(`[data-step="${activeStep}"]`).toggleClass('active');
      $('.steps-bar [data-step="3"]').css('display', 'flex');
      $('.steps-bar [data-step="1"]').toggleClass('active');
      $('.steps-options .step').css('display', 'flex')
      $('.steps').css('justify-content', 'center');

    }
    else{
      $(`.option-${option} [data-step="${activeStep}"]`).toggleClass('active');
    }

    checkButtonState();
  }

  function itemsAccordion(){
    var items = $('.accordion');

    for(let i = 0; i < items.length; i++){
      $(items[i]).click(function(){
        $(items[i]).toggleClass('active');
        var dados = $(items[i]).next();

        if(dados.css('display') == 'block') {
          dados.css('display', 'none');
        } 
        else{
          dados.css('display', 'block');
        }
        
        if(dados.css('maxHeight') === '0px'){
          dadosScrollHeight = `${dados.prop("scrollHeight")}px`;
          dados.css('maxHeight', dadosScrollHeight);
        } 
        else{
          dados.css('maxHeight', '0px');
        } 
      })
    }
    
  }

  // ================= AÇÕES =====================
  itemsAccordion();

  $('.select-option').click(function(){
    option = parseInt($(this).val());
    option == 1 ? maxStep = 2 : maxStep = 3;

    if(maxStep == 2){
      $('.steps-bar [data-step="3"]').css('display', 'none');
      $('.steps-bar .divider').css('width', '60%');
    }

    $('.steps-options .step').css('display', 'none')
    next()

    checkButtonState();
  })

  $('.next-btn').click(function(){
    next();
  })

  $('.prev-btn').click(function(){
    prev();
  })

  $('.detalhe-area').change(function(){    
    $('#areaDescricao').modal('show');

    dadosArea = {
      id: $(this).val(),
      identificador: '7'
    }

    $.post('seleciona.php',dadosArea,function(r){
      nome = r.nome;
      t = `
        <div>${r.descricao}</div>
      `;
      cursos = {
        idArea: r.id_area,
        identificador: '10'
      }

      $.post('seleciona.php',cursos,function(c){
        tCursos = '';
        $.each(c, function(i, v){
          tCursos += ` 
            <p>${v.nome}</p>
            <span class="separadorCursos"></span>
          `
        })

        $('#cursos').html(tCursos);
      })

      $('.modal-title').html(nome);
      $('#descricao').html(t);
      

    })

  })

  $('.trocar-rede').click(function(){
    area = $("#nome_rede").val();
    if(area != ''){
      p = {
        area,
        identificador: '2'
      };

      $.post("gerenciamento_rede.php",p,function(r){
        if(r == 0){
          $(".close").click();
          location.reload();
        }
      });

      $("#nome_rede").val('');
    }

  });

  // Filtro de psicólogos

  $('#filtrarPsicologos').click(function(){
    estado = $('#estado_filtro').val();
    cidade = $('#cidade').val();

    select = "SELECT nome, email_usuario, uf, cidade FROM usuario_psicologo INNER JOIN usuario ON usuario.email = usuario_psicologo.email_usuario WHERE usuario_psicologo.situacao = '2'"

    if(estado != ''){
      select += ` AND uf = '${estado}'`;
    }
    if(cidade != ''){
      select += ` AND cidade like '%${cidade}%'`;
    }

    dadosFiltro = {
      select,
      identificador: '6'
    }

      $.post('seleciona.php',dadosFiltro,function(r){
      t = '';
      if(r == 0){
        t+= '<h3 id="emptySituacao1">Não há psicólogos cadastrados</h3>';
      }
      else{
        $.each(r, function(i, v){
          t += `  
          <span class="accordion">${v.nome}</span>
          <div class="dados">
              <p>Email: ${v.email_usuario}</p>
              <p>${v.cidade} - ${v.uf}</p>
          </div>
          `;
        })
      }

      $('#psicologos').html(t);

      $('#estado_filtro').val('');
      $('#cidade').val('');
  
      itemsAccordion();
  
    })
  })

  // Entrada do usuário na rede
  function entrarRede(id){
    $('.erro_entrar_rede').html('');
    $('.erro_entrar_rede').removeClass('erro');
    $('.erro_entrar_rede').css('display','none');
    
    id.identificador = '1';

    if(id.id!=""){
      $.post("gerenciamento_rede.php",id,function(r){
        
        if(r==0){
          location.href="home.php";
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