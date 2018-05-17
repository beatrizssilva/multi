<?php 
$cpf = '55534515155';
$nome = 'Maria Jose da Silva';
$pis = '12344939384';
$nasc = '12021980';
$dep = '1';
$nDep = 'Filho de Maria';
$cpf2 = '27835115506';
$nome2 = 'Jose Maria da Silva';
$pis2 = '12344939384';
$nasc2 = '12021990';
$dep2 = '1';
$nDep2 = 'Filho de Jose';
ob_start();

echo $cpf.'|'.$nome.'|'.$pis.'|'.$nasc.'|'.$dep.'|'.$nDep; echo "\r\n"; 
echo $cpf2.'|'.$nome2.'|'.$pis2.'|'.$nasc2.'|'.$dep2.'|'.$nDep2; echo "\r\n"; ?>
            
<?php
$html = ob_get_contents();
ob_end_clean();
        $name = 'cadastro'.date('dmyhis').'.txt';
       
        $fp = fopen($name, "a");
        
        $escreve = fwrite($fp, $html);
        
        fclose($fp);
      