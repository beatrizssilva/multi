<?php

class transacoescontroller extends controller {
    
    public function comprar(){

        $dados = array();
        $u = new usuarios();
        $t = new transacoes();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $id = $_SESSION['multLogin'];
            
            if(isset($_POST['qtde']) && !empty($_POST['qtde'])){
                $qt = addslashes($_POST['qtde']);
            } else {
                $qt = 1;
            }
            $valor = addslashes($_POST['valor']);
            $resgate = addslashes($_POST['resgatado']);
            
            $protocolo = $t->comprando($id, $qt, $valor, $resgate);

            echo json_encode($protocolo);
            exit();
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }
}

