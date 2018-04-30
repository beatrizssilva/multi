<h3>Afiliados</h3>
<?php if (isset($filhos) && !empty($filhos)): 
   echo '<h3>Usuarios Cadastrados</h3>
<div class="panel-group colapse" id="accordion1" role="tablist" aria-multiselectable="true">';
    $l = 10;
foreach ($filhos as $usuario):     ?>   


    
        <div class="panel panel-default colapse">
                          <div class="panel-heading" role="tab" id="heading<?php echo $l; ?>">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" 
                                   href="#collapse<?php echo $l; ?>" aria-expanded="false" aria-controls="collapse<?php echo $l; ?>">
                    <?php 
                    $nome = explode(' ', $usuario['name']);
                    
                    echo ucfirst($nome[0]);?>
                    </a>
                            </h4>
                          </div>
                          <div id="collapse<?php echo $l; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $l; ?>">
                            <div class="panel-body" id="lista2">
                                <ul id="lista-menu2">

                        
                    <?php // $this->loadViewPanel('filhos',array('filho' =>$usuario, 'c' => 0, 'g' => 1));
                    if(count($usuario['filhos']) > 0) {
                    $this->loadViewPanel('filhos',array('filho' =>$usuario['filhos']));
                    } else {
                        echo '<h5> Sem Cadastro</h5>';
                    }
                    ?>
        </ul>
                            </div>
                          </div>
                        </div>


           
        

     
   <?php $l++; endforeach; else: ?>
            <h4>Não há Usuários Cadastrados</h4></div>
        <?php endif; ?>
