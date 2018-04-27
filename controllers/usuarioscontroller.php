<?php

class usuarioscontroller extends controller {
 
    //apaga a sessão multLogin
    public function logout() {
        unset($_SESSION['multLogin']);
        header("Location: ".BASE_URL);        
    }
    
    public function cadastrar() {
        $u = new usuarios();
        $dados = array();
        
        if(!empty($_POST['nome']) && !empty ($_POST['email'])  && !empty ($_POST['cpf']) && !empty ($_POST['id']) 
                && !empty ($_POST['senha']) && !empty ($_POST['senha2'])) {
            $senha = addslashes($_POST['senha']);
            $senha2 = addslashes($_POST['senha2']);
            
            if ($senha == $senha2){
            $email = addslashes($_POST['email']);
            $nome = addslashes($_POST['nome']); 
            $cpf = addslashes($_POST['cpf']);
            $id = addslashes($_POST['id']); 
            $senha = addslashes($_POST['senha']);

            $dados['nome'] = $nome;
            $dados['email'] = $email;
            $dados['id'] = $id;
            $dados['cpf'] = $cpf;

                if($u->verifyEmail($email)) {
                    $dados['op'] = 0;
                    $dados['msg'] = "E-mail já Cadastrado.";
                    $this->loadTemplatePanel('cadastrar', $dados);
                } else if($u->verifyID($id)) {
                    if($u->setNewUser($email, $nome, $senha, $id, $cpf)){
                        $dados['op'] = 0;
                        $dados['login'] = 1;
                        $dados['msg'] = "Cadastro realizado com sucesso.";
                        $this->loadTemplateLogin('cadastrar', $dados);
                    }
                } else {
                    $dados['op'] = 0;
                    $dados['msg'] = "ID Incorreto.";
                    $this->loadTemplateLogin('cadastrar', $dados);
                }           

            } else {
                $dados['op'] = 0;
                $dados['msg'] = "Senhas não são iguais.";
                $this->loadTemplateLogin('cadastrar', $dados);
            }
        } else {
            if (!empty($_POST['nome'])) {
                $nome = addslashes($_POST['nome']);
                $dados['nome'] = $nome;
            }
            if (!empty($_POST['email'])) {
                $email = addslashes($_POST['email']);
                $dados['email'] = $email;
            }
            if (!empty($_POST['cpf'])) {
                $cpf = addslashes($_POST['cpf']);
                $dados['cpf'] = $cpf;
            }
            if (!empty($_POST['id'])) {
                $id = addslashes($_POST['id']);
                $dados['id'] = $id;
            }
            $dados['op'] = 0;
            $dados['msg'] = "Preencha todos os campos.";
            $this->loadTemplateLogin('cadastrar', $dados);
        }
    }  
    
    public function cadastro(){
        $dados = array();
        unset($_SESSION['multLogin']);
        $this->loadTemplateLogin('cadastrar', $dados);
    }
}

