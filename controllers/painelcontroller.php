<?php

class painelcontroller extends controller {
 
    public function index() {
         
    }
    public function mensagens() {
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $d = new dados();
            $id = $_SESSION['multLogin'];
            $m = $d->mensagem($id);
        }
        echo json_encode($m);
        exit;
    }

    public function setMensagens(){
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $d = new dados();
            $id = $_SESSION['multLogin'];
            $m = $d->qtdeMensagem($id);
        }
        echo json_encode($m);
        exit;
    }

    public function setNotificacoes(){
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $d = new dados();
            $id = $_SESSION['multLogin'];
            $m = $d->qtdeNotificacoes($id);
        }
        echo json_encode($m);
        exit;
    }
    public function nova_compra(){
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $u = new usuarios();
            $ip = $_SERVER['REMOTE_ADDR'];
            if($u->getIpUser($ip, $_SESSION['multLogin'])){
                unset($_SESSION['multLogin']);
                header("Location: ".BASE_URL); 
            }
            $dados['premios'] = $u->getValorResgate($_SESSION['multLogin']);
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
            $this->loadTemplatePanel('nova_compra', $dados);
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
       
    }

    public function dados_pessoais() {
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $u = new usuarios();
            $ip = $_SERVER['REMOTE_ADDR'];
            if($u->getIpUser($ip, $_SESSION['multLogin'])){
                unset($_SESSION['multLogin']);
                header("Location: ".BASE_URL); 
            }
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
            $this->loadTemplatePanel('dados_pessoais', $dados);
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }
    
    public function dados_enderecos(){
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $u = new usuarios();
            $ip = $_SERVER['REMOTE_ADDR'];
            if($u->getIpUser($ip, $_SESSION['multLogin'])){
                unset($_SESSION['multLogin']);
                header("Location: ".BASE_URL); 
            }
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
            $this->loadTemplatePanel('dados_enderecos', $dados);
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }
    
    public function dados_dependentes(){
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $u = new usuarios();
            $ip = $_SERVER['REMOTE_ADDR'];
            if($u->getIpUser($ip, $_SESSION['multLogin'])){
                unset($_SESSION['multLogin']);
                header("Location: ".BASE_URL); 
            }
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
            $dados['dependentes'] = $u->getDependentes($_SESSION['multLogin']);
            $this->loadTemplatePanel('dados_dependentes', $dados);
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }
    
    public function premios_geral(){
       $dados = array();
       if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){ 
            $u = new usuarios();
            $c = new comissao();
            $ip = $_SERVER['REMOTE_ADDR'];
            if($u->getIpUser($ip, $_SESSION['multLogin'])){
                unset($_SESSION['multLogin']);
                header("Location: ".BASE_URL); 
            }
            $dados['premios'] = $c->getPremios($_SESSION['multLogin']);
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
            $this->loadTemplatePanel('premios_geral', $dados);
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }
   
    public function convidar(){
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){ 
            $u = new usuarios();
            $ip = $_SERVER['REMOTE_ADDR'];
            if($u->getIpUser($ip, $_SESSION['multLogin'])){
                unset($_SESSION['multLogin']);
                header("Location: ".BASE_URL); 
            }
            $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            $dados['convidados'] = $u->convidados($_SESSION['multLogin']);
            if($dados['dadosUser']['ativo'] == 0){
                $this->loadTemplatePanel('painel', $dados);         
            }else{
                $this->loadTemplatePanel('convidar', $dados);
            }
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }
    public function afiliados(){
        global $config;
        $dados = array();
        
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $u = new usuarios();
            $p = new patentes();
            $ip = $_SERVER['REMOTE_ADDR'];
            if($u->getIpUser($ip, $_SESSION['multLogin'])){
                unset($_SESSION['multLogin']);
                header("Location: ".BASE_URL); 
            }
            $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
            $dados['filhosAtivos'] = $p->cadeiaAtivos($_SESSION['multLogin']);
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            $dados['filhos'] = $u->getFilhos($_SESSION['multLogin'], $config['limit']);
            if($dados['dadosUser']['ativo'] == 0){
                $this->loadTemplatePanel('painel', $dados);         
            }else{
                $this->loadTemplatePanel('afiliados', $dados);         
            }
        } else {
            $this->loadTemplateLogin('login', $dados);
        }        
    }    
    
}

