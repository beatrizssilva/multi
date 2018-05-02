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
function abrirModalPerfil() {
    $('#vejaMais').modal('show');
}
function enviarConvite(){
    if ($('input[name="nome"]').val() <= 0 || $('input[name="email"]').val() <= 0){
        $('#camposobrigatorios').modal('show');
    } else {
        var nome = $('input[name=nome]').val();
        var email = $('input[name=email]').val();
        
        $.ajax({
            url:BASE_URL+"usuarios/convite",
            type:'POST',
            data:{                
                nome:nome,
                email:email
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

