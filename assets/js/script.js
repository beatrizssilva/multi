function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}

//função esqueci minha senha
function esqueci() {
    var cpf = $('input[name=cpf]').val();
    
    $.ajax({
        type:'POST',
        url:BASE_URL+"usuarios/esqueciSenha",
        data:{                
             cpf:cpf            
         },
        success:function(res){            
            if(res === '0'){
                $('#cpfInvalido').modal('show');
            } else {
            var email = 'Email de Recuperação Enviado para: <strong>'+res+'</strong>';
            $("#msg").html(email);
            $('#senhaEnviada').modal('show');            
            window.setTimeout("location.href='"+BASE_URL+"'",5000); 
        }
        }
     });
}
function redefinirSenha(){
    var senha = $('input[name=senha]').val();
    var senha2 = $('input[name=senha2]').val();
    var codigo = $('input[name=codigo]').val();
    
    if(senha <= 0 || senha2 <= 0){
        $('#camposobrigatorios').modal('show');
    } else if(senha != senha2){
        $('#senhaserradas').modal('show');
    } else {
        $.ajax({
            type:'POST',
            url:BASE_URL+"usuarios/redefinirSenha",
            data:{                
                 senha:senha,
                 codigo:codigo
             },
            success:function(res){    
               
                if(res === '0'){
                    $('#codigoInvalido').modal('show');
                } else {                
                $('#senhaDefinida').modal('show');            
                window.setTimeout("location.href='"+BASE_URL+"'",5000); 
            }
            }
         });
    }
}
//Funções da Pagina Cadastrar

function cadastrar() {
    if($('input[name="convite"]').val() != 0){
        var convite = $('input[name="convite"]').val();        
    }
    
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
                                                            url:BASE_URL+"usuarios/pesquisarConvite/"+convite,
                                                            type:'POST',
                                                            success:function(msg3) {	
                                                                if (msg3 === '0' ){
                                                                    $('#conviteinvalido').modal('show');                                  
                                                                } else {
                                                                    $.ajax({
                                                                        url:BASE_URL+"usuarios/cadastrar",
                                                                        type:'POST',
                                                                        data:{
                                                                            id:id,
                                                                            nome:nome,
                                                                            email:email,
                                                                            cpf:cpf,
                                                                            senha:senha,
                                                                            convite:convite
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
                            }
                        }
                    });
                } else {
                   $('#CPFInvalido').modal('show');
                }
            }
        });
    }

}

//Cadastrar 2 - quando não há o codigo de convite
function cadastrar2() {
        
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
                                                                senha:senha,

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

}

//função de login

function login(){
    
    if($('input[name="name"]').val() <= 0 || $('input[name="senha"]').val() <= 0){
        $('#CamposObrigatorios').modal('show');
    } else {
        var nome = $('input[name=name]').val();
        var senha = $('input[name=senha]').val();
        
        $.ajax({
            url:BASE_URL+"usuarios/login",
            type:'POST',
            data:{                
                nome:nome,
                senha:senha
            },

            success:function(res) {
              
                if (res === '1') {                    
                    window.setTimeout("location.href='"+BASE_URL+"'"); 
                } else if(res === '2') {                  
                    $('#contaCancelada').modal('show');
                    window.setTimeout("location.href='"+BASE_URL+"'",3000); 
                } else {
                    $('#loginInvalido').modal('show');
                    window.setTimeout("location.href='"+BASE_URL+"'",3000); 
                }
            }
        });
    }
}



