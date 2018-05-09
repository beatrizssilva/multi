<?php

class usuarioscontroller extends controller {
 
    //apaga a sessão multLogin
    public function logout() {
        unset($_SESSION['multLogin']);
        header("Location: ".BASE_URL);        
    }
    public function login() {
        
        header("Location: ".BASE_URL);        
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
                
        $email = addslashes($_POST['email']);
        $nome = addslashes($_POST['nome']); 
        $cpf = addslashes($_POST['cpf']);
        $id = addslashes($_POST['id']); 
        $senha = addslashes($_POST['senha']);
        $convite = addslashes($_POST['convite']);
       

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

