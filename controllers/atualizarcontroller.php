<?php

class atualizarcontroller extends controller {
    
    public function atualizar(){
        $dados = array();
        $p = new patentes();
        $p->atualizarPatente();
        $p->setComissao();
        $p->getComissao();
        header("Location: ".BASE_URL);
    }
    
    public function comissoes(){
        $id = $_SESSION['multLogin'];
        $c = new comissao();
        $dados['comissao'] = $c->getValores($id);
        $this->loadTemplate('testeComissoes', $dados);
    }
}

