function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}

//força de senha
$(function(){
    $('#senha').bind('keyup', function(){
        var txt = $(this).val();
        var forca = 0;
        
        if(txt.length>6){
            forca +=25;
        }
        var reg = new RegExp(/[0-9]/i);
        if(reg.test(txt)){
            forca += 25;
        }
        var reg = new RegExp(/[a-z]/i);
        if(reg.test(txt)){
            forca += 25;
        }
        var reg = new RegExp(/[^a-z0-9]/i);
        if(reg.test(txt)){
            forca += 25;
        }
        document.querySelector("#forca").style.width = forca+'%';
    });
});

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
    var txt = $('input[name="senha"]').val();    
    var forca = 0;

    if(txt.length>5){
        forca +=25;
    }
    var reg = new RegExp(/[0-9]/i);
    if(reg.test(txt)){
        forca += 25;
    }
    var reg = new RegExp(/[a-z]/i);
    if(reg.test(txt)){
        forca += 25;
    }
    var reg = new RegExp(/[^a-z0-9]/i);
    if(reg.test(txt)){
        forca += 25;
    }
    if(forca>=75){ 
    
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

                    if(res === '00'){                    
                        $('#codigoInvalido').modal('show');
                    } else {                
                    $('#senhaDefinida').modal('show');            
                    window.setTimeout("location.href='"+BASE_URL+"'",5000); 
                }
                }
             });
        }
    } else {
        $('#SenhaFraca').modal('show');
    }
}
//Funções da Pagina Cadastrar

function cadastrar() {
    if($('input[name="convite"]').val() != 0){
        var convite = $('input[name="convite"]').val();        
    }
    var txt = $('input[name="senha"]').val();    
    var forca = 0;

    if(txt.length>5){
        forca +=25;
    }
    var reg = new RegExp(/[0-9]/i);
    if(reg.test(txt)){
        forca += 25;
    }
    var reg = new RegExp(/[a-z]/i);
    if(reg.test(txt)){
        forca += 25;
    }
    var reg = new RegExp(/[^a-z0-9]/i);
    if(reg.test(txt)){
        forca += 25;
    }
    if(forca>=75){ 
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
    }  else {
    $('#SenhaFraca').modal('show');
}

}

//Cadastrar 2 - quando não há o codigo de convite
function cadastrar2() {
    var txt = $('input[name="senha"]').val();    
    var forca = 0;

    if(txt.length>5){
        forca +=25;
    }
    var reg = new RegExp(/[0-9]/i);
    if(reg.test(txt)){
        forca += 25;
    }
    var reg = new RegExp(/[a-z]/i);
    if(reg.test(txt)){
        forca += 25;
    }
    var reg = new RegExp(/[^a-z0-9]/i);
    if(reg.test(txt)){
        forca += 25;
    }
    if(forca>=75){ 
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
    } else {
        $('#SenhaFraca').modal('show');
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
                    var url = document.URL;
                    var r = url.split("/");
                    r.reverse();         
                    if(r[0] != ''){
                    window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",1000);
                    } else {
                        window.setTimeout("location.href='"+BASE_URL+"'"); 
                    }
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



