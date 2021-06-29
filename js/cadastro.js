$(document).ready(function(){

    $("#cadastro_usuario").click(function(){
        var nome_completo = $("#nome_completo").val();
        var nome_usuario = $("#nome_usuario").val();
        var email = $("#email").val();
        var senha = $("#senha").val();
        var confirma_senha = $("#confirma_senha").val(); 
        
        if((nome_usuario === '') || (nome_completo === '') || (email === '') || (senha === '') || (confirma_senha === '')){
            alert("Preencha todos os campos");
        }
        else{
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
        var cidade = $("#cidade").val();
        var senha = $("#senha_psi").val();
        var confirma_senha = $("#confirma_senha_psi").val();
        var estado = $('#estado').val();

        if((nome_usuario === '') || (registro === '') || (email === '') || (cidade == "") || (senha === '') || (confirma_senha === '')){
            alert("Preencha todos os campos");
        }
        else{
            var p = {
                "nome_completo":nome_completo,
                "registro":registro,
                "email":email,
                "cidade":cidade,
                "identificador":2
            }

            if(confereSenha(senha, confirma_senha)){
                var senha = $.md5(senha);
                p.senha = senha;
                $.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+estado,function(u){
                    p.uf = u.sigla;
                    enviarDados(p);
                }) 
            }
            else{
                mensagemErroSenha(2);
            }
        }
    });

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
                mensagemErroDois(dados.identificador);
            }
            else if(r == 3){
                mensagemErroEmail(dados.identificador);
                mensagemErroDois(dados.identificador);
            }
            else {
                mensagemErroCadastro(dados.identificador);
            }
        });
        
    }

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

    function mensagemErroDois(identificador){
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
});