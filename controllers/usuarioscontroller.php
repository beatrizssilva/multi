<?php

class usuarioscontroller extends controller {
 
    //apaga a sessão multLogin
    public function logout() {
        unset($_SESSION['multLogin']);
        header("Location: ".BASE_URL);        
    }
    
    public function cadastrar() {
        $u = new usuarios();
        $c = new comissao();
      if(!empty($_GET['id'])){
          
          $dados['id'] = addslashes($_GET['id']); 
          $this->loadTemplate('cadastrar', $dados);
      } else
        if(!empty($_POST['nome']) && !empty ($_POST['email']) && !empty ($_POST['id']) && !empty ($_POST['senha'])) {
            $email = addslashes($_POST['email']);
            $nome = addslashes($_POST['nome']); 
            $id = addslashes($_POST['id']); 
            $senha = addslashes($_POST['senha']);
            
            $dados['nome'] = $nome;
            $dados['email'] = $email;
            $dados['id'] = $id;
            
                    
            if($u->verifyEmail($email)) {
                $dados['op'] = 0;
                $dados['msg'] = "E-mail já Cadastrado.";
                $this->loadTemplate('cadastrar', $dados);
            } else if($u->verifyID($id)) {
                if($u->setNewUser($email, $nome, $senha, $id)){
                    $dados['op'] = 0;
                    $dados['login'] = 1;
                    $dados['msg'] = "Cadastro realizado com sucesso.";
                    $this->loadTemplate('cadastrar', $dados);
                }
            } else {
                $dados['op'] = 0;
                $dados['msg'] = "ID Incorreto.";
                $this->loadTemplate('cadastrar', $dados);
            }           
           
        } else {
            $dados['op'] = 1;
            $dados['msg'] = "Preencha todos os campos.";
            $this->loadTemplate('cadastrar', $dados);
        }
    }  
    
    public function cadastro(){
        $dados = array();
        $this->loadTemplate('cadastrar', $dados);
    }
}

