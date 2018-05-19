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
            <a href="<?php echo BASE_URL;?>painel/cancelar_conta"><button class="btn-danger">Cancelar Conta</button></a>
        </div>
    </div>
</div>
<?php else:?>
<h3>Painel de Controle</h3><br>

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
                        break;
                    case 2:
                        echo '<span>Próxima Graduação</span><span>Consumidor Prata</span>
                <div class="icone" style="color:#C6C5CB;">';
                        $p = 'bronze';
                        $pontos = 6000;
                        $l = "Bronze";
                        break;
                    case 3:
                        echo '<span>Próxima Graduação</span><span>Consumidor Ouro</span>
                <div class="icone" style="color:#FFFD90;">';
                        $p = 'prata';
                        $pontos = 20000;
                        $l = "Prata";
                        break;
                    case 4:
                        echo '<span>Próxima Graduação</span><span>Consumidor Rubi</span>
                <div class="icone" style="color:#EC0798;">';
                        $p = 'ouro';
                        $pontos = 60000;
                        $l = "Ouro";
                        break;
                    case 5:
                        echo '<span>Próxima Graduação</span><span>Consumidor Diamante</span>
                <div class="icone" style="color:#F7FAFF;">';
                        $p = 'rubi';
                        $pontos = 180000;
                        $l = "Rubi";
                        break;
                    case 6:
                        echo '<span>Próxima Graduação</span><span>Consumidor Duplo Diamante</span>
                <div class="icone" style="color:#E8EBF2;">';
                        $p = 'diamante';
                        $pontos = 540000;
                        $l = "Diamante";
                        break;
                    case 7:
                        echo '<span>Parabéns!</span><span>Você Atingiu Graduação Máxima</span>
                <div class="icone" style="color:#E8EBF2;">';
                        $p = 'duploDiamante';
                        $pontos = 540000;
                        $l = "Duplo Diamante";
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
                        <span>Pontos Necessários Para se Graduar Consumidor Prata - <?php echo number_format($pontos, 0, '', '.');?></span>
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

<?php /*
<h4>Olá <?php echo $dadosUser['name'];
if ($dadosUser['ativo'] == 0){
    echo '<strong style="color:red"> - VOCÊ ESTÁ INATIVO </strong>';
}else{
echo ' (<strong>'.utf8_encode($dadosUser['cargo']).'</strong>)  você tem '.count($filhos).' cadastros diretos<strong style="color:blue"> - ATIVO </strong>';
}
echo ' - Seu ID: '.$dadosUser['identificador'];
?>
</h4>
<br/><br/>
<div class="painel">
    <div>
    <a href="http://localhost/multi/usuarios/cadastro?id=<?php echo$dadosUser['identificador']; ?>">Convidar</a>
    </div><div>
<h3>Cadastrar Novo Usuário</h3>

    <form method="POST" action="<?php echo BASE_URL;?>usuarios/cadastrar">
        <label>Nome:</label>
        <input type="text" name="nome" /><br/><br/>

        <label>Email:</label>
        <input type="email" name="email" /><br/><br/>

        <input type="submit" value="Cadastrar"  />

    </form>
</div>
<div>
<h3>Comprar Nova Cesta</h3>
    <form method="POST" action="<?php echo BASE_URL;?>transacoes/comprar">
        <label>Quantidade:</label>
        <select name="qtde">
            <?php 
            for($q=1;$q<=10;$q++): ?>
            <option><?php echo $q;?></option>
            <?php endfor;?>
        </select><br/><br/>
     
        <input type="submit" value="Comprar" />

    </form>
</div>
</div>
<?php if(isset($msg)){
    echo $msg;
}
?>
<br/><br/>
<div class="corpo">
    <div>
        <?php if (isset($filhos) && !empty($filhos)): ?>
        <h3>Usuarios Cadastrados</h3>
            <div class="filhos">
                <div class="dados">

                </div>                
                    <?php $this->loadViewPanel('filhos',array('filho' =>$filhos, 'c' => 0, 'g' => 1));?>
                
            </div>
        <?php  else: ?>
            <h4>Não há Usuários Cadastrados</h4>
        <?php endif; ?>
    </div>
    <?php if ($dadosUser['ativo'] == 1): ?>
    <div>
        <h3>Premiação do Mês Atual:</h3>
        <p>Quantidade de Pontos: <strong><?php echo $premios['pontos'];?></strong></p>
        <p>Indicados durante o mês: <strong><?php echo $premios['indicados'];?></strong></p>
        <p>Prêmio por Indidcação <?php echo $premios['indicados'];?> x R$ 8,00: <strong>R$ <?php $n = $premios['indicados'] * 8; echo number_format($n, 2, ',', '.');?></strong></p>
        <p>Ativados durante o mês: <strong><?php echo $premios['ativos'];?></strong></p>
        <p>Prêmio por Ativação <?php echo $premios['ativos'];?> x R$ 8,00: <strong>R$ <?php $n1 = $premios['ativos'] * 8; echo number_format($n1, 2, ',', '.');?></strong></p>
        <p>Prêmio de Liderança: <strong><?php?></strong></p>
        <?php if ($dadosUser['patent'] > 1): ?>
        <p><?php echo utf8_encode($dadosUser['cargo']).' (%)';?>:<strong> <?php echo ' R$ '.number_format($premios['com_lider'], 2, ',', '.');?></strong></p>
        <h2><strong>Total: <?php echo number_format($premios['valor_total'], 2, ',', '.');?></strong></h2><br/>
        <?php else: ?>
        <p>Sem Cargo de Liderança.</p>
        
        <h2><strong>Total: <?php $total = $n+$n1; echo number_format($total, 2, ',', '.');?></strong></h2><br/>
        <?php endif; ?>
        
    </div>
    <?php endif;?>
</div>
<a href="<?php echo BASE_URL;?>usuarios/logout">Logout</a><br/><br/>
<a href="<?php echo BASE_URL;?>atualizar/atualizar">Atualizar Patentes</a><br/>
<a href="<?php echo BASE_URL;?>teste/codigo">Teste</a><br/>
*/?>
