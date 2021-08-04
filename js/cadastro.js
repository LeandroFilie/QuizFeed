$(document).ready(function(){

// ========================= DECLARAÇÃO DE FUNÇÕES CADASTRO ===========================
    function confereSenha(senha, confirma_senha){
        limparMensagemErroSenha();
        return senha === confirma_senha ? true : false;
    }

    function limparMensagemErroSenha(){
        $("#erro_senha").removeClass("erro");
        $("#erro_senha").html("");

        $("#erro_senha_psi").removeClass("erro");
        $("#erro_senha_psi").html("");
    }

    function mensagemErroSenha(identificador){
        if(identificador == 1){
            $("#erro_senha").addClass("erro");
            $("#erro_senha").html("As senhas não conferem");
        }
        else{
            $("#erro_senha_psi").addClass("erro");
            $("#erro_senha_psi").html("As senhas não conferem");
        }
    }

    function limparMensagensErro(){
        $("#erro_email").removeClass("erro");
        $("#erro_email").html("");

        $("#erro_email_psi").removeClass("erro");
        $("#erro_email_psi").html("");

        $("#erro_registro").removeClass("erro");
        $("#erro_registro").html("");

        $("#erro_nome").removeClass("erro");
        $("#erro_nome").html("");
    }

    function mensagemErroEmail(identificador){
        if(identificador == 1){
            $("#erro_email").addClass("erro");
            $("#erro_email").html("E-mail já cadastrado");
        }
        else{
            $("#erro_email_psi").addClass("erro");
            $("#erro_email_psi").html("E-mail já cadastrado");
        }
    }

    function mensagemErroNomeUsuarioRegistro(identificador){
        if(identificador == 1){
            $("#erro_nome").addClass("erro");
            $("#erro_nome").html("Nome de Usuário já existe");
        }
        else{
            $("#erro_registro").addClass("erro");
            $("#erro_registro").html("Número de registro já cadastrado");
        }
        
    }

    function mensagemErroCadastro(identificador){
        if(identificador == 1){
            $("#erro_cadastro").addClass("erro");
            $("#erro_cadastro").html("Erro no Cadastro");
        }
        else{
            $("#erro_cadastro_psi").addClass("erro");
            $("#erro_cadastro_psi").html("Erro no Cadastro");
        }
    }

    function enviarDados(dados){
        $.post("insere_usuario.php",dados,function(r){

            console.log(dados);

            console.log(r);

            limparMensagensErro();

            if(r == 0){
                location.href="home.php";
            }
            else if(r == 1){
                mensagemErroEmail(dados.identificador);
            }
            else if(r == 2){
                mensagemErroNomeUsuarioRegistro(dados.identificador);
            }
            else if(r == 3){
                mensagemErroEmail(dados.identificador);
                mensagemErroNomeUsuarioRegistro(dados.identificador);
            }
            else {
                mensagemErroCadastro(dados.identificador);
            }
        });
        
    }

// ========================= CADASTRO ===========================
    $("#cadastro_usuario").click(function(){
        var nome_completo = $("#nome_completo").val();
        var nome_usuario = $("#nome_usuario").val();
        var email = $("#email").val();
        var senha = $("#senha").val();
        var confirma_senha = $("#confirma_senha").val(); 
        
        if((nome_usuario === '') || (nome_completo === '') || (email === '') || (senha === '') || (confirma_senha === '')){
            Swal.fire({
                title: 'Preencha todos os campos',
                icon: 'error',
                confirmButtonColor: 'red',
            })
            
            nome_usuario === '' ? $("#nome_usuario").addClass('erro-input') : $("#nome_usuario").removeClass('erro-input');
            nome_completo === '' ? $("#nome_completo").addClass('erro-input') : $("#nome_completo").removeClass('erro-input');
            email === '' ? $("#email").addClass('erro-input') : $("#email").removeClass('erro-input')
            senha === '' ? $("#senha").addClass('erro-input') : $("#senha").removeClass('erro-input');
            confirma_senha === '' ? $("#confirma_senha").addClass('erro-input') : $("#senha").removeClass('erro-input');
        }
        else{
            $("#nome_usuario").removeClass('erro-input');
            $("#nome_completo").removeClass('erro-input');
            $("#email").removeClass('erro-input');
            $("#senha").removeClass('erro-input');
            $("#confirma_senha").removeClass('erro-input');

            var p = {
                "nome_completo":nome_completo,
                "nome_usuario":nome_usuario,
                "email":email, 
                "identificador":1
            }

            if(confereSenha(senha, confirma_senha)){
                var senha = $.md5(senha);
                p.senha = senha;
                enviarDados(p);
            }
            else{
                mensagemErroSenha(1);
            }
        }

    });

    $("#cadastro_usuario_psi").click(function(){
        var nome_completo = $("#nome_completo_psi").val();
        var registro = $("#registro").val();
        var email = $("#email_psi").val();
        var tel = $("#tel_psi").val();
        var cidade = $("#cidade").val();
        var senha = $("#senha_psi").val();
        var confirma_senha = $("#confirma_senha_psi").val();
        var estado = $('#estado').val();

        if((nome_usuario === '') || (registro === '') || (email === '') || (tel === '') || (cidade === "") || (senha === '') || (confirma_senha === '')){
            Swal.fire({
                title: 'Preencha todos os campos',
                icon: 'error',
                confirmButtonColor: 'red',
            })

            nome_completo === '' ? $("#nome_completo_psi").addClass('erro-input') : $("#nome_completo_psi").removeClass('erro-input');
            registro === '' ? $("#registro").addClass('erro-input') : $("#registro").removeClass('erro-input');
            email === '' ? $("#email_psi").addClass('erro-input') : $("#email_psi").removeClass('erro-input');
            tel === '' ? $("#tel_psi").addClass('erro-input') : $("#tel_psi").removeClass('erro-input');
            estado === '0' ? $("#estado").addClass('erro-input') : $("#estado").removeClass('erro-input');
            cidade === '' ? $("#cidade").addClass('erro-input') : $("#cidade").removeClass('erro-input');
            senha === '' ? $("#senha_psi").addClass('erro-input') : $("#senha_psi").removeClass('erro-input');
            confirma_senha === '' ? $("#confirma_senha_psi").addClass('erro-input') : $("#confirma_senha_psi").removeClass('erro-input');
        }
        else{
            $("#nome_completo_psi").removeClass('erro-input');
            $("#registro").removeClass('erro-input');
            $("#email_psi").removeClass('erro-input');
            $("#tel_psi").removeClass('erro-input');
            $("#estado").removeClass('erro-input');
            $("#cidade").removeClass('erro-input');
            $("#senha_psi").removeClass('erro-input');
            $("#confirma_senha_psi").removeClass('erro-input');

            var p = {
                "nome_completo":nome_completo,
                "registro":registro,
                "email":email,
                "tel":tel,
                "cidade":cidade,
                "uf":estado,
                "identificador":2
            }

            if(confereSenha(senha, confirma_senha)){
                var senha = $.md5(senha);
                p.senha = senha;
                enviarDados(p);
            }
            else{
                mensagemErroSenha(2);
            }
        }
    });

// ========================= OPÇÕES DE ENTRADA CADASTRO ===========================

    function initOptions(){
        $('#option-2-content').hide();
        $('#option-1').toggleClass('active');
    }

    initOptions();

    $('#option-1').click(function(){
        $('#option-2-content').hide();
        $('#option-1-content').show();

        $('#option-2').removeClass('active');
        $('#option-1').toggleClass('active');
    });

    $('#option-2').click(function(){
        $('#option-1-content').hide();
        $('#option-2-content').show();

        $('#option-1').removeClass('active');
        $('#option-2').toggleClass('active');
    });

// ========================= MOSTRAR/OCULTAR SENHA ===========================

    $('#mostrar_senha').click(function(){
        if($('#senha').attr('type') == 'password'){
            $('#senha').attr('type', 'text');
            $('#mostrar_senha').attr('src', './assets/images/eye-off.svg');
        }
        else{
            $('#senha').attr('type', 'password');
            $('#mostrar_senha').attr('src', './assets/images/eye.svg');
        }
    });

    $('#mostrar_confirma_senha').click(function(){
        if($('#confirma_senha').attr('type') == 'password'){
            $('#confirma_senha').attr('type', 'text');
            $('#mostrar_confirma_senha').attr('src', './assets/images/eye-off.svg');
        }
        else{
            $('#confirma_senha').attr('type', 'password');
            $('#mostrar_confirma_senha').attr('src', './assets/images/eye.svg');
        }
    });

    $('#mostrar_senha_psi').click(function(){
        if($('#senha_psi').attr('type') == 'password'){
            $('#senha_psi').attr('type', 'text');
            $('#mostrar_senha_psi').attr('src', './assets/images/eye-off.svg');
        }
        else{
            $('#senha_psi').attr('type', 'password');
            $('#mostrar_senha_psi').attr('src', './assets/images/eye.svg');
        }
    });

    $('#mostrar_confirma_senha_psi').click(function(){
        if($('#confirma_senha_psi').attr('type') == 'password'){
            $('#confirma_senha_psi').attr('type', 'text');
            $('#mostrar_confirma_senha_psi').attr('src', './assets/images/eye-off.svg');
        }
        else{
            $('#confirma_senha_psi').attr('type', 'password');
            $('#mostrar_confirma_senha_psi').attr('src', './assets/images/eye.svg');
        }
    });

// ========================= MÁSCARA INPUT DE REGISTRO ===========================

    $("#registro").keyup(function() {
        $("#registro").val(this.value.match(/[0-9]*/));
    });

    maskTel();

    function maskTel(){
        $('#tel_psi').mask('(00) 0000-00009');

        $('#tel_psi').keyup(function() {
            if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                $('#tel_psi').mask('(00) 00000-0009');
            } else {
                $('#tel_psi').mask('(00) 0000-00009');
            }
        });
    }

    
});