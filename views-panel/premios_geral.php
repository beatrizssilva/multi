<?php 
if(isset($premios['ativos']) && $premios['ativos'] > 0) {$ativos = $premios['ativos']*8;}  else { $ativos = 0;}
if(isset($premios['indicados']) && $premios['indicados'] > 0) {$indicados = $premios['indicados']*8;}  else { $indicados = 0;}
if(isset($dadosUser['patent']) && $dadosUser['patent'] > 1) {$lideranca = $premios['com_lider'];}  else { $lideranca = 0;}
$bruto = $lideranca+$indicados+$ativos;
if(isset($premios['inss']) && $premios['inss'] > 0) {$inss = $premios['inss']*8;}  else { $inss = 0;}
if(isset($premios['ir']) && $premios['ir'] > 0) {$ir = $premios['ir']*8;}  else { $ir = 0;}
$liquido = $bruto - $inss - $ir;
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
               value="<?php echo 'R$ '.number_format($indicados, 2, ',', '.');?>"></td>                    
        </tr>
        <tr>
            <td>Total Prêmio por Ativação:</td>
            <td colspan="2"><input type="text" class="form-control" id="credito" name="ativacao" 
                       value="<?php echo 'R$ '.number_format($ativos, 2, ',', '.');?>"></td>                    
        </tr>
        <tr>
            <td>Total Prêmio de Liderança:</td>
            <td colspan="2"><input type="text" class="form-control" id="credito" name="lideranca" 
                       value="<?php echo 'R$ '.number_format($lideranca, 2, ',', '.');?>"></td>                    
        </tr>
        <tr>
            <td>Total Bruto:</td>
            <td colspan="2"><input type="email" class="form-control" id="total" name="totalBruto" 
                       value="<?php echo 'R$ '.number_format($bruto, 2, ',', '.');?>"></td>                    
        </tr>
        <tr>
            <td>INSS:</td>
            <td colspan="2"><input type="text" class="form-control" id="debito" name="INSS" 
                       value="<?php echo 'R$ '.number_format($inss, 2, ',', '.');?>"></td>                    
        </tr>
        <tr>
            <td>IR:</td>
            <td colspan="2"><input type="text" class="form-control" id="debito" name="IR" 
                       value="<?php echo 'R$ '.number_format($ir, 2, ',', '.');?>"></td>                    
        </tr>
        <tr>
            <td>Total Líquido:</td>
            <td colspan="2"><input type="text" class="form-control" id="total" name="totalLiquido" 
                       value="<?php echo 'R$ '.number_format($liquido, 2, ',', '.');?>"></td>                    
        </tr>
    </tbody>
</table>

