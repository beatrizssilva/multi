<div class="login">
    <div class="login-all">
        <div class="login-logo">
            <img src="<?php echo BASE_URL;?>assets/images/logo.png" id="lar"/>
        </div>
        <div class="login-form">
            <form method="POST" action="<?php echo BASE_URL;?>">
                <label>E-mail ou CPF do Usuário:</label>
                <input type="text" name="name" />
                <label>Senha:</label>
                <input type="password" name="senha" />
                
                <?php if(isset($msg)):
                echo $msg;
                header("Refresh: 2;url=".BASE_URL);
                else:
                ?>
                <input type="submit" value="Entrar" id="button-login"/>
                <?php endif; ?>
            </form>
            <div class="login-cadastrar">
                <h4>Ainda não tem cadastro?</h4>
                <a href="<?php echo BASE_URL;?>usuarios/cadastro">Cadastrar</a>
            </div>
        </div>
        
    </div>
</div>



