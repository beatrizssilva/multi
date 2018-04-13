<?php
//echo '<pre>';
//print_r($comissao);
//exit();
?>
<h4>Olá <?php echo $dadosUser['name'];
if ($dadosUser['ativo'] == 0){
    echo '<strong style="color:red"> - VOCÊ ESTÁ INATIVO </strong>';
}else{
echo ' (<strong>'.utf8_encode($dadosUser['patente']).'</strong>)  você tem '.count($filhos).' cadastros diretos<strong style="color:blue"> - ATIVO </strong>';
}?>
</h4>
<br/><br/>
<div class="painel">
<div>
<h3>Cadastrar Novo Usuário</h3>

    <form method="POST" action="<?php echo BASE_URL;?>usuarios/cadastrar">
        <label>Nome:</label>
        <input type="text" name="nome" /><br/><br/>

        <label>Email:</label>
        <input type="email" name="email" /><br/><br/>

        <input type="submit" value="Cadastrar" />

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
                    <?php $this->loadView('filhos',array('filho' =>$filhos));?>
            </div>
        <?php  else: ?>
            <h4>Não há Usuários Cadastrados</h4>
        <?php endif; ?>
    </div>
    <div>
        <h3>Premiação:</h3>
        <p>Indicados durante o mês: <strong><?php echo $indicacao;?></strong></p>
        <p>Prêmio por Indidcação <?php echo $indicacao;?> x R$ 8,00: <strong>R$ <?php $n = $indicacao * 8; echo number_format($n, 2, ',', '.');?></strong></p>
        <p>Ativados durante o mês: <strong><?php echo $ativacao;?></strong></p>
        <p>Prêmio por Ativação <?php echo $ativacao;?> x R$ 8,00: <strong>R$ <?php $n1 = $ativacao * 8; echo number_format($n1, 2, ',', '.');?></strong></p>
        <h2><strong>Total: <?php $total = $n+$n1; echo number_format($total, 2, ',', '.');?></strong></h2><br/>
        <p><?php echo '<pre>';print_r($comissao);?></p>
    </div>
</div>
<a href="<?php echo BASE_URL;?>usuarios/logout">Logout</a><br/><br/>
<a href="<?php echo BASE_URL;?>atualizar/atualizar">Atualizar Patentes</a><br/>
<a href="<?php echo BASE_URL;?>teste/comissao">Calcular Comissões</a><br/>
<a href="<?php echo BASE_URL;?>teste/arvore">Arvore</a><br/>
<a href="<?php echo BASE_URL;?>teste/ativacao">Calcular Comissão Ativação</a><br/>
<a href="<?php echo BASE_URL;?>teste/indicacao">Calcular Comissão Indicação</a><br/>