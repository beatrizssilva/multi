<?php

class homecontroller extends controller {
    public function index() {
    $dados = array();
    $u = new usuarios();
    
    if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
        
        $this->loadTemplate('home', $dados);
        } else if(isset($_POST['email']) && !empty ($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
                if($u->verifyUser($email, $senha)) {
                    $dados['user'] = $u->getUser($email, $senha);
                    $_SESSION['multLoginName'] = $dados['user']['name'];
                    $_SESSION['multLogin'] = $dados['user']['id'];
                    $this->loadTemplate('home', $dados);
                  
                } else {
                    $dados['msg'] = "E-mail ou Senha Incorretos. Tente Novamente.";
                    $this->loadTemplate('login', $dados);
                }
            
            } else {
                $this->loadTemplate('login', $dados);
            }
    }
    
   
}

