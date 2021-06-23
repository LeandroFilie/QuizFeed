$(document).ready(function(){
    $('#estado').change(function(){
        var uf = $(this).val();
        console.log(uf);
        if(uf == '0'){
            $('#cidade').attr("disabled", "disabled");
            t = '<option value="" label="Cidade"></option>';
            $('#cidade').html(t);
        }
        else{
            $('#cidade').removeAttr("disabled");
            $.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+uf+'/municipios',function(c){
                t = "";
                $.each(c,function(i,v){
                    t += `<option value="${v.nome}">${v.nome}</option>`;
                })
                $('#cidade').html(t);
            })
        }
    });

    /* $('#estado_modal').change(function(){
        var uf = $(this).val();
        console.log(uf);
        if(uf == '0'){
            $('#cidade_modal').attr("disabled", "disabled");
            t = '<option value="" label="Cidade"></option>';
            $('#cidade_modal').html(t);
        }
        else{
            $('#cidade_modal').removeAttr("disabled");
            $.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+uf+'/municipios',function(c){
                t = "";
                $.each(c,function(i,v){
                    t += `<option value="${v.nome}">${v.nome}</option>`;
                })
                $('#cidade_modal').html(t);
            })
        }
    }); */
})