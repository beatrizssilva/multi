//Funções do Painel

//Script do Grafico
window.onload = function(){
    var contexto = document.getElementById("grafico").getContext("2d");
    var one = 1;
    var two = 2;
    var three = 3;
    var four = 4;
    var five = 5;
    var six = 6;
    var seven = 7;
    var eigth = 8;
    var nine = 9;
    var ten = 10;
    var grafico = new Chart(contexto, {
        type:'bar',
        data: {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 
                'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            datasets: [{
                label:'Indicados',
                backgroundColor:'#3F8CBB',
                borderColor:'#3F8CBB',
                data:[five,four,six,nine,seven,five,four,six,nine,seven, ten, nine],
                fill:false
            }, {
                label:'Ativados',
                backgroundColor:'#9FCFDF',
                borderColor:'#9FCFDF',
                data:[three,six,eigth,four,six, three,two,eigth,four,six, ten, seven],
                fill:false
            }]
        }
    });
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
   alert(convite);
//    $.ajax({
//        url:BASE_URL+"usuarios/apagarConvite",
//        type:'POST',
//        data:{                
//            convite:convite
//        },
//        success:function() {             
//
//                $('#excluidoSucesso').modal('show');
//                window.setTimeout("location.href='"+BASE_URL+"painel/convidar'",3000); 
//
//        }
//    });
}
function editarFotoPerfil(){
    var nome = $('input[name=idPerfil]').val();
    var id = $('input[name=namePerfil]').val();
    var imagem = $('#imagemPerfil')[0].files;
//    var data = new FormData();
//    var imagem = $('#imagemPerfil')[0].files;
//    
//    if(imagem.length > 0){
//        data.append('name', $('#namePerfil').val());
//        data.append('id', $('#idPerfil').val());
//        data.append('foto', imagem[0]);
        
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
//}
}

