<h1>Cadastre-se</h1>
<?php if(isset($msg) && $op == 0):   

?>
<form method="POST" action="<?php echo BASE_URL;?>usuarios/cadastrar">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?php echo $nome;?>"/><br/><br/>

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $email;?>"/><br/><br/>

    <label>ID:</label>
    <input type="text" name="id" value="<?php echo $id;?>"/><br/><br/>
    
    <label>Senha:</label>
    <input type="password" name="senha"/><br/><br/>

    <input type="submit" value="Cadastrar"  />

</form>
<?php 
echo '<strong style="color:blue">'.$msg.'</strong>';
else: ?>
<form method="POST" action="<?php echo BASE_URL;?>usuarios/cadastrar">
    <label>Nome:</label>
    <input type="text" name="nome" /><br/><br/>

    <label>Email:</label>
    <input type="email" name="email" /><br/><br/>
<?php if(isset($id)):?>
    <label>ID:</label>
    <input type="text" name="id" value="<?php echo $id;?>"/><br/><br/>
    
        <?php else: ?>
    
    <label>ID:</label>
    <input type=text name="id" /><br/><br/>
    <?php endif; ?>
    <label>Senha:</label>
    <input type="password" name="senha" /><br/><br/>

    <input type="submit" value="Cadastrar"  />

</form>
<?php 
if (isset($msg)){
    echo '<strong style="color:blue">'.$msg.'</strong>';
}
endif; 
if (isset($login) && $login == 1){
    header("Refresh: 2;url=".BASE_URL);
}
?>


