<?php 
echo '<pre>';
print_r($premios);exit();
if(isset($premios['ativos']) && $premios['ativos'] > 0) {$ativos = $premios['ativos']*8;}  else { $ativos = 0;}
if(isset($premios['indicados']) && $premios['indicados'] > 0) {$indicados = $premios['indicados']*8;}  else { $indicados = 0;}
if(isset($dadosUser['patent']) && $dadosUser['patent'] > 1) {$lideranca = $premios['com_lider'];}  else { $lideranca = 0;}
$bruto = $lideranca+$indicados+$ativos;

//switch ($bruto){
//    case $bruto > 0  && $bruto <= 1903.98:
//        $ir = 0;
//        break;;
//    case $bruto >= 1903.99 && $bruto <= 2826.65:
//        $ir = ($bruto*7.5)/100;
//        break;
//    case $bruto >= 2826.66 && $bruto <= 3751.05:
//        $ir = ($bruto*15)/100;
//        break;
//    case $bruto >= 3751.06 && $bruto <= 4664.68:
//        $ir = ($bruto*22.5)/100;
//        break;
//    case $bruto >= 4664.68:
//        $ir = ($bruto*27.5)/100;
//        break;
//}
//switch ($bruto){
//    case $bruto > 0  && $bruto <= 1693.72:
//        $inss = ($bruto*8)/100;
//        break;
//    case $bruto >= 1693.73 && $bruto <= 2822.90:
//        $inss = ($bruto*9)/100;
//        break;
//    case $bruto >= 2822.91 && $bruto <= 5645.80:
//        $inss = ($bruto*11)/100;
//        break;    
//}
//$liquido = $bruto - $inss - $ir;
?>

<h2>Prêmios Geral (Mês Atual)</h2><br>
<table class="table table-hover" id="premiosGeral">
    <thead>
        <tr>
            <th></th>
            <th></th>                    
        </tr>
    </thead>
    <tbody>               
        <tr>
            <td>Total Prêmio por Indicação:</td>
            <td><input type="text" class="form-control" id="credito" name="indicacao" 
                       value="<?php echo 'R$ '.number_format($indicados, 2, ',', '.');?>" disabled="disabled"></td>                    
        </tr>
        <tr>
            <td>Total Prêmio por Ativação:</td>
            <td colspan="2"><input type="text" class="form-control" id="credito" name="ativacao" 
                       value="<?php echo 'R$ '.number_format($ativos, 2, ',', '.');?>" disabled="disabled"></td>                    
        </tr>
        <tr>
            <td>Total Prêmio de Liderança:</td>
            <td colspan="2"><input type="text" class="form-control" id="credito" name="lideranca" 
                       value="<?php echo 'R$ '.number_format($lideranca, 2, ',', '.');?>" disabled="disabled"></td>                    
        </tr>
        <tr>
            <td>Total Bruto:</td>
            <td colspan="2"><input type="email" class="form-control" id="total" name="totalBruto" 
                       value="<?php echo 'R$ '.number_format($bruto, 2, ',', '.');?>" disabled="disabled"></td>                    
        </tr>
<!--        <tr>
            <td>INSS:</td>
            <td colspan="2"><input type="text" class="form-control" id="debito" name="INSS" 
                       value="<?php echo 'R$ '.number_format($inss, 2, ',', '.');?>" disabled="disabled"></td>                    
        </tr>
        <tr>
            <td>IR:</td>
            <td colspan="2"><input type="text" class="form-control" id="debito" name="IR" 
                       value="<?php echo 'R$ '.number_format($ir, 2, ',', '.');?>" disabled="disabled"></td>                    
        </tr>
        <tr>
            <td>Total Líquido:</td>
            <td colspan="2"><input type="text" class="form-control" id="total" name="totalLiquido" 
                       value="<?php echo 'R$ '.number_format($liquido, 2, ',', '.');?>" disabled="disabled"></td>                    
        </tr>-->
    </tbody>
</table>

