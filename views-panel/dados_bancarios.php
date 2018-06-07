<h2>Dados Bancários</h2><br>
<?PHP if (isset($bancarios) && count($bancarios) > 0):?>
<table class="table table-hover" id="table-dependentes">
    <thead>
        <tr>
            <th>Nome do Banco</th>
            <th>Agência</th> 
            <th>Conta</th> 
            <th>Tipo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>            
        <?php foreach($bancarios as $banc): ?>
        <tr>
            <td><?php echo $banc['nome_banco'];?></td>
            <td><?php echo $banc['ag']; ?></td>
            <td><?php echo $banc['conta'].' - '.$banc['digito'];?></td>            
            <td><?php echo utf8_encode($banc['nome_tipo']);?></td>
            <td><button class="btn-danger" onclick="excluirContaBancaria(<?php echo $banc['id']; ?>)">Excluir</button></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<button class="btn-primary" onclick="novaConta()">Cadastrar Nova Conta</button>
<?php else:?>
<H3>Não Há Conta Cadastrada.</H3><br>
<button class="btn-primary" onclick="novaConta()">Cadastrar Nova Conta</button><br/><br/>
<?php endif;?>
<!--<label class="col-md-2">Banco:</label>
<div class="col-md-6">
    <input type="text" class="form-control col-md-12" id="banco" name="banco">
    <input type="text" class="form-control col-md-12" id="banco1" name="banco1">
</div>
<div id="bancos">
    
</div>-->
<!--Modal Cadastro de Dependente-->
<div class="modal fade" role='dialog' id='cadastrarConta' >
<div class="modal-dialog" style="min-width: 50%;">

    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastrar Nova Conta</h4>
      </div>
        <div class="modal-body"> 
            <div class="form-horizontal">  
                <div class="form-group">
                    <label class="col-md-3">Pesquise o Banco:</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control col-md-12" id="banco" name="banco">
                    </div>
                    <div class="modalBancos">
                        <div id="bancos"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Banco:</label>
                    <div class="col-md-8" id="nomeBancos">
                        <input type="text" class="form-control col-md-12" id="banco1" name="banco1" disabled="disabled">
                        <input type="hidden" class="form-control col-md-12" id="id_banco" name="id_banco" >
                    </div>
                    <div id="bancos">
                        <!--Aqui que aparece a relação dos Bancos-->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Agencia:</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control col-md-6" id="agencia" name="agencia">
                    </div>                    
                </div>
                <div class="form-group">
                    <label class="col-md-3">Conta:</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control col-md-6" id="conta" name="conta">
                    </div>
                    <label class="col-md-2">Dígito:</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control col-md-6" id="digito" name="digito">
                    </div>
                </div>
                <div class="form-group">
                    <label for="realcao" class="col-md-3">Tipo:</label>
                    <div class="col-md-2">                        
                        <select name="tipo">
                        <option value="1">Conta Corrente</option>
                        <option value="2">Poupança</option>                      
                    </select>
                    </div>
                </div>
            </div>
            <div class="btn-dependente">
                <button type="button" class="btn btn-primary" onclick="salvarConta()">Cadastrar</button>
            </div>
        </div>        
<!--        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        
        </div>-->
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

<!--Modal Campos Obrigatórios-->
<div class="modal fade" role='dialog' id='camposobrigatorios' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Favor Preencha todos os Campos!</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>