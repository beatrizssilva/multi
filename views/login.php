
<form method="POST" action="<?php echo BASE_URL;?>">
    <label>E-mail:</label>
    <input type="email" name="email" /><br/><br/>
    
    <label>Senha:</label>
    <input type="password" name="senha" /><br/><br/>
    
    <input type="submit" value="Logar" />
        
</form>
<?php if(isset($msg)){
    echo $msg;
}
?>

