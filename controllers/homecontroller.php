<?php

class homecontroller extends controller { 
   
    public function index() {
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
        global $config;
    
        
        $u = new usuarios();
        $c = new comissao();
        $ip = $_SERVER['REMOTE_ADDR'];
        if($u->getIpUser($ip, $_SESSION['multLogin'])){
            unset($_SESSION['multLogin']);
            header("Location: ".BASE_URL); 
        }
    
    
        //getDadosUser -> seleciona as informações do usuario
        $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
        
        //getFilhos -> seleciona a arvore até a 5ª geração definida na global $config
//        $dados['filhos'] = $u->getFilhos($_SESSION['multLogin'], $config['limit']);
        
        //getPremios -> seleciona a premiação do usuario
        $dados['premios'] = $c->getPremios($_SESSION['multLogin']);
        
        $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
        $dados['dados'] = $u->Acompanhamento($_SESSION['multLogin']);
        
        $this->loadTemplatePanel('painel', $dados);
        
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }   
   
    public function esqueci(){
        $dados = array();
        
        $this->loadTemplateLogin('esqueci', $dados);
    }
    
}

