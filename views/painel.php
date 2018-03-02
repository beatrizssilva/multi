
<h4>Olá <?php echo $dadosUser['name'].' ('.utf8_encode($dadosUser['patente']).')  você tem '.count($filhos).' cadastros diretos';?></h4>
<br/><br/>
<h3>Cadastrar Novo Usuário</h3>

<form method="POST" action="<?php echo BASE_URL;?>usuarios/cadastrar">
    <label>Nome:</label>
    <input type="text" name="nome" /><br/><br/>
    
    <label>Email:</label>
    <input type="email" name="email" /><br/><br/>
    
    <input type="submit" value="Cadastrar" />
        
</form><br/>
<?php if(isset($msg)){
    echo $msg;
}
?>
<br/><br/>
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
<a href="<?php echo BASE_URL;?>usuarios/logout">Logout</a><br/><br/>
<a href="<?php echo BASE_URL;?>atualizar/patentes">Atualizar Patentes</a><br/>
<a href="<?php echo BASE_URL;?>teste/arvore">Arvore</a>