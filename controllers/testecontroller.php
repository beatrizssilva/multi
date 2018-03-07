<?php

class testecontroller extends controller {
    
    public function arvore(){
        global $config;
        $id = $_SESSION['multLogin'];
        $dados = array();
        $a = new arvore();
//        $dados['arvore'] = $a->getList();
        $dados['arvore'] = $a->filhosPatentes($id, $config['limit']);
        $this->loadTemplate('teste', $dados);
    }
    
    public function comissao_ativo(){
        global $config;
        $id = $_SESSION['multLogin'];
        $dados = array();
        $c = new comissao();
//        $dados['arvore'] = $a->getList();
        $dados['comissao'] = $c->comissao_ativos($id, $config['limit']);
        $this->loadTemplate('comissao', $dados);
    }
}

