$(function(){

    // mudar cor da nav
    $(window).scroll(function(){
        if ($(this).scrollTop() === 0) {
            $(".nav").css('background-color', 'rgba(0,0,0,0)');
        } 
        else{
            $(".nav").css('background-color', 'rgba(0,0,0,0.6)');
        }
    });

    // Menu Responsivo
    $('#js-open-menu').click(function(){
        $(this).toggleClass('menu-opened');

        $(this).toggleClass('active');
        $(".menu").toggleClass('active');
    });

    $(".go-about").click(function(){
        console.log('oi');
        $(this).removeClass('active');
        $(".menu").removeClass('active');

        $('.menu-button').removeClass('menu-opened');
    });

    $(".go-faq").click(function(){
        console.log('oi');
        $(this).removeClass('active');
        $(".menu").removeClass('active');

        $('.menu-button').removeClass('menu-opened');
    });
});