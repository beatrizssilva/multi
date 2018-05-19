<?php clearstatcache();?>
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
                <input type="button" value="Entrar" id="button-login" onclick="login()"/>
                
            </form>
            <div class="login-cadastrar">
                <h4>Ainda não tem cadastro?</h4>
                <a href="<?php echo BASE_URL;?>usuarios/cadastro">Cadastrar</a>
                <a href="<?php echo BASE_URL;?>usuarios/recuperar_senha" style="float: right">Esqueci minha senha</a>
            </div>
        </div>
        
    </div>
</div>


<!--Modal Login Inválido-->
<div class="modal fade" role='dialog' id='loginInvalido' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>E-mail e/ou Senha Incorreto(s). Tente Novamente.</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Campos Obrigatórios-->
<div class="modal fade" role='dialog' id='CamposObrigatorios' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Preencha Todos os Campos.</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>
