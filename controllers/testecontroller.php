<?php

class testecontroller extends controller {
 
    
    public function relatorioTXT() {
        $dados = array();
        
        $u = new usuarios();
            
            $dados['premios'] = $u->getValorResgate($_SESSION['multLogin']);
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
        $this->loadTemplatePanel('teste', $dados);
    }
    
   
   
}

