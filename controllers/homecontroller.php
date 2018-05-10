<?php

class homecontroller extends controller { 
    
    public function index() {
    global $config;
    
    $dados = array();
    $u = new usuarios();
    $c = new comissao();
    
    
    if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
        //getDadosUser -> seleciona as informações do usuario
        $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
        
        //getFilhos -> seleciona a arvore até a 5ª geração definida na global $config
        $dados['filhos'] = $u->getFilhos($_SESSION['multLogin'], $config['limit']);
        
        //getPremios -> seleciona a premiação do usuario
        $dados['premios'] = $c->getPremios($_SESSION['multLogin']);
        
        $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
        
        $this->loadTemplatePanel('painel', $dados);
        
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }   
   
}

