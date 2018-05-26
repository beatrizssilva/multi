//compartilhar do Facebook
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.0&appId=2240821226131897&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

//Funções do Painel
function novoDependente(){
    $('#cadastroDependente').modal('show');
}

function excluirDependente(id){
    $.ajax({
        type:'POST',
        url:BASE_URL+"usuarios/dellDependente",
        data:{                
             id:id            
         },
        success:function(){            
            $('#excluidoSucesso').modal('show');
            window.setTimeout("location.href='"+BASE_URL+"painel/dados_dependentes'",3000); 
         
        }
     });
}

function cancelarConta() {
    $('#cancelarConta').modal('show');
}
function cancelamentoConta(id){
    $.ajax({
        type:'POST',
        url:BASE_URL+"usuarios/cancelarConta",
        data:{                
             id:id            
         },
        success:function(){            
            $('#contaExcluidaSucesso').modal('show');
            window.setTimeout("location.href='"+BASE_URL+"'",3000); 
         
        }
     });
}

function salvarDependente(){
    var relacao = $('select[name=relacao]').val();
    var nome = $('input[name=nome]').val();
    var nasc = $('input[name=nasc]').val();
    var documento = $('input[name=documento]').val();
   
    $.ajax({
        type:'POST',
        url:BASE_URL+"usuarios/addDependente",
        data:{                
             nome:nome,
             relacao:relacao,
             nasc:nasc,
             documento:documento             
         },
        success:function(){            
            $('#CadastroSucesso').modal('show');
            window.setTimeout("location.href='"+BASE_URL+"painel/dados_dependentes'",3000); 
         
        }
     });
}
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
function abrirModalPerfil(id) {
    
    $.ajax({
            url:BASE_URL+"usuarios/dadosAfiliados",
            type:'POST',
            data:{                
                id:id
            },
            dataType:'json',
            success:function(dados) {
                var date3 = dados.compra.data.split(" "); 
               
                var date = date3[0].split("-");                
                var data = date[2]+"/"+date[1]+"/"+date[0];
                
                var nome = " "+dados.name;
                var cidade = dados.dados.cidade;
                var id_user = dados.identificador;
                var email = dados.email;
                var tel = dados.dados.telefone;
                var foto = "<img src='"+BASE_URL+"assets/images/perfil/"+dados.dados.foto_perfil+"' />";
                $("#email").html(email);
                $("#tel").html(tel);
                $("#cidade").html(cidade);
                $("#id").html(id_user);
                $("#nome").html(nome);
                $("#data").html(data);
                $(".foto-afiliados").html(foto);
                $('#vejaMais').modal('show'); 
                 
            }
        });
    
}
function abrirModalPerfil2(id) {
    $.ajax({
            url:BASE_URL+"usuarios/dadosAfiliados",
            type:'POST',
            data:{                
                id:id
            },
            dataType:'json',
            success:function(dados) {
              
                var date = dados.compra.data.split("-");                
                var data = date[2]+"/"+date[1]+"/"+date[0];
                
                var nome = " "+dados.name;
                var email = dados.email;
                var tel = dados.dados.telefone;
                var foto = "<img src='"+BASE_URL+"assets/images/perfil/"+dados.dados.foto_perfil+"' />";
                $("#email2").html(email);
                $("#tel2").html(tel);
                $("#nome2").html(nome);
                $("#data2").html(data);
                $(".foto-afiliados2").html(foto);
                $('#vejaMais2').modal('show'); 
                 
            }
        });    
}
function edit_foto(){
    $('#editFoto').modal('show'); 
}
function previewImagem(){
    
    var imagem = document.querySelector('input[name=imagemPerfil').files[0];
    var preview = document.querySelector('img[name=fotoPerfil]');
    var reader = new FileReader();
    reader.onloadend = function() {        
        preview.src = reader.result;
    }
    if(imagem){
        reader.readAsDataURL(imagem);
    }else {
        preview.src = "";
    }
}
function editarFotoPerfil(){
    var nome = $('input[name=idPerfil]').val();
    var id = $('input[name=namePerfil]').val();
    var imagem = $('#imagemPerfil')[0].files;
       
        $.ajax({
           type:'POST',
           url:BASE_URL+"usuarios/editFoto",
           data:{                
                nome:nome,
                id:id,
                imagem:imagem
            },
           success:function(msg){
               alert(msg);
           }
        });
}
function enviarConvite(){
    
    if ($('input[name="nome"]').val() <= 0 || $('input[name="email"]').val() <= 0){
        $('#camposobrigatorios').modal('show');
    } else {
        var nome = $('input[name=nome]').val();
        var email = $('input[name=email]').val();
        var identificador = $('input[name=identificador]').val();
        var name = $('input[name=name]').val();
        
        $.ajax({
            url:BASE_URL+"usuarios/convite",
            type:'POST',
            data:{                
                nome:nome,
                email:email,
                identificador:identificador,
                name:name
            },
            success:function(res) {
               
                if (res === '1') {
                    $('#conviteSucesso').modal('show');
                    window.setTimeout("location.href='"+BASE_URL+"painel/convidar'",3000); 
                } 
            }
        });
    }
}
function excluirConvite(convite){
   
    $.ajax({
        url:BASE_URL+"usuarios/apagarConvite",
        type:'POST',
        data:{                
            convite:convite
        },
        success:function() {             

                $('#excluidoSucesso').modal('show');
                window.setTimeout("location.href='"+BASE_URL+"painel/convidar'",3000); 

        }
    });
}

