<?php 
echo '<ol style="list-style:none;">';
$l = 1;
        foreach ($filho as $usuario){
            
            if (isset($c) && $c == 1){    
            }else {
                echo '<hr><strong style="font-size:18px;">Linha: '.$l.'</strong>';
            }
            if ($usuario['ativo'] == 0): ?>
<li style="color:#AAA">

    
            <?php else: ?>
    <li style="color:blue">
  
        <?php endif; ?>
    <?php echo '<strong>'.$g.'ª Geração - </strong>'.$usuario['name'].' (<strong>'.utf8_encode($usuario['patente']).'</strong>)';
    if ($usuario['ativo'] == 0){
        echo ' - <strong>INATIVO.</strong>';
        echo '</li>';
    } else {
        echo ' - <strong>ATIVO.</strong>';
        echo '</li>';
    }
        
            if(count($usuario['filhos']) > 0) {
                $this->loadViewPanel('filhos1',array('filho' => $usuario['filhos'], 'c' => 1, 'g' => $g+1));
            }
            echo '</li>';
            $l++;
        }
        
echo '</ol>';
