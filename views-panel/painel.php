<script src="<?php echo BASE_URL;?>assets/js/grafico.js" type="text/javascript"></script>
<?php if ($dadosUser['ativo'] == 0):?>
<div class="painel-inativo">
    <h3>Usuário Inativo</h3>
    <div class="painel-opcoes">    
        <div class="painel-reativar">
            <span>Para acessar o Painel, Você Precisa se Reativar.</span><br/>
            <a href="<?php echo BASE_URL;?>painel/nova_compra"><button class="btn-primary">Clique Aqui para Reativar</button></a>
        </div>
        <div class="painel-saldo">
            <span>Cancelar a Conta</span><br/>
            <button class="btn-danger" onclick="cancelarConta()">Cancelar Conta</button>
        </div>
    </div>
</div>
<?php else:?>
<div class="button-convidar">
    <h3>Painel de Controle</h3>
    <button class="btn-success"><a href="<?php echo BASE_URL;?>painel/convidar">Enviar Convite</a></button>
</div>
<!--<a href="<?php echo BASE_URL;?>teste/relatorio_pagamento">Layout Relatorio Pagamento</a><br>
<a href="<?php echo BASE_URL;?>teste/relatorio_cadastro">Layout Relatorio de Cadastro</a><br>
<a href="<?php echo BASE_URL;?>teste/graduacao">Teste Graduacao</a><br>-->


<div class="home-head">
    <div class="ativos">
        <div class="painel-dados">
            <div class="dados">
                <h4><?php if(isset($premios['ativos']) && $premios['ativos'] > 0) {echo $premios['ativos'];}
                else { echo '0';}?></h4>
                <h5>Ativados no Mês Atual</h5>
            </div>
            <div id="icone">
               <i class="fas fa-user-plus"></i> 
            </div>
        </div>
        <div class="saiba-mais">
            <a href="<?php echo BASE_URL;?>painel/afiliados"><h5>Saiba Mais <i class="fas fa-arrow-circle-right"></i></h5></a>
        </div>
    </div>
    <div class="indicados">
        <div class="painel-dados">
            <div class="dados">
                <h4><?php if(isset($premios['indicados']) && $premios['indicados'] > 0) {echo $premios['indicados'];}
                else { echo '0';}?></h4>
                <h5>Indicados no Mês Atual</h5>
            </div>
            <div id="icone">
               <i class="fas fa-user-plus"></i> 
            </div>
        </div>
       <div class="saiba-mais">
            <a href="<?php echo BASE_URL;?>painel/afiliados"><h5>Saiba Mais <i class="fas fa-arrow-circle-right"></i></h5></a>
        </div>        
    </div>
    <div class="pontos">
        <div class="painel-dados">
            <div class="dados">
                <h4><?php if(isset($premios['pontos']) && $premios['pontos'] > 0) {echo number_format($premios['pontos'], 0, '', '.');}
                else { echo '0';}?></h4>
                <h5>Pontos no Mês Atual</h5>
            </div>
            <div id="icone">
               <i class="fas fa-thumbs-up"></i>
            </div>
        </div>
       <div class="saiba-mais">
            <a href=""><h5>Saiba Mais <i class="fas fa-arrow-circle-right"></i></h5></a>
        </div>         
    </div>
    <div class="premios">
        <div class="painel-dados">
            <div class="dados">
                <?php if(isset($premios['valor_total']) && $premios['valor_total'] > 0) :
                    if($dadosUser['patent'] > 1):
                    ?>
                <h4><?php echo 'R$ '.number_format($premios['valor_total'], 2, ',', '.');?></h4>
                
                <?php 
                else: ?>
                <h4><?php 
                $v = $premios['valor_total']-$premios['com_lider'];
                echo 'R$ '.number_format($v, 2, ',', '.');?></h4>
                <?php endif; 
                else: $premios['valor_total'] = 0;?>
                <h4><?php echo 'R$ '.number_format($premios['valor_total'], 2, ',', '.');?></h4>
                <?php endif; ?>
                <h5>Bônus do Mês Atual*</h5>
            </div>
            <div id="icone">
               <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
       <div class="saiba-mais">
            <a href=""><h5>Saiba Mais <i class="fas fa-arrow-circle-right"></i></h5></a>
        </div> 
    </div>
</div>


