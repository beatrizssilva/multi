<?php

foreach ($filho as $usuario): ?>
    <ol id="ol-filhos">
            <?php if ($usuario['ativo'] == 0): ?>
                <li style="color:#AAA">    
            <?php else: ?>
                <li style="color:blue">  
            <?php endif; ?>
            <?php echo '<span id="linha-filhos"></span>'.ucfirst($usuario['name']);?>
                    <span class="abrir-sobre" id="afiliados-sobre" onclick="abrirModalPerfil()" data-toggle="tooltip" data-placement="right" title="Veja Mais!"> 
                        <i class="fas fa-eye"></i></span> </li>           
        <?php
            if(count($usuario['filhos']) > 0) {
                $this->loadViewPanel('filhos',array('filho' => $usuario['filhos']));
            }
    ?></ol><?php        
endforeach;?>
            
<!--Modal Veja Mais-->
<div class="modal fade" role='dialog' id='vejaMais2' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>CPF Inválido</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>

<?php /*
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
                $this->loadViewPanel('filhos',array('filho' => $usuario['filhos'], 'c' => 1, 'g' => $g+1));
            }
            echo '</li>';
            $l++;
        }
        
echo '</ol>';*/
