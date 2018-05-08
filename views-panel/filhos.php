<?php

foreach ($filho as $usuario): ?>
    <ol id="ol-filhos">
            <?php if ($usuario['ativo'] == 0): ?>
                <li style="color:#AAA">    
            <?php else: ?>
                <li style="color:blue">  
            <?php endif; ?>
            <?php echo '<span id="linha-filhos"></span>'.ucfirst($usuario['name']);?>
                    <span class="abrir-sobre" id="afiliados-sobre" onclick="abrirModalPerfil2(<?php echo $usuario['id'];?>)" data-toggle="tooltip" data-placement="right" title="Veja Mais!"> 
                        <i class="fas fa-eye"></i></span> </li>           
        <?php
            if(count($usuario['filhos']) > 0) {
                $this->loadViewPanel('filhos',array('filho' => $usuario['filhos']));
            }
    ?></ol><?php        
endforeach;?>
            

