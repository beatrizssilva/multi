<h2>Mensagens</h2>
  <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#recebidas">Recebidas</a></li>
  <li><a data-toggle="tab" href="#enviadas">Enviadas</a></li>  
</ul>
<div class="tab-content">
  <div id="recebidas" class="tab-pane fade in active">
      <br><?php if(isset($mensagensRecebidas) && !empty($mensagensRecebidas)): ?>
    <input class="form-control" id="pesquisaMSG" type="text" placeholder="Pesquisar..">
  <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Data</th>
        <th>Enviado Por</th>
        <th>Mensagem</th>
        <th></th>
        
      </tr>
    </thead>
    <tbody id="table-mensagens">
      <?php foreach ($mensagensRecebidas as $msg):
          $date = explode(' ', $msg['data']);
          $d = explode('-', $date[0]);
          $data = $d[2].'/'.$d[1].'/'.$d[0];
          if ($msg['lido'] == 0){$bold = 'bold';} else { $bold = 'normal';}
          ?>
        <tr style="font-weight:<?php echo $bold;?>">
    
        <td onclick="abrirMsg(<?php echo $msg['id'];?>)"><?php echo $data.' '.$date[1];?></td>
        <td onclick="abrirMsg(<?php echo $msg['id'];?>)"><?php echo $msg['autor'];?></td>
        <td onclick="abrirMsg(<?php echo $msg['id'];?>)"><?php echo $msg['mensagem'];?></td>        
        <td style="font-weight:normal"><button class="btn-danger" onclick="excluirMensagemRecebida(<?php echo $msg['id'];?>)">Excluir</button></td>
            
    </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  <?php else: ?>
  <h3>Não Há Mensagens.</h3>
  <?php endif;?>
  </div>
  <div id="enviadas" class="tab-pane fade">
    <br><?php if(isset($mensagensEnviadas) && !empty($mensagensEnviadas)): ?>
    <input class="form-control" id="pesquisaMSG" type="text" placeholder="Pesquisar..">
  <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Data</th>
        <th>Enviada Para</th>
        <th>Mensagem</th>
        
        <th></th>
      </tr>
    </thead>
    <tbody id="table-mensagens">
      <?php foreach ($mensagensEnviadas as $msg):
          $date = explode(' ', $msg['data']);
          $d = explode('-', $date[0]);
          $data = $d[2].'/'.$d[1].'/'.$d[0];
          
          ?>
        <tr>
        <td onclick="abrirMsgEnviada(<?php echo $msg['id'];?>)"><?php echo $data.' '.$date[1];?></td>
        <td onclick="abrirMsgEnviada(<?php echo $msg['id'];?>)"><?php echo $msg['recebedor'];?></td>
        <td onclick="abrirMsgEnviada(<?php echo $msg['id'];?>)"><?php echo $msg['mensagem'];?></td>
        
        <td><button class="btn-danger" onclick="excluirMensagemEnviada(<?php echo $msg['id'];?>)">Excluir</button></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  <?php else: ?>
  <h3>Não Há Mensagens.</h3>
  <?php endif;?>
  </div>
  
</div>
  
<!--Modal Excluir Mensagem Recebida-->
<div class="modal fade" role='dialog' id='excluirMensagemRecebida' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Deseja Realmente Excluir Mensagem?</p>
        <input type="hidden" name="idmsg" id="idmsg"/>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="dellMensagemRecebida()">Sim</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Excluir Mensagem Enviada-->
<div class="modal fade" role='dialog' id='excluirMensagemEnviada' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
      <div class="modal-body">
        <p>Deseja Realmente Excluir Mensagem?</p>
        <input type="hidden" name="idmsg" id="idmsg"/>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="dellMensagemEnviada()">Sim</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Abrir Mensagem Enviada-->
<div class="modal fade" role='dialog' id='abrirMensagemEnviada' >
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
            <textarea class="form-control" rows="5" id="abrir_mensagem_enviada" name="abrir_mensagem_enviada" disabled="disabled" style="cursor:text"></textarea>
        </div>          
      </div>
          
    
        <div class="modal-footer" id="modalFooter">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
         <button type="button" class="btn btn-primary"  onclick="enviarMensagem()">Responder</button>
        </div>
    </div>

  </div>
</div>

<!--Modal Abrir Mensagem-->
<div class="modal fade" role='dialog' id='abrirMensagem' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mensagem</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="usr">DE <span id="msg_de"></span>:</label>
            
        </div>
        <div class="form-group">            
            <textarea class="form-control" rows="5" id="abrir_mensagem" name="abrir_mensagem" disabled="disabled" style="cursor:text"></textarea>
        </div>
          <div class="form-group">
            <label for="usr">Responder:</label>
            
        </div>
          <div class="form-group">            
            <textarea class="form-control" rows="5" id="mensagem" name="mensagem"></textarea>
        </div>
          <input type="hidden" name="de" id="de"/>
          <input type="hidden" name="id_para" id="id_para"/>
      </div>
          
    
        <div class="modal-footer" id="modalFooter">
            <button type="button" class="btn btn-default" onclick="fecharMensagem()">Fechar</button>
         <button type="button" class="btn btn-primary"  onclick="enviarMensagem()">Responder</button>
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