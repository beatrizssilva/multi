<h1>Login</h1>
<form method="POST" action="<?php echo BASE_URL;?>">
    <label>Nome:</label>
    <input type="text" name="name" /><br/><br/>
    
    <label>Senha:</label>
    <input type="password" name="senha" /><br/><br/>
    
    <input type="submit" value="Logar" />
        
</form><br/><br/>
<?php if(isset($msg)){
    echo $msg;
}
?>
<h4>Ainda não tem cadastro?</h4><br/>
<a href="<?php BASE_URL;?>usuarios/cadastro" style="border:1px solid #000; background: #ccc; padding: 10px; font-size: 16px;">Cadastrar</a>

