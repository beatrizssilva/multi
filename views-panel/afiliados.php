<h3>Minha Rede de Afiliados</h3>
<div class="afiliados-head">
    <div class="legenda">
        <div class="legenda-itens">
            <h5>Legenda</h5>
            <ul>
                <li id="ativo"><i class="fas fa-square"></i> Ativo</li>
                <li id="inativo"><i class="fas fa-square"></i> Inativo</li>
            </ul>
        </div>
    </div>
    <div class="legenda">
        <div class="legenda-itens">
            <h5>Afiliados</h5>
            <ul>
                <li id="afiliados-total"><i class="fas fa-square"></i> Total()</li>
                <li id="afiliados-ativos"><i class="fas fa-square"></i> Ativos()</li>
                <li id="afiliados-inativos"><i class="fas fa-square"></i> Inativos()</li>
            </ul>
        </div>
    </div>
</div>

<?php if (isset($filhos) && !empty($filhos)): 
   echo '<h3>Usuarios Cadastrados</h3>
<div class="panel-group colapse" id="accordion1" role="tablist" aria-multiselectable="true">';

    $l = 10;
foreach ($filhos as $usuario):     ?>      
    <div class="panel panel-default colapse">
        <div class="panel-heading" role="tab" id="heading<?php echo $l; ?>">
            <h4 class="panel-title" id="afiliados-filhos">
              <a class="collapsed" role="button" id="afiliados-nome" data-toggle="collapse" data-parent="#accordion1" 
                    href="#collapse<?php echo $l; ?>" aria-expanded="false" aria-controls="collapse<?php echo $l; ?>"
                    <?php if ($usuario['ativo'] == 0){
                        echo 'style="color:#3CB371"';  
                    } else {
                        echo 'style="color:blue; font-weight:bold"';  
                    }
                            ?>
                    >
                    <?php 
                    $nome = explode(' ', $usuario['name']);  
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
                            }
                    echo '<span>'.ucfirst($nome[0]).' ('.$patent.')';?> </span> 
              </a>
                <span class="abrir-sobre" id="afiliados-sobre" onclick="abrirModalPerfil(<?php echo $usuario['id'];?>)" data-toggle="tooltip" data-placement="right" title="Veja Mais!">
                    <i class="fas fa-eye"></i>
                </span>
                <a class="collapsed" role="button" id="afiliados-mais" data-toggle="collapse" data-parent="#accordion1" 
                   href="#collapse<?php echo $l; ?>" aria-expanded="false" title="Veja Mais"aria-controls="collapse<?php echo $l; ?>">
                    <i class="fas fa-angle-down"></i>
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

<!--Modal Veja Mais-->
<div class="modal fade" role='dialog' id='vejaMais' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dados do Usuário</h4>
      </div>
      <div class="modal-body">          
          <div class="afiliados">
              <div class="foto-afiliados">
                  
              </div>
              <div class="dados-afiliados">
                  <div class="afiliados-nome">
                    <p> <strong>Nome: </strong></p>
                    
                    <p id="nome"></p>
                </div>
                  <div class="afiliados-telefone">
                    <strong>Telefone:</strong>
                    <p> </p>
                    <p id="tel"></p>
                </div>
                  <div class="afiliados-email">
                    <strong>E-mail:</strong>
                    <p> </p>
                    <p id="email"> </p>
                </div>
                  <div class="afiliados-data">
                    <strong>Ultima Compra:</strong>
                    <p> </p>
                    <p id="data"></p>
                </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Veja Mais2-->
<div class="modal fade" role='dialog' id='vejaMais2' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dados do Usuário</h4>
      </div>
      <div class="modal-body">          
          <div class="afiliados">
              <div class="foto-afiliados2">
                  
              </div>
              <div class="dados-afiliados">
                  <div class="afiliados-nome">
                    <p> <strong>Nome: </strong></p>
                    
                    <p id="nome2"></p>
                </div>
                  <div class="afiliados-telefone">
                    <strong>Telefone:</strong>
                    <p> </p>
                    <p id="tel2"></p>
                </div>
                  <div class="afiliados-email">
                    <strong>E-mail:</strong>
                    <p> </p>
                    <p id="email2"> </p>
                </div>
                  <div class="afiliados-data">
                    <strong>Ultima Compra:</strong>
                    <p> </p>
                    <p id="data2"></p>
                </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>