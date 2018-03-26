<?php

class atualizarcontroller extends controller {
    
    public function atualizar(){
        $dados = array();
        $p = new patentes();
        $dados['patente'] = $p->atualizarPatente();
        header("Location: ".BASE_URL);
    }
    
    public function comissoes(){
        $id = $_SESSION['multLogin'];
        $c = new comissao();
        $dados['comissao'] = $c->getValoresBronze($id);
        $this->loadTemplate('testeComissoes', $dados);
    }
}

