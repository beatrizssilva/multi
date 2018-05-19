
<h2>Nova Compra</h2><br>
<?php 
if(isset($premios['total']) && $premios['total'] > 0){
if($premios['total'] > 220){
    $premios['total'] = 220;
}
    $x = $premios['total'] *100;
$n = $x/220;
//$n = $n1+1;
if(!isset($dadosUser['data_ativacao']) && $dadosUser['data_ativacao'] <= 0){
    $v = 300-$premios['total'];
} else {
    $v = 220-$premios['total'];
}
} else {
    if(!isset($dadosUser['data_ativacao']) && $dadosUser['data_ativacao'] <= 0){
        $n = 0; $v = 300;
} else {
    $n = 0; $v = 220;
}
}
?>
<input type="hidden" name="id" value="<?PHP echo $_SESSION['multLogin'];?>"
<div class="dadosCompra">
    <div class="compraGeral">
        <div class="compraIcon">
            <span><i class="fas fa-shopping-basket"></i></span>
        </div>
        <div class="compraStatus">
            <div class="compraStatusTitulo">
                <span id="bonus">Bônus para Aquisição</span>
                <div class="bonusValores">
                    <span id="valor">Valor da Cesta: R$ 220,00</span>
                    <?php if(!isset($dadosUser['data_ativacao']) && $dadosUser['data_ativacao'] <= 0):?>
                    <span id="valor">Valor Ativação: R$ 80,00</span>
                    <?php endif;?>
                </div>
            </div>
            <div class="compraStatusDados">
                <div class="compraStatusValores" style="width:95%">
                    <?php if(isset($premios['total']) && $premios['total'] > 0) :?>
                    <span style="padding-left: <?php echo number_format($n, 0);?>%; padding-right:20px ">                        
                        <?php echo 'R$ '.number_format($premios['total'], 2, ',', '.');?>
                        <?php else: $premios['total'] = 0;?>
                        <?php echo 'R$ '.number_format($premios['total'], 2, ',', '.');?>
                        <?php endif; ?>
                    </span>
                    
                </div>
                <div class="compraStatusBarra">
                    <div id="barraBonus" style="width: <?php echo number_format($n, 0);?>%"></div>
                    <div id="barraGeral" style="width: <?php echo 100-$n;?>%"></div>
                    
                </div>
            </div>
        </div>
        <div class="compraButton">
            <div class="compraValor">
                <h5>A Pagar</h5>
                <span><?php if($v < 0) {$v = 0;}echo 'R$ '.number_format($v, 2, ',', '.');?></span>
            </div>
            <div class="button">
                <form method="POST" action="<?php echo BASE_URL;?>transacoes/comprar">        
                    <input name="qtde" type="hidden" value="1" />
                    <input type="hidden" value="<?php echo $v;?>" name="valor" />
                    <input type="hidden" value="<?php echo $premios['total'];?>" name="resgatado" />
                    <input type="button" class="btn-warning" value="Comprar" onclick="comprar()"/>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal Compra Efetuada-->