<div class="acompanhamento">
    <div class="acompanhamento-corpo">
        <div class="acompanhamento-titulo">
            <h3>Acompanhamento para Graduação</h3>
        </div>
        <div class="acompanhamento-status">
            <div class="acompanhamento-proximo">               
                <?php switch($dadosUser['patent']){
                    case 1:
                        echo '<span>Próxima Graduação</span><span>Consumidor Bronze</span>
                <div class="icone" style="color:#F0B782;">';
                        $p = 'pre';
                        $pontos = 2000;
                        $l = "Pre";
                        $proximo = 'Bronze';
                        break;
                    case 2:
                        echo '<span>Próxima Graduação</span><span>Consumidor Prata</span>
                <div class="icone" style="color:#C6C5CB;">';
                        $p = 'bronze';
                        $pontos = 6000;
                        $l = "Bronze";
                        $proximo = 'Prata';
                        break;
                    case 3:
                        echo '<span>Próxima Graduação</span><span>Consumidor Ouro</span>
                <div class="icone" style="color:#FFFD90;">';
                        $p = 'prata';
                        $pontos = 20000;
                        $l = "Prata";
                        $proximo = 'Ouro';
                        break;
                    case 4:
                        echo '<span>Próxima Graduação</span><span>Consumidor Rubi</span>
                <div class="icone" style="color:#EC0798;">';
                        $p = 'ouro';
                        $pontos = 60000;
                        $l = "Ouro";
                        $proximo = 'Rubi';
                        break;
                    case 5:
                        echo '<span>Próxima Graduação</span><span>Consumidor Diamante</span>
                <div class="icone" style="color:#F7FAFF;">';
                        $p = 'rubi';
                        $pontos = 180000;
                        $l = "Rubi";
                        $proximo = 'Diamante';
                        break;
                    case 6:
                        echo '<span>Próxima Graduação</span><span>Consumidor Duplo Diamante</span>
                <div class="icone" style="color:#E8EBF2;">';
                        $p = 'diamante';
                        $pontos = 540000;
                        $l = "Diamante";
                        $proximo = 'Duplo Diamante';
                        break;
                    case 7:
                        echo '<span>Parabéns!</span><span>Você Atingiu Graduação Máxima</span>
                <div class="icone" style="color:#E8EBF2;">';
                        $p = 'duploDiamante';
                        $pontos = 540000;
                        $l = "Duplo Diamante";
                        $proximo = '()';
                        break;
                }?>                
                    <i class="fas fa-trophy" id="taca"></i>
                </div>
            </div>
            <div class="acompanhamento-dados">
                <div class="acompanhamento-afiliado">
                    <div class="ac-afiliado-info">
                        <?php if($dados['dados']['F.Ativos'] > 0){ $f = 1;} else {$f = 0;}
                        $nf = $f*100;
                        $b = 100-$nf;
                        
                        $patent = $dados['dados'][$p];
                        $np = $patent*33;
                        if ($np>100){$np=100;}
                        $c = ($premios['pontos']*100)/$pontos;
                        if ($c>100){$c=100;}
                        ?>
                        <span>Necessário 1 Afiliado Ativo da 1ª Geração</span>
                        <span><?php echo $dados['dados']['F.Ativos'];?> / 1</span>
                    </div>
                    <div class="ac-afiliado-barras">
                        
                        <div id="barraAfiliado" style="width: <?php echo $nf;?>%"></div>
                        
                        <div id="barraGeral2" style="width: <?php echo $b;?>%; margin-left: <?php echo $f; ?>"></div>
                        <span><?php
                        if ($nf >= 100){
                            echo '<i class="fas fa-check-circle"></i>'; } else {
                            echo '<i class="far fa-circle"></i>';
                        } ?></span>
                    </div>
                </div>
                <div class="acompanhamento-linhas">
                    <div class="ac-afiliado-info">
                        <span>Necessário 3 Linhas (<?php echo $l;?>) Diferentes Ativas </span>
                        <span><?php echo $patent;?> / 3</span>
                    </div>
                    <div class="ac-afiliado-barras">
                        <div id="barraAfiliado" style="width: <?php echo $np;?>%"></div>
                        <div id="barraGeral2" style="width: <?php echo 100-$np;?>%"></div>
                        <span><?php
                        if ($np >= 100){
                            echo '<i class="fas fa-check-circle"></i>'; } else {
                            echo '<i class="far fa-circle"></i>';
                        } ?></span>
                    </div>
                </div>
                <div class="acompanhamento-pontos">
                    <div class="ac-afiliado-info">
                        <span>Pontos Necessários Para se Graduar Consumidor <?php echo $proximo. ' - '.number_format($pontos, 0, '', '.');?></span>
                        <span><?php echo number_format($premios['pontos'], 0, '', '.');?> / <?php echo number_format($pontos, 0, '', '.'); ?></span>
                    </div>
                    <div class="ac-afiliado-barras">
                        <div id="barraAfiliado" style="width: <?php echo number_format($c, 0);?>%"></div>
                        <div id="barraGeral2" style="width: <?php echo 100-$c;?>%"></div>
                        <span><?php
                        if ($c >= 100){
                            echo '<i class="fas fa-check-circle"></i>'; } else {
                            echo '<i class="far fa-circle"></i>';
                        } ?></span>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
<div class="grafico">
    <div class="grafico-titulo">
        <h3>Comparativo Indicados e Ativados Durante o Ano Vigente</h3>
    </div>
    <div class="grafico-canvas">
        <canvas id="grafico"></canvas>
    </div>
</div>
<?php endif;?>
<!--Modal Campos Obrigatórios-->
<div class="modal fade" role='dialog' id='cancelarConta' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
        <div class="modal-body" id="cancelar">           
        <p>Tem certeza que deseja cancelar sua conta?</p>
        <p>Cancelando sua conta, você não terá mais acesso ao seu Painel.</p>
        <div class="cancelar">
            <button class="btn-danger" onclick="cancelamentoConta(<?php echo $_SESSION['multLogin'];?>)">Sim</button>
            <button class="btn-primary" data-dismiss="modal">Não</button>
        </div>
      </div>
    </div>

  </div>
</div>

<!--Modal Convite Excluido-->
<div class="modal fade" role='dialog' id='contaExcluidaSucesso' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Conta Excluida com Sucesso.</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>