function comprar(){
    var resgatado = $('input[name=resgatado]').val();
    var valor = $('input[name=valor]').val();
    var qtde = $('input[name=name]').val();
    var id = $('input[name=id]').val();

    $.ajax({
        url:BASE_URL+"usuarios/verifyEndereco",
        type:'POST',
        data:{  
            id:id
        },
        dataType:'json',
        success:function(res) {    
            
        if(res > 0){
            $.ajax({
                url:BASE_URL+"transacoes/comprar",
                type:'POST',
                data:{  
                    qtde:qtde,
                    valor:valor,
                    resgatado:resgatado
                },
                dataType:'json',
                success:function(res) {

                    var protocolo = res;                
                    $("#protocolo").html(protocolo);
                    document.getElementById('seuNumero').value = protocolo;
                    $('#compraSucesso').modal('show');
                }
            });
        } else {
            $('#enderecoInvalido').modal('show');
//            window.setTimeout("location.href='"+BASE_URL+"painel/dados_enderecos'", 3000);
        }
        }
    });
    
}
function fecharComprar(){
    $('#compraSucesso').modal('hide');
    window.setTimeout("location.href='"+BASE_URL+"'", 3000);
}

function editEndereco(){
    
    var cep = $('input[name=cep]').val();
    
    var p = pesquisacep(cep);    
    
    
}
function editEnderecoComprar(){
    
    var cep = $('input[name=cepComprar]').val();    
    var p = pesquisacepComprar(cep);    
}
function pesquisacepComprar(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                
                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback_comprar';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.

                $('#CEPInvalido').modal('show');
                exit;
            }
        } //end if.
        else {
            //cep sem valor.

            $('#CEPInvalido').modal('show');
            exit;
        }
    };
function meu_callback_comprar(conteudo) {
       
        if (!("erro" in conteudo)) {
            var rua = $('input[name=ruaComprar]').val();
            var numero = $('input[name=numeroComprar]').val();
            var complemento = $('input[name=complementoComprar]').val();
            var bairro = $('input[name=bairroComprar]').val();
            var cidade = $('input[name=cidadeComprar]').val();
            var uf = $('input[name=ufComprar]').val();
            var cep = $('input[name=cepComprar]').val();
            $.ajax({
                url:BASE_URL+"usuarios/setEndereco",
                type:'POST',
                data:{  
                    cep:cep,
                    rua:rua,
                    numero:numero,
                    complemento:complemento,
                    bairro:bairro,
                    cidade:cidade,
                    uf:uf
                },
                success:function() {
                   
                    $('#enderecoSucesso').modal('show');
                    window.setTimeout("location.href='"+BASE_URL+"painel/nova_compra'",2000); 
                },error:function(){
                    alert('Erro');
                }
            });
              
        } //end if.
        else {
            //CEP não Encontrado.
            $('#CEPInvalido').modal('show');
            exit;
        }
       
    }
