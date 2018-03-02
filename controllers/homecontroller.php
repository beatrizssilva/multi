<?php

class homecontroller extends controller {
  
  
    
    public function index() {
    $dados = array();
    $u = new usuarios();
    global $config;
    if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
        $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
        $dados['filhos'] = $u->getFilhos($_SESSION['multLogin'], $config['limit']);
        $this->loadTemplate('painel', $dados);
        } else if(isset($_POST['name']) && !empty ($_POST['name'])) {
            $name = addslashes($_POST['name']);
            $senha = addslashes($_POST['senha']);
                if($u->verifyUser($name, $senha)) {
                    $dados['user'] = $u->getUser($name, $senha);
                    $_SESSION['multLoginName'] = $dados['user']['name'];
                    $_SESSION['multLogin'] = $dados['user']['id'];
                    $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
                    $dados['filhos'] = $u->getFilhos($_SESSION['multLogin'], $config['limit']);
                    $this->loadTemplate('painel', $dados);
                  
                } else {
                    $dados['msg'] = "E-mail ou Senha Incorretos. Tente Novamente.";
                    $this->loadTemplate('login', $dados);
                }
            
            } else {
                $this->loadTemplate('login', $dados);
            }
    }
    
    
}

