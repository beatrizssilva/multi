<?php 
ob_start();
?>
3000100070025382<?php echo "\r\n"; ?>
3000100070000900<?php echo "\r\n"; ?>
            
<?php
$html = ob_get_contents();
ob_end_clean();
        $name = 'pagamento'.date('dmyhis').'.txt';
       
        $fp = fopen($name, "a");
        
        $escreve = fwrite($fp, $html);
        
        fclose($fp);
      