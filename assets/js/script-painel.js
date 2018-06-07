//compartilhar do Facebook
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.0&appId=2240821226131897&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

//Funções do Painel

//Função Autocomplete Cadastro Conta Bancária
$(function(){
    $('#banco').on('keyup', function(){
       var texto = $(this).val();
       if (texto !== ''){
           document.querySelector(".modalBancos").style.display = 'block';
       $.ajax({
            type:'POST',
            url:BASE_URL+"usuarios/bancos",
            data:{                
                 texto:texto           
             },
             dataType:'json',
            success:function(json){            
                var html = '';
                for(var i in json){
                    html += '<li onclick="selecionarBanco('+"'"+json[i].banco+"'"+', '+json[i].id+')">'+json[i].banco+'</li>';
                }
                $('#bancos').html(html);
            }
         });
     } else {
         $('#bancos').html('');
         document.querySelector(".modalBancos").style.display = 'none';
     }
    });
});
function selecionarBanco(banco, id){
    document.getElementById('banco1').value = banco;
    document.getElementById('id_banco').value = id;
    document.getElementById('banco').value = '';
    document.querySelector(".modalBancos").style.display = 'none';
    $('#bancos').html('');
}
function novaConta(){    
    document.getElementById('banco').value = '';
    document.getElementById('id_banco').value = '';
    document.querySelector(".modalBancos").style.display = 'none';
    document.getElementById('banco1').value = '';
    $('#bancos').html('');
    $('#cadastrarConta').modal('show');
}
function salvarConta(){
    var id_banco = $('input[name=id_banco]').val();
    var agencia = $('input[name=agencia]').val();
    var conta = $('input[name=conta]').val();
    var digito = $('input[name=digito]').val();
    var tipo = $('select[name=tipo]').val();
   if(id_banco === '' || agencia === '' || conta === '' || digito === '' || tipo === ''){
       $('#camposobrigatorios').modal('show');
   } else {
//       alert("ID: "+id_banco+" Agencia: "+agencia+" Conta: "+conta+" Digito: "+digito+" Tipo: "+tipo);
//       exit;
        $.ajax({
            type:'POST',
            url:BASE_URL+"usuarios/addContaBancaria",
            data:{                
                 id_banco:id_banco,
                 agencia:agencia,
                 conta:conta,
                 digito:digito,
                 tipo:tipo
             },
            success:function(){            
                $('#CadastroSucesso').modal('show');
                var url = document.URL;
                var r = url.split("/");
                r.reverse();             
                window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",3000); 

            }
         });
    }
}
function excluirContaBancaria(id){
    $.ajax({
        type:'POST',
        url:BASE_URL+"usuarios/dellContaBancaria",
        data:{                
             id:id            
         },
        success:function(){            
            $('#excluidoSucesso').modal('show');
            var url = document.URL;
            var r = url.split("/");
            r.reverse();             
            window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",3000); 
         
        }
     });
}

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
            var url = document.URL;
            var r = url.split("/");
            r.reverse();             
            window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",3000); 
         
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
            var url = document.URL;
            var r = url.split("/");
            r.reverse();             
            window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",3000); 
         
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
    $("#pesquisaMSG").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#table-mensagens tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
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
                document.getElementById('id_user').value = dados.id;
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
                var cidade = dados.dados.cidade;
                var id_user = dados.identificador;
                var email = dados.email;
                var tel = dados.dados.telefone;
                var foto = "<img src='"+BASE_URL+"assets/images/perfil/"+dados.dados.foto_perfil+"' />";
                $("#email2").html(email);
                $("#tel2").html(tel);
                $("#cidade2").html(cidade);
                $("#id2").html(id_user);
                $("#nome2").html(nome);
                $("#data2").html(data);
                $(".foto-afiliados2").html(foto);
                document.getElementById('id_user2').value = dados.id;
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
                    var url = document.URL;
                    var r = url.split("/");
                    r.reverse();             
                    window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",3000); 
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
                var url = document.URL;
                var r = url.split("/");
                r.reverse();             
                window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",3000); 

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
                    var url = document.URL;
                    var r = url.split("/");
                    r.reverse();             
                    window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",2000); 
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
                    var url = document.URL;
                    var r = url.split("/");
                    r.reverse();             
                    window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",3000); 
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
                            var url = document.URL;
                            var r = url.split("/");
                            r.reverse();             
                            window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",3000); 
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
                                        var url = document.URL;
                                        var r = url.split("/");
                                        r.reverse();             
                                        window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",3000); 
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
                            var url = document.URL;
                            var r = url.split("/");
                            r.reverse();             
                            window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",3000); 
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
                                        var url = document.URL;
                                        var r = url.split("/");
                                        r.reverse();             
                                        window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",3000); 
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
            url:BASE_URL+"painel/setQTMensagens",
            type:'POST',
            dataType:'json',
            success:function(json) {

                if(json > 0) {
                    $('.mensage-qt').html(json);
                    $.ajax({
                        url:BASE_URL+"painel/setMensagens/",
                        type:'POST',                           
                        dataType:'json',
                        success:function(res) {
                            var html = ' ';
                                var x;
                                for (x in res) {
                                    var date = res[x].data.split(" ");
                                    var data = date[0].split("-");
                                    var autor = res[x].autor.split(" ");
                                    html += '<li><a href="'+BASE_URL+'painel/mensagens"><i class="fas fa-envelope"></i><span>'+data[2]+'/'+data[1]+'/'+data[0]+'</span>\n\
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
            url:BASE_URL+"painel/setQTNotificacoes",
            type:'POST',
            dataType:'json',
            success:function(json) {

                if(json > 0) {
                    $('.notificacoes-qt').html(json);
                    $.ajax({
                        url:BASE_URL+"painel/setNotificacoes/",
                        type:'POST',                           
                        dataType:'json',
                        success:function(res) {
                            var html = ' ';
                                var x;
                                for (x in res) {
                                    var date = res[x].data.split(" ");
                                    var data = date[0].split("-"); 
                                    if(res[x].tipo === '1'){
                                        html += '<li><a href="'+BASE_URL+'painel/notificacoes"><i class="fas fa-user-plus"></i><span>'+data[2]+'/'+data[1]+'/'+data[0]+'</span>\n\
                                        <p>'+res[x].nome_tipo+' em Sua Rede.</p></a></li>';
                                        $(".not-info").html(html);
                                    } else if(res[x].tipo === '2'){
                                        html += '<li><a href="'+BASE_URL+'painel/notificacoes"><i class="fas fa-cart-plus"></i><span>'+data[2]+'/'+data[1]+'/'+data[0]+'</span>\n\
                                        <p>'+res[x].nome_tipo+' em Sua Rede.</p></a></li>';
                                        $(".not-info").html(html);                                    
                                    }
                                }                           
                        }
                    });
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
   
function mensagem(){
    var id = $('input[id=id_user]').val();
        $.ajax({
             url:BASE_URL+"usuarios/setDadosUsuario",
             type:'POST',
             data:{  
                 id:id
             },
             dataType:'json',
             success:function(res) {
                 var nome = res.name;
                 $("#msg_para").html(nome);  
                 document.getElementById('id_para').value = res.id; 
                 $('#mensagem').modal('show');
             }, error:function(){
                 alert("erro");
             }
         });
    
}
function fecharMensagemAfiliados(){
    $('#mensagem').modal('hide');
    $('#vejaMais').modal('hide');
    var url = document.URL;
    var r = url.split("/");
    r.reverse();             
    window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",1000);
}
function enviarMensagemAfiliados(){
    var id_de = $('input[name=de]').val();
    var id_para = $('input[name=id_para]').val();
    var msg = $('textarea[name=mensagem]').val();
    $.ajax({
        url:BASE_URL+"painel/addMensagem",
        type:'POST',
        data:{  
            id_de:id_de,
            id_para:id_para,
            msg:msg
        },
        success:function() {
            $('#mensagemEnviada').modal('show');            
            var url = document.URL;
            var r = url.split("/");
            r.reverse();             
            window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",2000); 
        }
    });
}
function mensagem2(){
    var id = $('input[id=id_user2]').val();
        $.ajax({
             url:BASE_URL+"usuarios/setDadosUsuario",
             type:'POST',
             data:{  
                 id:id
             },
             dataType:'json',
             success:function(res) {
                 var nome = res.name;
                 $("#msg_para2").html(nome);  
                 document.getElementById('id_para2').value = res.id; 
                 $('#mensagem2').modal('show');
             }, error:function(){
                 alert("erro");
             }
         });
    
}
function fecharMensagemAfiliados2(){
    $('#mensagem2').modal('hide');
    $('#vejaMais2').modal('hide');
    window.setTimeout("location.href='"+BASE_URL+"painel/afiliados'",1000); 
}
function enviarMensagemAfiliados2(){
    var id_de = $('input[name=de2]').val();
    var id_para = $('input[name=id_para2]').val();
    var msg = $('textarea[name=mensagem2]').val();
    $.ajax({
        url:BASE_URL+"painel/addMensagem",
        type:'POST',
        data:{  
            id_de:id_de,
            id_para:id_para,
            msg:msg
        },
        success:function() {
            $('#mensagemEnviada').modal('show');
            var url = document.URL;
            var r = url.split("/");
            r.reverse();             
            window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",2000); 
        }
    });
}
function responderMensagem(id, de){   
    
    $.ajax({
        url:BASE_URL+"usuarios/setDadosUsuario",
        type:'POST',
        data:{  
            id:id
        },
        dataType:'json',
        success:function(res) {
            var nome = res.name;
            $("#para").html(nome);  
            document.getElementById('de').value = de; 
            document.getElementById('id_para').value = res.id; 
            $('#mensagem').modal('show');
        }, error:function(){
            alert("erro");
        }
    });
    
}
function enviarMensagem(){
    var id_de = $('input[name=de]').val();
    var id_para = $('input[name=id_para]').val();
    var msg = $('textarea[name=mensagem]').val();
    $.ajax({
        url:BASE_URL+"painel/addMensagem",
        type:'POST',
        data:{  
            id_de:id_de,
            id_para:id_para,
            msg:msg
        },
        success:function() {
            $('#mensagemEnviada').modal('hide');
            var url = document.URL;
            var r = url.split("/");
            r.reverse();             
            window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",1000);
        }
    });
}

function abrirMsg(id){
    $.ajax({
        url:BASE_URL+"painel/abrirMensagem",
        type:'POST',
        data:{  
            id:id            
        },
        dataType:'json',
        success:function(res) {
           
            var nome = res.de;
            $("#msg_de").html(nome); 
            document.getElementById('de').value = res.id_user_para; 
            document.getElementById('id_para').value = res.id_user_de;
            document.getElementById('abrir_mensagem').value = res.mensagem; 
            $('#abrirMensagem').modal('show');
            
        }
    });
}
function abrirMsgEnviada(id){
    $.ajax({
        url:BASE_URL+"painel/abrirMensagem",
        type:'POST',
        data:{  
            id:id            
        },
        dataType:'json',
        success:function(res) {
            
            var nome = res.para;
            $("#msg_para").html(nome); 
            document.getElementById('abrir_mensagem_enviada').value = res.mensagem; 
            $('#abrirMensagemEnviada').modal('show');
            
        }
    });
}
function fecharMensagem(){
    $('#abrirMensagem').modal('hide');
    var url = document.URL;
    var r = url.split("/");
    r.reverse();             
    window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",1000); 
}
function excluirMensagemRecebida(id){   
    
    document.getElementById('idmsg').value = id;   
    $('#excluirMensagemRecebida').modal('show');
}
function dellMensagemRecebida(){   
    var id = $('input[name=idmsg]').val();
    
    $.ajax({
        url:BASE_URL+"painel/apagarMensagemRecebida",
        type:'POST',
        data:{  
            id:id                    
        },
        success:function() {
            $('#excluirMensagem').modal('hide');
            var url = document.URL;
            var r = url.split("/");
            r.reverse();             
            window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",1000);
        }
    });
}
function excluirMensagemEnviada(id){   
 
    document.getElementById('idmsg').value = id;   
    $('#excluirMensagemEnviada').modal('show');
}
function dellMensagemEnviada(){   
    var id = $('input[name=idmsg]').val();
    
    $.ajax({
        url:BASE_URL+"painel/apagarMensagemEnviada",
        type:'POST',
        data:{  
            id:id                    
        },
        success:function() {
            $('#excluirMensagemEnviada').modal('hide');
            var url = document.URL;
            var r = url.split("/");
            r.reverse();             
            window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",1000);
        }
    });
}
function excluirNotificacao(id){   
    
    document.getElementById('idnot').value = id;   
    $('#excluirNotificacao').modal('show');
}
function dellNotificacao(){   
    var id = $('input[name=idnot]').val();
    
    $.ajax({
        url:BASE_URL+"painel/apagarNotificacao",
        type:'POST',
        data:{  
            id:id                    
        },
        success:function() {
            $('#excluirNotificacao').modal('hide');
            var url = document.URL;
            var r = url.split("/");
            r.reverse();             
            window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",1000);
        }
    });
}
function abrirNotificacao(id){
  
    $.ajax({
        url:BASE_URL+"painel/abrirNotificacao",
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
            document.getElementById('id_user').value = dados.id;
            $('#abrirNotificacao').modal('show'); 

        }, error:function(){alert("ERRO");}
    });
}
function fecharNotificacao(){    
    $('#abrirNotificacao').modal('hide');
    var url = document.URL;
    var r = url.split("/");
    r.reverse();             
    window.setTimeout("location.href='"+BASE_URL+r[1]+"/"+r[0]+"'",1000);
}