function prenchecepComprar(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback2_comprar';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                $('#CEPInvalido').modal('show');
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            $('#CEPInvalido').modal('show');
        }
    }  
function meu_callback2_comprar(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            
            document.getElementById('ruaComprar').value=(conteudo.logradouro);
            document.getElementById('bairroComprar').value=(conteudo.bairro);            
            document.getElementById('cidadeComprar').value=(conteudo.localidade);
            document.getElementById('ufComprar').value=(conteudo.uf);
           
            document.getElementById('ibge').value=(conteudo.ibge);
              
        } //end if.
        else {
            //CEP não Encontrado.
            alert("CEP não encontrado.");
        }
       
    }
    
//Preenchimento Endereço Automático pelo CEP - Webservice ViaCEP dos correios 
    function meu_callback(conteudo) {
       
        if (!("erro" in conteudo)) {
            var rua = $('input[name=rua]').val();
            var numero = $('input[name=numero]').val();
            var complemento = $('input[name=complemento]').val();
            var bairro = $('input[name=bairro]').val();
            var cidade = $('input[name=cidade]').val();
            var uf = $('input[name=uf]').val();
            var cep = $('input[name=cep]').val();
            $.ajax({
                url:BASE_URL+"usuarios/setEndereco",
                type:'POST',
                data:{  
                    cep:cep,
                    rua:rua,
                    numero:numero,
                    complemento:complemento,
                    bairro:bairro,
                    cidade:cidade,
                    uf:uf
                },
                success:function() {
                   
                    $('#enderecoSucesso').modal('show');
                    window.setTimeout("location.href='"+BASE_URL+"painel/dados_enderecos'",3000); 
                },error:function(){
                    alert('Erro');
                }
            });
              
        } //end if.
        else {
            //CEP não Encontrado.
            $('#CEPInvalido').modal('show');
            exit;
        }
       
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                
                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.

                $('#CEPInvalido').modal('show');
                exit;
            }
        } //end if.
        else {
            //cep sem valor.

            $('#CEPInvalido').modal('show');
            exit;
        }
    };
