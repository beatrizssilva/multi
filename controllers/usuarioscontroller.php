<?php

class usuarioscontroller extends controller {
 
    public function logout() {
       
        $dados = array();
        
        unset($_SESSION['multLogin']);
        header("Location: ".BASE_URL);
        
    }
    
    public function cadastrar() {
        $u = new usuarios();
        if(!empty($_POST['nome']) && !empty ($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $nome = addslashes($_POST['nome']);
            $u->setNewUser($email, $nome);
            $dados['msg'] = "Cadastro Realizado com Sucesso.";
            $this->loadTemplate('home', $dados);
        } else {
            $dados['msg'] = "Preencha todos os campos.";
            $this->loadTemplate('home', $dados);
        }
    }
   
}

