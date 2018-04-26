

<div class="login">
    <div class="login-all">
        <h1>Lar Alimentos</h1>
        <div class="login-form">
            <form method="POST" action="<?php echo BASE_URL;?>">
                <label>E-mail ou CPF do Usuário:</label>
                <input type="text" name="name" />
                <label>Senha:</label>
                <input type="password" name="senha" />
                <input type="submit" value="Logar" id="button-login"/>
            </form>
            <div class="login-cadastrar">
                <h4>Ainda não tem cadastro?</h4>
                <a href="<?php BASE_URL;?>usuarios/cadastro">Cadastrar</a>
            </div>
        </div>
        
    </div>
</div>


<!--<h1>Login</h1>
<form method="POST" action="<?php echo BASE_URL;?>">
    <label>Nome:</label>
    <input type="text" name="name" /><br/><br/>
    
    <label>Senha:</label>
    <input type="password" name="senha" /><br/><br/>
    
    <input type="submit" value="Logar" />
        
</form><br/><br/>-->
<?php if(isset($msg)){
    echo $msg;
}
?>
