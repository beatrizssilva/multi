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
        
        } else if(isset($_POST['name']) && !empty ($_POST['name'])) {
            $id = addslashes($_POST['name']);
            $senha = addslashes($_POST['senha']);
                
                //verifyUser-> verifica o login do usuario
                if($u->verifyUser($id, $senha)) {
                    //getUser -> seleciona o id e nome do usuario após logar
                    $dados['user'] = $u->getUser($id, $senha);
                    $_SESSION['multLoginName'] = $dados['user']['name'];
                    $_SESSION['multLogin'] = $dados['user']['id'];
                    
                    //getDadosUser -> seleciona as informações do usuario
                    $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
                    
                    //getFilhos -> seleciona a arvore até a 5ª geração definida na global $config
                    $dados['filhos'] = $u->getFilhos($_SESSION['multLogin'], $config['limit']);
        
                    //getPremios -> seleciona a premiação do usuario
                    $dados['premios'] = $c->getPremios($_SESSION['multLogin']);
                    
                    $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
                    
                    $this->loadTemplatePanel('painel', $dados);
                    
                  
                } else {
                    $dados['msg'] = "E-mail ou Senha Incorretos. Tente Novamente.";
                    $this->loadTemplateLogin('login', $dados);
                }
            
            } else {
                $this->loadTemplateLogin('login', $dados);
            }
    }   
   
}

