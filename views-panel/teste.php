<?php
//
//require 'phpsqliteconnect/vendor/autoload.php';
//
//use App\SQLiteConnection;
// 
//$pdo = (new SQLiteConnection())->connect();
//if ($pdo != null)
//    echo 'Connected to the SQLite database successfully!';
//else
//    echo 'Whoops, could not connect to the SQLite database!';

//shell_exec("curl -X POST  https://rest.nexmo.com/sms/json \
//-d api_key=ee0fac2a \
//-d api_secret=c0XMIutFfeC242rn \
//-d to=5535987072261 \
//-d from='NEXMO' \
//-d text='Hello from Nexmo'");

?><script>
    $(function(){
	setInterval(whatsapp, 10000);
	whatsapp();

        });
    function whatsapp() {
$.ajax({
    url:BASE_URL+"teste/testeWhatsJS/",
    type:'POST',                           
    dataType:'json',
    success:function(res) {
        console.log("OK");

    }
});
}
</script>
<h3>TEste Whatsapp</h3>
<div class="msg-whats"></div>