<div class="modal fade" role='dialog' id='compraSucesso' >
<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notificação</h4>
      </div>
        <div class="modal-body"> 
            <div>
                <h3>Compra Efetuada com Sucesso</h3>
            </div>
            <div class="protocolo">
                <p> <strong>Protocolo: </strong></p>
                <p id="protocolo"></p>
            </div>                  
        </div>        
        <div class="modal-footer" id="modalFooterCompra">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>-->
        <form method="post" action="https://geraboleto.sicoobnet.com.br/geradorBoleto/GerarBoleto.do" name="formSicoob" target="_blanc">     
        <input type="submit" class="btn-primary" value="Imprimir Boleto" onclick="fecharComprar()" id="buttonImprimirBoleto"/>
        <input name="numCliente" type="hidden" value="1061712"  />
        <input name="coopCartao" type="hidden" value="3169"  />
        <input name="chaveAcessoWeb" type="hidden" value="AFE5B061-485C-4729-B3DD-49CBF354744A"  />
        <input name="numContaCorrente" type="hidden" value="134120"  />
        <input name="codMunicipio" type="hidden" value="11037"  />     
        <input  maxlength="50" name="nomeSacado" type="hidden" value="<?php echo $dadosUser['name'];?>"/><br/><br/>
        <input  maxlength="14" name="cpfCGC" type="hidden" value="<?php echo $dadosUser['cpf'];?>"/><br/><br/>
        <input  maxlength="20" name="endereco" type="hidden" value="<?php echo $perfil['dados']['rua'];?>"/><br/><br/>
        <input maxlength="15" name="bairro" type="hidden" value="<?php echo $perfil['dados']['bairro'];?>"/><br/><br/>
        <input  maxlength="15" name="cidade" type="hidden" value="<?php echo $perfil['dados']['cidade'];?>"/><br/><br/>
        <input  maxlength="8" name="cep" type="hidden"  value="<?php echo $perfil['dados']['cep'];?>"/><br/><br/>
        <input  maxlength="2" name="uf" type="hidden" value="<?php echo $perfil['dados']['estado'];?>"/>
        <input name="codEspDocumento" type="hidden" value="DM"  />
        <input name="dataEmissao" type="hidden"  value="<?php echo date("Ymd");?>"/>
        <input name="seuNumero" id="seuNumero" type="hidden"  value="1001"/>
        <input name="nomeSacador" type="hidden"  />
        <input name="numCGCCPFSacador" type="hidden" />
        <input name="qntMonetaria" type="hidden"  value="5"/>
        <input name="valorTitulo" type="hidden"  value="<?php echo $v;?>"/>
        <input name="codTipoVencimento" type="hidden" value="1"/>
        <input name="dataVencimentoTit" type="hidden"  value="<?php echo date("Ymd")+1;?>"/>
        <input name="valorAbatimento" type="hidden" value="0"  />
        <input name="valorIOF" type="hidden" value="0"  />
        <input name="bolAceite" type="hidden" value="1" />
        <input name="percTaxaMulta" type="hidden" value="0"  />
        <input name="percTaxaMora" type="hidden" value="0"  />      
        <input name="dataPrimDesconto" type="hidden"  />
          <!-- Valor primeiro desconto: --><input name="valorPrimDesconto" type="hidden" value="0" />    
        <input name="dataSegDesconto" type="hidden"  />
        <input name="valorSegDesconto" type="hidden" value="0"  />      
        <input name="descInstrucao1" type="hidden"  />      
        <input name="descInstrucao2" type="hidden"  />      
        <input name="descInstrucao4" type="hidden"  />      
        <input name="descInstrucao3" type="hidden"  />      
        <input name="descInstrucao5" type="hidden"  />      
        
  </form>
        </div>
    </div>

  </div>
</div>

<!--Modal Endereco Invalido-->
<div class="modal fade" role='dialog' id='enderecoInvalido' >
<div class="modal-dialog" id="modal-endereco-compra">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Favor Preencher Endereço</h4>
      </div>
        <div class="modal-body" id="modal-endereco-compra"> 
            <div class="dadosPessoais-form">    
        <div class="form-group col-md-4">
                <label>CEP:</label>
                <input type="text" class="form-control" id="cepComprar" name="cepComprar" OnKeyPress="formatar('##.###-###', this)"
                       maxlength="10" onblur="prenchecepComprar(this.value);">
            </div> 
            <div class="form-group col-md-10">
                <label>Rua:</label>
                <input type="text" class="form-control" id="ruaComprar" name="ruaComprar" >
            </div>
            <div class="form-group col-md-2">
                <label>Numero:</label>
                <input type="text" class="form-control" id="numeroComprar" name="numeroComprar" >
            </div>
            <div class="form-group col-md-7">
                <label>Complemento:</label>
                <input type="email" class="form-control" id="complementoComprar" name="complementoComprar" >
            </div>
            <div class="form-group col-md-5">
                <label>Bairro:</label>
                <input type="text" class="form-control" id="bairroComprar" name="bairroComprar" >
            </div>            
            <div class="form-group col-md-5">
                <label>Cidade:</label>
                <input type="text" class="form-control" id="cidadeComprar" name="cidadeComprar" >
            </div>
            <div class="form-group col-md-2">
                <label>UF:</label>
                <input type="text" class="form-control" id="ufComprar" name="ufComprar" maxlength="2" >
            </div>           
            <div class="form-group col-md-12">
                <button type="button" class="btn btn-primary" onclick="editEnderecoComprar()">Salvar</button>
            </div>          
    </div>
                          
        </div>        
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        
        </div>
    </div>

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
                <h4>Endereco Cadastrado com Sucesso</h4>
            </div>
                          
        </div>        
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        
        </div>
    </div>

  </div>
</div>