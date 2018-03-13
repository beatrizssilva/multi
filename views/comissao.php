<h1>Comissão</h1>
<?php 
$total = intval($comissao['total'])*8;
echo 'R$ '.number_format($total, 2, ',', '.');
?>












<a href="<?php echo BASE_URL;?>">Voltar</a>