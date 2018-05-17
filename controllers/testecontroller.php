<?php

class testecontroller extends controller {
 
    
    public function relatorio_pagamento() {
        $dados = array();
        
        $u = new usuarios();
            
            $dados['premios'] = $u->getValorResgate($_SESSION['multLogin']);
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
        $this->loadTemplatePanel('layout_pagamento', $dados);
    }
    
    public function relatorio_cadastro() {
        
    $dados = array();
        
        $u = new usuarios();
            
            $dados['premios'] = $u->getValorResgate($_SESSION['multLogin']);
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
        $this->loadTemplatePanel('layout_cadastro', $dados);
    }
   
}

