
<h4>Olá <?php echo $_SESSION['multLoginName'].' ID: '.$_SESSION['multLogin'];?></h4>
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
            <label>Nome</label>
            <label>E-mail</label>
            <label>Patente</label>
            
        </div>
        <?php echo $listaUsuarios; ?>
        
    </div>

<?php  else: ?>

<h4>Não há Usuários Cadastrados</h4>
<?php endif; ?>
<a href="<?php echo BASE_URL;?>usuarios/logout">Logout</a>