<div class="container-fluid">
    <h3>Arquivos de Integração Contábil</h3><br/>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Mês</th>
                <th>Ano</th>
                <th>Arquivo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php if(isset($arquivos) && !empty($arquivos)):?>
                <td><?php echo ucfirst($arquivos['tipo']);?></td>
                <td><?php echo $arquivos['mes'];?></td>
                <td><?php echo $arquivos['ano'];?></td>
                <td><a href="<?php echo BASE_URL;?>contabil/pagamentos/<?php echo $arquivos['nome'];?>" download>
                    <?php echo $arquivos['nome'];?></a></td>
                <?php else:?>
                <td colspan="4" style="text-align: center">Não Há Arquivos</td>
                <?php endif;?>
            </tr>            
        </tbody>
    </table>
</div>