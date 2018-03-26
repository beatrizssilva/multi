<?php

echo '<ol>';
        foreach ($filho as $usuario){
           
            if ($usuario['ativo'] == 0): ?>
<li style="color:red">

    
            <?php else: ?>
    <li>
  
        <?php endif; ?>
    <?php echo $usuario['name'].' (<strong>'.utf8_encode($usuario['patente']).'</strong>)  tem '.count($usuario['filhos']).' cadastros diretos';
    if ($usuario['ativo'] == 0){
        echo ' - <strong>CONSUMIDOR INATIVO.</strong>';
        echo '</li>';
    }
        
            if(count($usuario['filhos']) > 0) {
                $this->loadView('filhos',array('filho' => $usuario['filhos']));
            }
            echo '</li>';
        }
echo '</ol>';
?>






