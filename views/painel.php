
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
    </div>
</div>
<a href="<?php echo BASE_URL;?>usuarios/logout">Logout</a><br/><br/>
<a href="<?php echo BASE_URL;?>atualizar/atualizar">Atualizar Patentes</a><br/>
<a href="<?php echo BASE_URL;?>atualizar/comissoes">Calcular Comissões</a><br/>
<a href="<?php echo BASE_URL;?>teste/arvore">Arvore</a><br/>