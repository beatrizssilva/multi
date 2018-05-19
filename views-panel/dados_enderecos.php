<?php 
if(isset($perfil['dados']['cep']) && !empty($perfil['dados']['cep'])){
$n = str_split($perfil['dados']['cep']);
$cep =$n[0].$n[1].'.'.$n[2].$n[3].$n[4].'-'.$n[5].$n[6].$n[7];
} else { $cep = '';}
?>
<h2>Endereço de Entrega</h2><br>
    <div class="dadosPessoais-form">    
        <div class="form-group col-md-4">
                <label>CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" OnKeyPress="formatar('##.###-###', this)"
                       maxlength="10" value="<?php echo ($cep > 0)?$cep:'';?>" onblur="prenchecep(this.value);">
            </div> 
            <div class="form-group col-md-10">
                <label>Rua:</label>
                <input type="text" class="form-control" id="rua" name="rua" 
                       value="<?php echo (!empty($perfil['dados']['rua']))?$perfil['dados']['rua']:'';?>">
            </div>
            <div class="form-group col-md-2">
                <label>Numero:</label>
                <input type="text" class="form-control" id="numero" name="numero" 
                       value="<?php echo (isset($perfil['dados']['numero']) && $perfil['dados']['numero'] > 0)?$perfil['dados']['numero']:'';?>">
            </div>
            <div class="form-group col-md-7">
                <label>Complemento:</label>
                <input type="email" class="form-control" id="complemento" name="complemento" 
                       value="<?php echo (!empty($perfil['dados']['complemento']))?$perfil['dados']['complemento']:'';?>">
            </div>
            <div class="form-group col-md-5">
                <label>Bairro:</label>
                <input type="text" class="form-control" id="bairro" name="bairro"
                       value="<?php echo (!empty($perfil['dados']['bairro']))?$perfil['dados']['bairro']:'';?>">
            </div>            
            <div class="form-group col-md-5">
                <label>Cidade:</label>
                <input type="text" class="form-control" id="cidade" name="cidade"
                       value="<?php echo (!empty($perfil['dados']['cidade']))?$perfil['dados']['cidade']:'';?>">
            </div>
            <div class="form-group col-md-2">
                <label>UF:</label>
                <input type="text" class="form-control" id="uf" name="uf" maxlength="2"
                       value="<?php echo (!empty($perfil['dados']['estado']))?$perfil['dados']['estado']:'';?>">
            </div>           
            <div class="form-group col-md-12">
                <button type="button" class="btn btn-primary" onclick="editEndereco()">Salvar</button>
            </div>          
    </div>

<!--Modal Endereco Editado com Sucesso-->
<div class="modal fade" role='dialog' id='enderecoSucesso' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
        <div class="modal-body"> 
            <div>
                <h4>Endereco Editado com Sucesso</h4>
            </div>
                          
        </div>        
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        
        </div>
    </div>

  </div>
</div>

<!--Modal CEP Invalido-->
<div class="modal fade" role='dialog' id='CEPInvalido' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
        <div class="modal-body"> 
            <div>
                <h4>CEP Inválido</h4>
            </div>
                          
        </div>        
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        
        </div>
    </div>

  </div>
</div>