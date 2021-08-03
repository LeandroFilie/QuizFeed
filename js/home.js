$(function(){

  activeStep = 1;

  maxStep = 0;

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

  itemsAccordion();

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

  $('.detalhe-area').change(function(){    
    $('#areaDescricao').modal('show');

    dadosArea = {
      id: $(this).val(),
      identificador: '7'
    }

    $.post('seleciona.php',dadosArea,function(r){
      t = '';
      $.each(r, function(i, v){
        nome = v.nome;
        t += `
          <div>${v.descricao}</div>
        `;
      })

      $('.modal-title').html(nome);
      $('#descricao').html(t);

    })

  })


}) 