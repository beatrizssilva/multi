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
        } else if(isset($_POST['email']) && !empty ($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
                if($u->verifyUser($email, $senha)) {
                    $dados['user'] = $u->getUser($email, $senha);
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

