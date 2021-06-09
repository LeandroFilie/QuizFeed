$(document).ready(function(){
    $("#cadastro_usuario").click(function(){
        var nome_completo = $("#nome_completo").val();
        var nome_usuario = $("#nome_usuario").val();
        var email = $("#email").val();
        var senha = $("#senha").val();
        var confirma_senha = $("#confirma_senha").val();

        if((nome_usuario === '') || (nome_completo === '') || (email === '') || (senha === '')){
            alert("Preencha todos os campos");
        }
        else{
            if(senha === confirma_senha){
                var senha = $.md5(senha);
                $.post("insere_usuario.php",{"nome_completo":nome_completo,"nome_usuario":nome_usuario, "email":email,"senha":senha},function(r){

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
                });
            }
            else{
                $("#erro_senha").addClass("erro");
                $("#erro_senha").html("As senhas não conferem");
            }
        }
    });

    function limparMensagensErro(){
        $("#erro_senha").removeClass("erro");
        $("#erro_senha").html("");
        
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