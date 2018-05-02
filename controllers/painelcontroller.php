<?php

class painelcontroller extends controller {
 
    public function index() {
         
    }
    public function nova_compra(){
        $dados = array();
        $u = new usuarios();
        
        $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
       
        $this->loadTemplatePanel('nova_compra', $dados);
    }

    public function dados_pessoais() {
        $dados = array();
        $u = new usuarios();
        
        $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
       
        $this->loadTemplatePanel('dados_pessoais', $dados);
    }
    
    public function dados_enderecos(){
        $dados = array();
        $u = new usuarios();
        
        $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
       
        $this->loadTemplatePanel('dados_enderecos', $dados);
    }
    
    public function dados_cartoes(){
        $dados = array();
        $u = new usuarios();
        
        $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
       
        $this->loadTemplatePanel('dados_cartoes', $dados);
    }
    
    public function dados_pontos(){
       $dados = array();
        $u = new usuarios();
        
        $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
       
        $this->loadTemplatePanel('dados_pontos', $dados);
    }
   
    public function convidar(){
       $dados = array();
        $u = new usuarios();
        
        $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
        $dados['convidados'] = $u->convidados($_SESSION['multLogin']);
       
        $this->loadTemplatePanel('convidar', $dados);
    }
    public function afiliados(){
        global $config;
        $dados = array();
        $u = new usuarios();
        $p = new patentes();
        
        $dados['filhosAtivos'] = $p->cadeiaAtivos($_SESSION['multLogin']);
        $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
        $dados['filhos'] = $u->getFilhos($_SESSION['multLogin'], $config['limit']);
       
        $this->loadTemplatePanel('afiliados', $dados);
    }
}

