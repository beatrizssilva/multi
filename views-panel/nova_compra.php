
<h2>Nova Compra</h2><br>
<?php 
$x = $premios['valor_total'] *100;
$n1 = $x/220;
$n = $n1+1;
$v = 220-$premios['valor_total'];
?>
<div class="dadosCompra">
    <div class="compraGeral">
        <div class="compraIcon">
            <span><i class="fas fa-shopping-basket"></i></span>
        </div>
        <div class="compraStatus">
            <div class="compraStatusTitulo">
                <span id="bonus">Bônus para Aquisição</span>
                <span id="valor">Valor Total: R$ 220,00</span>
            </div>
            <div class="compraStatusDados">
                <div class="compraStatusValores" style="width:100%">
                    <?php if(isset($premios['valor_total']) && $premios['valor_total'] > 0) :?>
                    <span style="padding-left: <?php echo number_format($n, 0)?>%">                        
                        <?php echo 'R$ '.number_format($premios['valor_total'], 2, ',', '.');?>
                        <?php else: $premios['valor_total'] = 0;?>
                        <?php echo 'R$ '.number_format($premios['valor_total'], 2, ',', '.');?>
                        <?php endif; ?>
                    </span>
                    
                </div>
                <div class="compraStatusBarra">
                    <div id="barraBonus" style="width: <?php echo number_format($n, 0)?>%"></div>
                    <div id="barraGeral"></div>
                    
                </div>
            </div>
        </div>
        <div class="compraButton">
            <div class="compraValor">
                <span><?php echo 'R$ '.number_format($v, 2, ',', '.');?></span>
            </div>
            <div class="button">
                <form method="POST" action="<?php echo BASE_URL;?>transacoes/comprar">        
                    <input name="qtde" type="hidden" value="1" />
                    <input type="hidden" value="<?php echo $v;?>" name="valor" />
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
        <input  maxlength="50" name="nomeSacado" type="hidden" value="Daniel Carlos CAndido"/><br/><br/>
        <input  maxlength="14" name="cpfCGC" type="hidden" value="05072923673"/><br/><br/>
        <input  maxlength="20" name="endereco" type="hidden" value="Rua 1"/><br/><br/>
        <input maxlength="15" name="bairro" type="hidden" value="centro"/><br/><br/>
        <input  maxlength="15" name="cidade" type="hidden" value="Pouso Alegre"/><br/><br/>
        <input  maxlength="8" name="cep" type="hidden"  value="37551259"/><br/><br/>
        <input  maxlength="2" name="uf" type="hidden" value="MG"/>
        <input name="codEspDocumento" type="hidden" value="DM"  />
        <input name="dataEmissao" type="hidden"  value="20180507"/>
        <input name="seuNumero" type="hidden"  value="1"/>
        <input name="nomeSacador" type="hidden"  />
        <input name="numCGCCPFSacador" type="hidden" />
        <input name="qntMonetaria" type="hidden"  value="5"/>
        <input name="valorTitulo" type="hidden"  value="10"/>
        <input name="codTipoVencimento" type="hidden" value="1"/>
        <input name="dataVencimentoTit" type="hidden"  value="20180510"/>
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