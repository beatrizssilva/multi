<h3>Compartilhe com seus amigos</h3>
<div class="convidar">
    <div class="convidar-link">
        <h4>Compartilhe no Facebook:</h4>
        <div class="fb-share-button" data-href="<?php echo BASE_URL.'usuarios/cadastro?id='.$dadosUser['identificador'];?>" 
             data-layout="button" data-size="large" data-mobile-iframe="true">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flaralimentos.com.br%2Fusuarios%2Fcadastro%3Fid%3D1001f437&amp;src=sdkpreparse" 
               class="fb-xfbml-parse-ignore">Compartilhar</a>
        </div>
    </div>
    <div class="convidar-form">
        <h4>Convide por E-mail:</h4>
        <form method="post" action="<?php echo BASE_URL;?>painel/convite" class="col-md-5">
            <div class="form-group">
                <label for="nome">Nome do Convidado:*</label>
                <input type="text" class="form-control" id="nome" name="nome">
            </div>
            <div class="form-group">
                <label for="email">E-mail do Convidado:*</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            
    <input type="hidden" class="form-control" id="identificador" name="identificador" value="<?php echo $dadosUser['identificador'];?>">
    <input type="hidden" class="form-control" id="name" name="name" value="<?php echo $dadosUser['name'];?>">
            
            <button type="button" class="btn btn-primary" onclick="enviarConvite()">Convidar</button>
          </form>
    </div>
    <div class="convidar-link">
        <h4>Compartilhar Link de Convite:</h4>
        
        <div class="form-inline">
                
                <input type="text" class="form-control" id="link" name="link" 
                    value="<?php echo BASE_URL.'usuarios/cadastro?id='.$dadosUser['identificador'];?>" 
                    disabled="disabled" >
            </div>
      
    </div>
    
    <div class="convidados">
        <?php if(isset($convidados) && !empty($convidados)):?>
        <h3>Convites Enviados</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th colspan="2">E-mail</th>
                    <th>Nº Convite</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($convidados as $dados):
                    $convite = $dados['convite'];
                    ?>
                <tr>
                    <td><?php echo ucfirst($dados['nome']);?></td>
                    <td colspan="2"><?php echo $dados['email'];?></td>
                    <td><?php echo $convite;?></td>
                    <td><?php 
                    $data = date('d-m-Y H:i:s', strtotime($dados['data']));
                    echo $data;?></td>
                    <td><?php echo ($dados['status'] == 1)?'<strong style="color:blue">Convite Aceito</strong>':'Aguardando';?></td>
                    <td><button class="btn-danger" onclick="excluirConvite('<?php echo $convite; ?>')">Excluir</button></td>
                </tr>
                <?php endforeach;?>
            </tbody>
          </table>
        <?php endif;?>
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

<!--Modal Convite Enviado-->
<div class="modal fade" role='dialog' id='conviteSucesso' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Convite Enviado com Sucesso.</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Convite Excluido-->
<div class="modal fade" role='dialog' id='excluidoSucesso' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Convite Excluido com Sucesso.</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>

  </div>
</div>

