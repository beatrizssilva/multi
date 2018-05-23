<div class="cadastrar">
    <div class="cadastrar-all">
        <div class="cadastrar-logo">
            <img src="<?php echo BASE_URL;?>assets/images/logo.png" id="lar"/>
        </div>
        <div class="cadastrar-form">
            <form method="POST" action="<?php echo BASE_URL;?>usuarios/cadastrar">
                <h3>Cadastre-se</h3>                
                <label>Nome Completo*:</label>
                <input type="text" name="nome" />
                <label>E-mail*:</label>
                <input type="email" name="email" />
                <label>CPF (Somente Números)*:</label>
                <input type="text" name="cpf" maxlength="11" onblur="CPF()" />
                <label>ID do Patrocinador*:</label>
                <input type="text" name="id" <?php if(!empty($_GET['id'])){          
                $id = addslashes($_GET['id']); 
                echo 'value="'.$id.'" disabled="disabled"'; }?> />
                <?php if(isset($_GET['c']) && !empty($_GET['c'])): ?>                    
                    <input type="hidden" name="convite" value="<?php echo $_GET['c'];?>" />
                <?php endif;?>
                    <label>Senha*:</label>              
                    <input type="password" name="senha" id="senha"/>  
                    <div id="forca" style="width: 0%;"></div>  
                <label>Repita a Senha*:</label>
                <input type="password" name="senha2" />             
                <input type="button" value="Cadastar" onclick="<?php if(isset($_GET['c']) && !empty($_GET['c'])){
                echo 'cadastrar()'; } else {echo 'cadastrar2()';} ?>" id="button-login"/>                
            </form> 
            <div class="cadastrar-login">
                <h5>Já Tenho Cadastro. <a href="<?php echo BASE_URL;?>">Logar no Sistema</a></h5>                
            </div>
        </div>        
    </div>
</div>

<!--Modais-->

<!--Modal CPF Inválido-->
<div class="modal fade" role='dialog' id='CPFInvalido' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>CPF Inválido</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>

<!--Modal E-mail já cadastrado-->
<div class="modal fade" role='dialog' id='emailjacadastrado' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>E-mail já cadastrado</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>

<!--Modal ID Inválido-->
<div class="modal fade" role='dialog' id='idinvalido' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>ID Inválido</p>
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

<!--Modal Cadastro Realizado com Sucesso-->
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

<!--Modal Cadastro Realizado com Sucesso-->
<div class="modal fade" role='dialog' id='cpfjacadastrado' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>CPF já Cadastrado.</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Cadastro Realizado com Sucesso-->
<div class="modal fade" role='dialog' id='conviteinvalido' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Convite Inválido.</p>
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