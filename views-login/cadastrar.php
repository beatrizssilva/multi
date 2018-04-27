<?php 
    if (isset($login) && $login == 1){
        header("Refresh: 2;url=".BASE_URL);
    }
?>
<div class="cadastrar">
    <div class="cadastrar-all">
        <div class="cadastrar-logo">
            <img src="<?php echo BASE_URL;?>assets/images/logo.png" id="lar"/>
        </div>
        <div class="cadastrar-form">
            <form method="POST" action="<?php echo BASE_URL;?>usuarios/cadastrar">
                <h3>Cadastre-se</h3>
                <?php if(isset($msg) && $op == 0):   ?>
                <label>Nome Completo*:</label>
                <input type="text" name="nome" value="<?php echo $nome;?>"/>
                <label>E-mail:</label>
                <input type="email" name="email" value="<?php echo $email;?>"/>
                <label>CPF (Somente Números)*:</label>
                <input type="text" name="cpf" value="<?php echo $cpf;?>"/>
                <label>ID*:</label>
                <input type="text" name="id" value="<?php echo $id;?>"/>
                <?php else: ?>
                <label>Nome Completo*:</label>
                <input type="text" name="nome" />
                <label>E-mail*:</label>
                <input type="email" name="email" />
                <label>CPF (Somente Números)*:</label>
                <input type="text" name="cpf" />
                <label>ID*:</label>
                <input type="text" name="id" <?php if(!empty($_GET['id'])){          
                $id = addslashes($_GET['id']); 
                echo 'value="'.$id.'"'; }?> />
                <?php endif; ?>
                
                <label>Senha*:</label>
                <input type="password" name="senha" />  
                <label>Repita a Senha*:</label>
                <input type="password" name="senha2" /> 
                
                <?php if(isset($msg)):
                echo '<strong style="color:blue">'.$msg.'</strong>';
//                header("Refresh: 2;url=".BASE_URL."usuarios/cadastro");
               endif; 
                ?>
                <input type="submit" value="Cadastar" id="button-login"/>
                
            </form> 
            <div class="cadastrar-login">
                <h5>Já Tenho Cadastro. <a href="<?php echo BASE_URL;?>">Logar no Sistema</a></h5>
                
            </div>
        </div>   
     
    </div>
</div>

