//Funções do Painel

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

$('.abrir-sobre').on('click', function(){
   $('#vejaMais').modal('show'); 
});
$('#afiliados-sobre2').on('click', function(){
   $('#vejaMais2').modal('show'); 
});