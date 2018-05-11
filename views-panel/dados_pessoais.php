<?php 
$n = str_split($dadosUser['cpf']);
$cpf =$n[0].$n[1].$n[2].'.'.$n[3].$n[4].$n[5].'.'.$n[6].$n[7].$n[8].'-'.$n[9].$n[10];
if(isset($perfil['dados']['telefone']) && !empty($perfil['dados']['telefone'])){
$n = str_split($perfil['dados']['telefone']);
$tel =$n[0].$n[1].'-'.$n[2].$n[3].$n[4].$n[5].'-'.$n[6].$n[7].$n[8].$n[9];
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
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo ucfirst($dadosUser['name']);?>">
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
                <label for="email">Telefone:</label>
                <input type="email" class="form-control" id="tel" name="tel" maxlength="13"
                       OnKeyPress="formatar('##-#####-####', this)" value="<?php echo $tel;?>">
            </div>
            <div class="form-group">
                <label for="email">Data de Nascimento:</label>
                <input type="text" class="form-control" id="nasc" name="nasc" maxlength="10"
                       OnKeyPress="formatar('##/##/####', this)" value="<?php echo $nasc;?>">
            </div>
            <div class="form-group">
                <label for="civil">Estado Civil:</label>
                <input type="text" class="form-control" id="civil" name="civil" >
            </div>            
            <div class="form-group">
                <label for="nomePai">Nome do Pai:</label>
                <input type="text" class="form-control" id="nomePai" name="nomePai">
            </div>
            <div class="form-group">
                <label for="nomeMae">Nome da Mãe:</label>
                <input type="text" class="form-control" id="nomeMae" name="nomeMae">
            </div>
            <div class="form-group">
                <label for="pis" data-toggle="tooltip" data-placement="right" 
                       title="Informação Necessária para Liberação do Pagamento!">PIS:*</label>
                <input type="text" class="form-control" id="pis" name="pis">
            </div>
            <div class="form-group">
                <label for="rg">RG:</label>
                <input type="text" class="form-control" id="rg" name="rg">
            </div>
      
            <button type="button" class="btn btn-primary" onclick="editDados()">Salvar</button>
         
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