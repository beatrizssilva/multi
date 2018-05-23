<?php clearstatcache();?>
<div class="login">
    <div class="login-all">
        <div class="login-logo">
            <img src="<?php echo BASE_URL;?>assets/images/logo.png" id="lar"/>
        </div>
        <div class="login-esqueci">               
            <input type="hidden" name="codigo" value="<?php echo $_GET['pass'];?>"/>
            <h3>Redefinir Senha:</h3>
            <label>Digite a Senha:</label>
            <input type="password" name="senha" id="senha"/>
            <div id="forca" style="width: 0%;"></div>
            <label>Repita a Senha:</label>
            <input type="password" name="senha2" /><br/>
            <button class="btn-primary" onclick="redefinirSenha()">Salvar</button>            
        </div>
        
    </div>
</div>


<!--Modal Senhas Diferentes-->
<div class="modal fade" role='dialog' id='senhaserradas' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>As Senhas não são Iguais!</p>
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

<!--Modal Campos Obrigatórios-->
<div class="modal fade" role='dialog' id='senhaDefinida' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Senha Redefinida com Sucesso.</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Campos Obrigatórios-->
<div class="modal fade" role='dialog' id='codigoInvalido' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Código Inválido ou Já Utilizado. Favor Solicite Nova Senha.</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Senha Fraca-->
<div class="modal fade" role='dialog' id='SenhaFraca' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p><strong>A Senha Deve Conter:</strong></p>
        <p>Mínimo de 6 Caracteres;</p>
        <p>Letras;</p>
        <p>Números;</p>
        <p>Caracteres Especiais.</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>