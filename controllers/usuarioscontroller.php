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
        global $config;
        if(!empty($_POST['nome']) && !empty ($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $nome = addslashes($_POST['nome']);            
            //setNewUser -> envia os dados para novo cadastro
            $u->setNewUser($email, $nome);
            //getFilhos -> seleciona a arvore até a 5ª geração definida na global $config
            $dados['filhos'] = $u->getFilhos($_SESSION['multLogin'], $config['limit']);
            //envia mensagem
            $dados['msg'] = "Cadastro Realizado com Sucesso.";
            //getDadosUser -> seleciona as informações do usuario
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            //getPremios -> seleciona a premiação do usuario
            $dados['premios'] = $c->getPremios($_SESSION['multLogin']);
            $this->loadTemplate('painel', $dados);
        } else {
            //getFilhos -> seleciona a arvore até a 5ª geração definida na global $config
            $dados['filhos'] = $u->getFilhos($_SESSION['multLogin'], $config['limit']);            
            //getDadosUser -> seleciona as informações do usuario
            $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
            //getPremios -> seleciona a premiação do usuario
            $dados['premios'] = $c->getPremios($_SESSION['multLogin']);
            $dados['msg'] = "Preencha todos os campos.";
            $this->loadTemplate('painel', $dados);
        }
    }
    
//    public function patentes(){
//        global $config;
//        $dados = array();
//        $u = new usuarios();
//        $dados['patente'] = $u->patente();
//        $this->loadTemplate('teste', $dados);
//    }
   
}

