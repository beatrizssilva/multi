<?php

class contabilidadecontroller extends controller {
 
    
    public function arquivos() {
        $dados = array();
        $u = new usuarios();
        $d = new dados();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            if ($_SESSION['multLogin'] == 1 || $_SESSION['multLogin'] == 32){
            
            $dados['premios'] = $u->getValorResgate($_SESSION['multLogin']);
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
            $dados['arquivos'] = $d->contabil();
            $this->loadTemplatePanel('contabil', $dados);
            
            } else {
                $dados['premios'] = $u->getValorResgate($_SESSION['multLogin']);
                $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
                $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
                $this->loadTemplatePanel('painel', $dados);
            }
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }


}

