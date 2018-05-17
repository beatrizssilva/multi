<?php

class usuarioscontroller extends controller {
 
    //apaga a sessão multLogin
    public function logout() {
        unset($_SESSION['multLogin']);
        header("Location: ".BASE_URL);        
    }
    public function login() {
        global $config;
    
        $dados = array();
        $u = new usuarios();
        $c = new comissao();
        
        if(isset($_POST['nome']) && !empty ($_POST['nome'])) {
            $id = addslashes($_POST['nome']);
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
                    
                    echo '1';
                  
                } else {
                    echo '0';
                    
        }}
//        header("Location: ".BASE_URL);        
    }
    
    public function addDependente() {
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $u = new usuarios();
            
            $relacao = addslashes($_POST['relacao']);
            $nome = strtoupper(addslashes($_POST['nome'])); 
            $nasc2 = addslashes($_POST['nasc']); 
            $nasc1 = explode('/', $nasc2);
            $nasc = $nasc1[2].$nasc1[1].$nasc1[0];
            $documento = addslashes($_POST['documento']); 
            $id = $_SESSION['multLogin'];
            $u->setDependente($id, $nome, $relacao, $nasc, $documento);
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }

    public function dellDependente() {
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $u = new usuarios();
            
            $id = addslashes($_POST['id']);
            
            $u->apagarDependente($id);
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }

    public function verifyEndereco() {
        
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $u = new usuarios();
      
            $id = strtoupper(addslashes($_POST['id']));
            $end = $u->getEndereco($id);
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }

    public function setEndereco(){
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
        $u = new usuarios();
        $id = $_SESSION['multLogin'];
        $rua = strtoupper(addslashes($_POST['rua']));
        $numero = addslashes($_POST['numero']);
        $complemento = strtoupper(addslashes($_POST['complemento']));
        $bairro = strtoupper(addslashes($_POST['bairro']));
        $cidade = strtoupper(addslashes($_POST['cidade']));
        $uf = strtoupper(addslashes($_POST['uf']));
        
        $n = addslashes($_POST['cep']);
        $n2 = explode('.', $n);
        $n1 = $n2[0].$n2[1];
        $n3 = explode('-', $n1);
        $cep = $n3[0].$n3[1];
        
        $u->editEndereco($id, $rua, $numero, $complemento, $bairro, $cidade, $uf, $cep);
        
        
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }
    
    public function setDados(){
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
        $u = new usuarios();
        $id = $_SESSION['multLogin'];
        $d = addslashes($_POST['date']);
        $d2 = str_split($d);
        
        $date = $d2[6].$d2[7].$d2[8].$d2[9].'-'.$d2[3].$d2[4].'-'.$d2[0].$d2[1];
        
        $tel1 = addslashes($_POST['tel']);
        $tel2 = explode('-', $tel1);
        $tel = $tel2[0].$tel2[1].$tel2[2];
        
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        
        $pis = addslashes($_POST['pis']);
        $rg = addslashes($_POST['rg']);
        
        $u->editDados($id, $date, $nome, $email, $tel, $pis, $rg, $senha);
        
        
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }

    public function editFoto(){
        $u = new usuarios();
        
        $id = addslashes($_POST['idPerfil']);
        $nome1 = addslashes($_POST['namePerfil']);
        $nome = explode(' ', $nome1);        
        $name = strtolower($nome[0]).'.jpg';
        $dados['nome'] = strtolower($name);
        
        if(isset($_FILES['imagemPerfil'])) {
            $dados['arquivo'] = $_FILES['imagemPerfil'];
            move_uploaded_file($dados['arquivo']['tmp_name'], 'assets/images/perfil/'.$name);
            $u->editFoto($id, $name);
        }
        
        header("Location: ".BASE_URL);
    }

    public function dadosAfiliados(){
        $u = new usuarios();
        
        $id = addslashes($_POST['id']);
        
        if(!empty($id)) {
            $array = $u->getDadosAfiliados($id);
            echo json_encode($array);
            exit();
        }
    }

    public function cadastrar() {
        $u = new usuarios();        
                
        $email = strtolower(addslashes($_POST['email']));
        $nome = strtoupper(addslashes($_POST['nome'])); 
        $cpf = addslashes($_POST['cpf']);
        $id = addslashes($_POST['id']); 
        $senha = addslashes($_POST['senha']);
        if(isset($_POST['convite']) && !empty($_POST['convite'])){
        $convite = addslashes($_POST['convite']);
        } else {
            $convite = '';
        }
       

        if($u->setNewUser($email, $nome, $senha, $id, $cpf, $convite)){
            echo '1';
        } else {
            echo '0';
        }        
    }  
    
    public function cadastro(){
        $dados = array();
        unset($_SESSION['multLogin']);
        $this->loadTemplateLogin('cadastrar', $dados);
    }
    
    public function pesquisarID($id) {

        $u = new usuarios();
        if($u->verifyID($id)) {          
            echo '1';
        } else {
            echo '0';
        }     
    }
    
    public function pesquisarCPF($cpf) {

        $u = new usuarios();
        if($u->verifyCPF($cpf)) {          
            echo '1';
        } else {
            echo '0';
        }     
    }
    
    public function pesquisarEmail($email) {

        $u = new usuarios();
        if($u->verifyEmail($email)) {          
            echo '1';
        } else {
            echo '0';
        }     
    }
    public function pesquisarConvite($convite) {

        $u = new usuarios();
        if($u->verifyConvite($convite)) {          
            echo '1';
        } else {
            echo '0';
        }     
    }
    public function validaCPF($cpf) {
         //validação do CPF
        
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        $digitoA = 0;
        $digitoB = 0;
        if(strlen($cpf) < 11) {
            echo '1';
            exit();
        };
        for ($i=0, $x=10;$i<=8;$i++, $x--) {
            $digitoA += $cpf[$i] *$x;
        }
        for ($i=0, $x=11;$i<=9;$i++, $x--) {
                if(str_repeat($i, 11) == $cpf) {
                     echo '1';
                     exit();
                }
                $digitoB += $cpf[$i] *$x;            
            }     
        //% = quociente, ou seja o resto da divisão, no caso abaixo é o resto de $digitoA divido por 11, exemplo: 20/11= 1 e resto 9, 9 é o quociente
        $somaA = (($digitoA%11) < 2) ? 0 : 11-($digitoA%11);
        $somaB = (($digitoB%11) < 2) ? 0 : 11-($digitoB%11);
        //indice 9 é o nono digito do CPF
        if($somaA != $cpf[9] || $somaB != $cpf[10]) {        
            echo '1';
        } else {
             echo '0';
        }        
    }
    
    public function convite(){
        $u = new usuarios();
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
            $email = addslashes($_POST['email']);
            $nome = addslashes($_POST['nome']); 
            $identificador = addslashes($_POST['identificador']); 
            $name = addslashes($_POST['name']); 
            
            if(isset($nome) && !empty($nome) && isset($email) && !empty($email)){
               
                $convite = $u->convidar($nome, $email, $identificador, $name);
                
                if(isset($convite) && !empty($convite)){
                    echo '1';
                } 
            }
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }
    
    public function apagarConvite(){
        $u = new usuarios();
//         if(isset($_POST['convite']) && !empty($_POST['convite'])){
            $convite = addslashes($_POST['convite']);
            $u->dellConvite($convite);
            
//         }
    }
}

