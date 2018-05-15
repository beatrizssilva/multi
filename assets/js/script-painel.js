//Funções do Painel
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
               
                var date = dados.compra.data.split("-");                
                var data = date[2]+"/"+date[1]+"/"+date[0];
                
                var nome = " "+dados.name;
                var email = dados.email;
                var tel = dados.dados.telefone;
                var foto = "<img src='"+BASE_URL+"assets/images/perfil/"+dados.dados.foto_perfil+"' />";
                $("#email").html(email);
                $("#tel").html(tel);
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
            window.setTimeout("location.href='"+BASE_URL+"painel/dados_enderecos'", 3000);
        }
        }
    });
    
}
function fecharComprar(){
    $('#compraSucesso').modal('hide');
    window.setTimeout("location.href='"+BASE_URL+"painel/nova_compra'", 3000);
}

function editEndereco(){
    
    var cep = $('input[name=cep]').val();
    var p = pesquisacep(cep);    
    
    
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
        
    function peenchecep(valor) {

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
    function editDados(){
        var date = $("input[name=nasc]").val();
       
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