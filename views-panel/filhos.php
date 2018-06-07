<?php

foreach ($filho as $usuario): 
    $nome1 = explode(' ', $usuario['name']); 
    $nome2 = strtolower($nome1[0]);
    $nome = ucfirst($nome2);
    switch ($usuario['patent']){
        case '1':
            $patent = 'Consumidor Pré';
            break;
        case '2':
            $patent = 'Consumidor Bronze';
            break;
        case '3':
            $patent = 'Consumidor Prata';
            break;
        case '4':
            $patent = 'Consumidor Ouro';
            break;
        case '5':
            $patent = 'Consumidor Rubi';
            break;
        case '6':
            $patent = 'Diamante';
            break;
        case '7':
            $patent = 'Duplo Diamante';
            break;
    }?>
    <ol id="ol-filhos">
            <?php if ($usuario['ativo'] == 0): ?>
                <li style="color:#696969">    
            <?php else: ?>
                <li style="color:#008000">  
            <?php endif; ?>
            <?php echo '<span id="linha-filhos"></span>'.utf8_encode($nome).' ('.$patent.')';?>
                    <span class="abrir-sobre" id="afiliados-sobre" onclick="abrirModalPerfil2(<?php echo $usuario['id'];?>)" data-toggle="tooltip" data-placement="right" title="Veja Mais!"> 
                        <i class="fas fa-eye"></i></span> </li>           
        <?php
            if(count($usuario['filhos']) > 0) {
                $this->loadViewPanel('filhos',array('filho' => $usuario['filhos']));
            }
    ?></ol><?php        
endforeach;?>
            

