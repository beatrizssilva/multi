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
}

