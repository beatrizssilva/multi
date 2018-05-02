<h2>Nova Compra</h2><br>


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