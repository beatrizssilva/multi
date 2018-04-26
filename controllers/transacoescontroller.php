<?php

class transacoescontroller extends controller {
    
    public function comprar(){

        $dados = array();
        
        $t = new transacoes();
        
        $id = $_SESSION['multLogin'];
        if(isset($_POST['qtde']) && !empty($_POST['qtde'])){
            $qt = addslashes($_POST['qtde']);
        } else {
            $qt = 1;
        }
        
        $dados['logado'] = $id;
        $dados['qt'] = $qt;
        $dados['transacao'] = $t->comprando($id, $qt);
        
        $this->loadTemplatePanel('comprar', $dados);
    }
}

