<h2>Notificações</h2>

<div class="tab-content">
  <div id="recebidas" class="tab-pane fade in active">
      <br><?php if(isset($notificacoes) && !empty($notificacoes)): ?>
    <input class="form-control" id="pesquisaMSG" type="text" placeholder="Pesquisar..">
  <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
          <th style="width:20%">Data</th>        
        <th style="width:70%">Notificação</th>
        <th style="width:10%"></th>
        
      </tr>
    </thead>
    <tbody id="table-notificacao">
      <?php foreach ($notificacoes as $not):
          $date = explode(' ', $not['data']);
          $d = explode('-', $date[0]);
          $data = $d[2].'/'.$d[1].'/'.$d[0];
          if ($not['lido'] == 0){$bold = 'bold';} else { $bold = 'normal';}
          if($not['tipo'] == 1){
              $mensagem = $not['user'].' se Cadastrou em Sua Rede.';
          }else if($not['tipo'] == 2){
              $mensagem = $not['user'].' Realizou uma Compra em Sua Rede.';
          }
          ?>
        <tr style="font-weight:<?php echo $bold;?>">    
        <td onclick="abrirNotificacao(<?php echo $not['id'];?>)"><?php echo $data.' '.$date[1];?></td>        
        <td onclick="abrirNotificacao(<?php echo $not['id'];?>)"><?php echo $mensagem;?></td>        
        <td style="font-weight:normal"><button class="btn-danger" onclick="excluirNotificacao(<?php echo $not['id'];?>)">Excluir</button></td>
            
    </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  <?php else: ?>
  <h3>Não Há Notificações.</h3>
  <?php endif;?>
  </div> 
</div>
  
<!--Modal Excluir Notificação-->
<div class="modal fade" role='dialog' id='excluirNotificacao' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Deseja Realmente Excluir Notificação?</p>
        <input type="hidden" name="idnot" id="idnot"/>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
          <button type="button" class="btn btn-danger" onclick="dellNotificacao()">Sim</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Notificação-->
<div class="modal fade" role='dialog' id='abrirNotificacao' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dados do Usuário</h4>
      </div>
      <div class="modal-body">          
          <div class="afiliados">
              <div class="foto-afiliados">
                  
              </div>
              <div class="dados-afiliados">
                  <div class="afiliados-nome">
                    <p> <strong>Nome: </strong></p>
                    
                    <p id="nome"></p>
                </div>
                  <div class="afiliados-telefone">
                    <strong>Telefone:</strong>
                    <p> </p>
                    <p id="tel"></p>
                </div>
                  <div class="afiliados-email">
                    <strong>E-mail:</strong>
                    <p> </p>
                    <p id="email"> </p>
                </div>
                  <div class="afiliados-data">
                    <strong>Ultima Compra:</strong>
                    <p> </p>
                    <p id="data"></p>
                </div>
                  <div class="afiliados-data">
                    <strong>Cidade:</strong>
                    <p> </p>
                    <p id="cidade"></p>
                </div>
                  <div class="afiliados-data">
                    <strong>ID:</strong>
                    <p> </p>
                    <p id="id"></p>
                </div>
                  <input type="hidden" id="id_user" />
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="mensagem()">Enviar Mensagem</button>
          <button type="button" class="btn btn-default" onclick="fecharNotificacao()">Fechar</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Abrir Mensagem-->
<div class="modal fade" role='dialog' id='mensagem' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mensagem</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="usr">Para <span id="msg_para"></span>:</label>
            
        </div>        
          <div class="form-group">            
            <textarea class="form-control" rows="5" id="mensagem" name="mensagem"></textarea>
        </div>
          <input type="hidden" name="de" id="de" value="<?php echo $_SESSION['multLogin'];?>"/>
          <input type="hidden" name="id_para" id="id_para"/>
      </div>
          
    
        <div class="modal-footer" id="modalFooter">
            <button type="button" class="btn btn-default" onclick="fecharMensagemAfiliados()">Fechar</button>
         <button type="button" class="btn btn-success"  onclick="enviarMensagemAfiliados()">Enviar</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Mensagem Enviada-->
<div class="modal fade" role='dialog' id='mensagemEnviada' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Mensagem Enviada com Sucesso</p>
        <input type="hidden" name="idmsg" id="idmsg"/>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>          
        </div>
    </div>

  </div>
</div>