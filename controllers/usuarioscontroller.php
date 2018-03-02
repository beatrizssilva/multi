<?php

class usuarioscontroller extends controller {
 
    public function logout() {
       
        $dados = array();
        
        unset($_SESSION['multLogin']);
        header("Location: ".BASE_URL);
        
    }
    
    public function cadastrar() {
        $u = new usuarios();
        global $config;
        if(!empty($_POST['nome']) && !empty ($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $nome = addslashes($_POST['nome']);
            $u->setNewUser($email, $nome);
            $dados['filhos'] = $u->getFilhos($_SESSION['multLogin'], $config['limit']);
            $dados['msg'] = "Cadastro Realizado com Sucesso.";
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            $this->loadTemplate('painel', $dados);
        } else {
            $dados['msg'] = "Preencha todos os campos.";
            $this->loadTemplate('login', $dados);
        }
    }
    
    public function patentes(){
        global $config;
        $dados = array();
        $u = new usuarios();
        $dados['patente'] = $u->patente();
        $this->loadTemplate('teste', $dados);
    }
   
}

