$(function(){

  activeStep = 1;

  maxStep = 0;

  $('.select-option').click(function(){
    option = parseInt($(this).val());
    option == 1 ? maxStep = 2 : maxStep = 3;

    if(maxStep == 2){
      $('.steps-bar [data-step="3"]').css('display', 'none');
    }

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

}) 