//Funções da Pagina Cadastrar

function cadastrar() {
    
    if ($('input[name="nome"]').val() <= 0 || $('input[name="email"]').val() <= 0 || $('input[name="cpf"]').val() <= 0 
            || $('input[name="id"]').val() <= 0 || $('input[name="senha"]').val() <= 0 || $('input[name="senha2"]').val() <= 0){
        $('#camposobrigatorios').modal('show');
    } else if ($('input[name="senha"]').val() != $('input[name="senha2"]').val()){
        $('#senhaserradas').modal('show');
    } else {
        var nome = $('input[name=nome]').val();
        var email = $('input[name=email]').val();
        var cpf = $('input[name=cpf]').val(); 
        var id = $('input[name=id]').val();
        var senha = $('input[name=senha]').val();
        
        //validando o CPF
        $.ajax({
            url:BASE_URL+"usuarios/validaCPF/"+cpf,
            type:'POST',
            success:function(msg) {
                if (msg != '1' ){  
                    $.ajax({                        
                        url:BASE_URL+"usuarios/pesquisarEmail/"+email,
                        type:'POST',
                        success:function(msg3) {	
                            if (msg3 === '1' ){
                                $('#emailjacadastrado').modal('show');                                  
                            } else {
                                $.ajax({                        
                                url:BASE_URL+"usuarios/pesquisarCPF/"+cpf,
                                type:'POST',
                                    success:function(msg3) {	
                                        if (msg3 === '1' ){
                                            $('#cpfjacadastrado').modal('show');                                  
                                        } else {
                                            $.ajax({                        
                                                url:BASE_URL+"usuarios/pesquisarID/"+id,
                                                type:'POST',
                                                success:function(msg3) {	
                                                    if (msg3 === '0' ){
                                                        $('#idinvalido').modal('show');                                  
                                                    } else {
                                                        $.ajax({
                                                            url:BASE_URL+"usuarios/cadastrar",
                                                            type:'POST',
                                                            data:{
                                                                id:id,
                                                                nome:nome,
                                                                email:email,
                                                                cpf:cpf,
                                                                senha:senha
                                                            },

                                                            success:function(res) {
                                                                if (res === '1') {
                                                                    $('#CadastroSucesso').modal('show');
                                                                    window.setTimeout("location.href='"+BASE_URL+"'",3000); 
                                                                } 
                                                            }
                                                        });
                                                    }
                                                }
                                            });
                                        }
                                    }
                                });        
                            }
                        }
                    });
                } else {
                   $('#CPFInvalido').modal('show');
                }
            }
        });
    }
//    document.cadastrarPJ.submit();
}