function meu_callback2(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);            
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
           
            document.getElementById('ibge').value=(conteudo.ibge);
              
        } //end if.
        else {
            //CEP não Encontrado.
            alert("CEP não encontrado.");
        }
       
    }
        
    function prenchecep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback2';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                $('#CEPInvalido').modal('show');
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            $('#CEPInvalido').modal('show');
        }
    };
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
    function editDados(email2, senha3){
          
        var nome = $("input[name=nome]").val();
        var tel = $("input[name=tel]").val();
        var pis = $("input[name=pis]").val();
        var rg = $("input[name=rg]").val();
        var date = $("input[name=nasc]").val();
        var email = $("input[name=email]").val();
        var senha = $("input[name=senha]").val();
        var senha2 = $("input[name=senha2]").val();
        
        var forca = 0;

        if(senha.length>5){
            forca +=25;
        }
        var reg = new RegExp(/[0-9]/i);
        if(reg.test(senha)){
            forca += 25;
        }
        var reg = new RegExp(/[a-z]/i);
        if(reg.test(senha)){
            forca += 25;
        }
        var reg = new RegExp(/[^a-z0-9]/i);
        if(reg.test(senha)){
            forca += 25;
        }
        if(forca>=75){
        
        if (senha3 != senha || senha3 != senha2){
            if (senha === '' || senha <= 0 || senha2 === '' || senha2 <= 0){
                $('#senhaserradas').modal('show');
            }else if(senha === senha2) {
                if(email === email2) {
                    $.ajax({
                        url:BASE_URL+"usuarios/setDados",
                        type:'POST',
                        data:{  
                            date:date,
                            nome:nome,
                            email:email,
                            tel:tel,
                            pis:pis,
                            rg:rg,
                            senha:senha
                        },
                        success:function() {
                            $('#dadosSucesso').modal('show');
                            window.setTimeout("location.href='"+BASE_URL+"painel/dados_pessoais'",3000); 
                        }
                    });
                } else {
                    $.ajax({                        
                        url:BASE_URL+"usuarios/pesquisarEmail/"+email2,
                        type:'POST',
                        success:function(msg3) {	
                            if (msg3 === '1' ){
                                $('#emailjacadastrado').modal('show');                                  
                            } else {
                                $.ajax({
                                    url:BASE_URL+"usuarios/setDados",
                                    type:'POST',
                                    data:{  
                                        date:date                    
                                    },
                                    success:function() {
                                        $('#dadosSucesso').modal('show');
                                        window.setTimeout("location.href='"+BASE_URL+"painel/dados_pessoais'",3000); 
                                    }
                                });
                            }
                        }
                    });
                }
            } else {
                $('#senhaserradas').modal('show'); 
            }
        } else if(senha === senha2) {
                if(email === email2) {
                    $.ajax({
                        url:BASE_URL+"usuarios/setDados",
                        type:'POST',
                        data:{  
                            date:date,
                            nome:nome,
                            email:email,
                            tel:tel,
                            pis:pis,
                            rg:rg,
                            senha:senha
                        },
                        success:function() {
                            $('#dadosSucesso').modal('show');
                            window.setTimeout("location.href='"+BASE_URL+"painel/dados_pessoais'",3000); 
                        }
                    });
                } else {
                    $.ajax({                        
                        url:BASE_URL+"usuarios/pesquisarEmail/"+email2,
                        type:'POST',
                        success:function(msg3) {	
                            if (msg3 === '1' ){
                                $('#emailjacadastrado').modal('show');                                  
                            } else {
                                $.ajax({
                                    url:BASE_URL+"usuarios/setDados",
                                    type:'POST',
                                    data:{  
                                        date:date                    
                                    },
                                    success:function() {
                                        $('#dadosSucesso').modal('show');
                                        window.setTimeout("location.href='"+BASE_URL+"painel/dados_pessoais'",3000); 
                                    }
                                });
                            }
                        }
                    });
                }
            } else {
                $('#senhaserradas').modal('show'); 
            }
        } else {
            $('#SenhaFraca').modal('show');
        }
    }
    function verificarNotificacao() {

	$.ajax({
            url:BASE_URL+"painel/setMensagens",
            type:'POST',
            dataType:'json',
            success:function(json) {

                if(json > 0) {
                    $('.mensage-qt').html(json);
                    $.ajax({
                        url:BASE_URL+"painel/mensagens",
                        type:'POST',                           
                        dataType:'json',
                        success:function(res) {
                            var html = ' ';
                            var x;
                            for (x in res) {
                                var date = res[x].data.split(" ");
                                var data = date[0].split("-");
                                var autor = res[x].autor.split(" ");
                                html += '<li><a href="#"><i class="fas fa-envelope"></i><span>'+data[2]+'/'+data[1]+'/'+data[0]+'</span>\n\
                                <p>Você Recebeu uma Mensagem de '+autor[0]+'.</p></a></li>';
                                $(".msg-info").html(html);
                            }
                        }
                    });
                } else {			
                    $('.mensage-qt').html('0');
                }
            }
	});
        $.ajax({
            url:BASE_URL+"painel/setNotificacoes",
            type:'POST',
            dataType:'json',
            success:function(json) {

                if(json > 0) {
                    $('.notificacoes-qt').html(json);
                } else {			
                    $('.notificacoes-qt').html('0');
                }
            }
	});

}
    
    $(function(){
	setInterval(verificarNotificacao, 10000);
	verificarNotificacao();

//	$('.mensage-qt').on('click', function(){
//
//	});
//
//	$('.addNotif').on('click', function(){
//		$.ajax({
//			url:'add.php'
//		});
//	});
        });
        