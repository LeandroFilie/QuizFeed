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
            confereSenha(senha, confirma_senha, p);
        }

    });

    $("#cadastro_usuario_psi").click(function(){
        var nome_completo = $("#nome_completo_psi").val();
        var crp = $("#crp").val();
        var email = $("#email_psi").val();
        var senha = $("#senha_psi").val();
        var confirma_senha = $("#confirma_senha_psi").val();

        if((nome_usuario === '') || (crp === '') || (email === '') || (senha === '') || (confirma_senha === '')){
            alert("Preencha todos os campos");
        }
        else{
            var p = {
                "nome_completo":nome_completo,
                "crp":crp,
                "email":email,
                "identificador":2
            }
            confereSenha(senha, confirma_senha, p);
        }
    });

    function enviarDados(dados){
        console.log(dados);
        
        
        /* $.post("insere_usuario.php",{dados},function(r){

            limparMensagensErro();

            if(r == 0){
                location.href="home.php";
            }
            else if(r == 1){
                mensagemErroEmail();
            }
            else if(r == 2){
                mensagemErroNomeUsuario();
            }
            else if(r == 3){
                mensagemErroEmail();
                mensagemErroNomeUsuario();
            }
            else {
                mensagemErroCadastro();
            }
        }); */
        
    }

    function confereSenha(senha, confirma_senha, dados){
        limparMensagemErroSenha()
        if(senha === confirma_senha){
            var senha = $.md5(senha);
            dados.senha = senha;
            enviarDados(dados);
        }
        else{
            if(dados.identificador == 1){
                $("#erro_senha").addClass("erro");
                $("#erro_senha").html("As senhas não conferem");
            }
            else{
                $("#erro_senha_psi").addClass("erro");
                $("#erro_senha_psi").html("As senhas não conferem");
            }
        }
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

        $("#erro_nome").removeClass("erro");
        $("#erro_nome").html("");
    }

    function mensagemErroEmail(){
        $("#erro_email").addClass("erro");
        $("#erro_email").html("E-mail já cadastrado");
    }

    function mensagemErroNomeUsuario(){
        $("#erro_nome").addClass("erro");
        $("#erro_nome").html("Nome de Usuário já existe");
    }

    function mensagemErroCadastro(){
        $("#erro_cadastro").addClass("erro");
        $("#erro_cadastro").html("Erro no Cadastro");
    }
});