<?php 
$n = str_split($dadosUser['cpf']);
$cpf =$n[0].$n[1].$n[2].'.'.$n[3].$n[4].$n[5].'.'.$n[6].$n[7].$n[8].'-'.$n[9].$n[10];
if(isset($perfil['dados']['telefone']) && !empty($perfil['dados']['telefone'])){
$n = str_split($perfil['dados']['telefone']);
$tel =$n[0].$n[1].'-'.$n[2].$n[3].$n[4].$n[5].$n[6].'-'.$n[7].$n[8].$n[9].$n[10];
} else { $tel = '';}
if(isset($perfil['dados']['nasc']) && !empty($perfil['dados']['nasc'])){
$n = str_split($perfil['dados']['nasc']);
$nasc = $n[8].$n[9].'/'.$n[5].$n[6].'/'.$n[0].$n[1].$n[2].$n[3];
} else { $nasc = '';}

?>
<h2>Meus Dados Pessoais</h2><br>
    <div class="dadosPessoais-form col-md-5">        
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo mb_convert_case($dadosUser['name'], MB_CASE_TITLE, 'UTF-8');?>">
            </div>
            <div class="form-group">
                <label for="cpf">CPF:*</label>
                <input type="text" class="form-control" id="cpf" name="cpf" 
                       disabled="disabled" OnKeyPress="formatar('###.###.###-##', this)" value="<?php echo $cpf;?>" >
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $dadosUser['email'];?>">
            </div>
            <div class="form-group">
                <label for="tel">Telefone:</label>
                <input type="text" class="form-control" id="tel" name="tel" maxlength="14"
                       OnKeyPress="formatar('##-#####-####', this)" value="<?php echo $tel;?>">
            </div>
            <div class="form-group">
                <label for="nasc">Data de Nascimento:</label>
                <input type="text" class="form-control" id="nasc" name="nasc" maxlength="10"
                       OnKeyPress="formatar('##/##/####', this)" value="<?php echo $nasc;?>">
            </div>
            <div class="form-group">
                <label for="pis" data-toggle="tooltip" data-placement="right" 
                       title="Informação Necessária para Liberação do Pagamento!">PIS:*</label>
                <input type="text" class="form-control" id="pis" name="pis" 
                       value="<?php echo (isset($perfil['dados']['pis']))?$perfil['dados']['pis']:'';?>">
            </div>
            <div class="form-group">
                <label for="rg">RG:</label>
                <input type="text" class="form-control" id="rg" name="rg" value="<?php echo (isset($perfil['dados']['rg']))?$perfil['dados']['rg']:'';?>">
            </div>
            <div class="form-group">
                <label for="rg">Senha de Acesso:</label>
                <input type="password" class="form-control" id="senha" name="senha" value="<?php echo $dadosUser['pass'];?>">
                <br/><div id="forca" style="width: 0%;"></div>
            </div>
            <div class="form-group">
                <label for="rg">Repita a Senha:</label>
                <input type="password" class="form-control" id="senha2" name="senha2" value="<?php echo $dadosUser['pass'];?>">
            </div>
      
            <button type="button" class="btn btn-primary" onclick="editDados('<?php echo $dadosUser['email'];?>', '<?php echo $dadosUser['pass'];?>' )">Salvar</button>
         
    </div>

<!--Modal Dados Editado com Sucesso-->
<div class="modal fade" role='dialog' id='dadosSucesso' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
        <div class="modal-body"> 
            <div>
                <h4>Dados Editado com Sucesso.</h4>
            </div>
                          
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