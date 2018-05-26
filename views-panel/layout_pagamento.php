<?php 
//3 = Fixo
//000001 = numero de cadastro
//0007 = numero da contabilidade
//0000000 = valor (tamanho 7 com 2 casas decimais)
ob_start();
?>
300000100070025382<?php echo "\r\n"; ?>
300000100070000900<?php echo "\r\n"; ?>
            
<?php
$html = ob_get_contents();
ob_end_clean();
    $name = 'arquivos/pagamento'.date('dmyhis').'.txt';

    $fp = fopen($name, "a");

    $escreve = fwrite($fp, $html);

    fclose($fp);
      