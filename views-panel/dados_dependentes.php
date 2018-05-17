<h2>Meus Dependentes</h2><br>
<?PHP if (count($dependentes) > 0):?>
<table class="table table-hover" id="table-dependentes">
    <thead>
        <tr>
            <th colspan="2">Nome</th>
            <th>Data de Nascimento</th> 
            <th>Documento</th> 
            <th>Relação</th>
            <th></th>
        </tr>
    </thead>
    <tbody>            
        <?php foreach($dependentes as $dep):
            $nasc2 = explode('-', $dep['nasc']);
            $nasc = $nasc2[2].'/'.$nasc2[1].'/'.$nasc2[0];
            $name = strtolower($dep['nome']);
            $nome = ucwords($name);
            ?>
        <tr>
            <td colspan="2"><?php echo $nome;?></td>
            <td><?php echo $nasc; ?></td>
            <td><?php echo $dep['documento'];?></td>
            <td><?php switch ($dep['relacao']) { case 1: echo 'Filho'; break; case 2: echo 'Cônjuge'; break; 
            case 3: echo 'Outros';     break;};?></td>
            <td><button class="btn-danger" onclick="excluirDependente(<?php echo $dep['id']; ?>)">Excluir</button></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<button class="btn-primary" onclick="novoDependente()">Cadastrar Novo Dependente</button>
<?php else:?>
<H3>Não há dependentes.</H3><br>
<button class="btn-primary" onclick="novoDependente()">Cadastrar Novo Dependente</button>
<?php endif;?>

<!--Modal Cadastro de Dependente-->
<div class="modal fade" role='dialog' id='cadastroDependente' >
<div class="modal-dialog" style="min-width: 70%;">

    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastrar Novo Dependente</h4>
      </div>
        <div class="modal-body"> 
            <div class="form-horizontal">    
                <div class="form-group">
                    <label for="nome" class="col-md-3">Nome Completo:</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control col-md-12" id="nome" name="nome">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nasc" class="col-md-3">Data de Nascimento:</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control col-md-6" id="nasc" name="nasc" maxlength="10"
               OnKeyPress="formatar('##/##/####', this)">
                    </div>                    
                </div>
                <div class="form-group">
                    <label for="documento" class="col-md-3">Documento:</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control col-md-12" id="documento" name="documento">
                    </div>
                </div>
                <div class="form-group">
                    <label for="realcao" class="col-md-3">Relação:</label>
                    <div class="col-md-2">                        
                        <select name="relacao">
                        <option value="1">Filho(a)</option>
                        <option value="2">Cônjuge</option>
                        <option value="3">Outros</option>                        
                    </select>
                    </div>
                </div>
            </div>
            <div class="btn-dependente">
                <button type="button" class="btn btn-primary" onclick="salvarDependente()">Salvar</button>
            </div>
        </div>        
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        
        </div>
    </div>

  </div>
</div><!--Modal Cadastro Realizado com Sucesso-->
<div class="modal fade" role='dialog' id='CadastroSucesso' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Cadastro Realizado com Sucesso!</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Dependente Excluido-->
<div class="modal fade" role='dialog' id='excluidoSucesso' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Cadastro Excluido com Sucesso.</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>