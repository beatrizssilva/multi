<?php

class homecontroller extends controller {
  
  
    
    public function index() {
    global $config;
    
    $dados = array();
    $u = new usuarios();
    $c = new comissao();
    
    if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
        $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
        $dados['filhos'] = $u->getFilhos($_SESSION['multLogin'], $config['limit']);
        $dados['ativacao'] = $this->ativacaoMesAtual($_SESSION['multLogin']);
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
                    $dados['ativacao'] = $this->ativacaoMesAtual($_SESSION['multLogin']);
                    $this->loadTemplate('painel', $dados);
                    
                  
                } else {
                    $dados['msg'] = "E-mail ou Senha Incorretos. Tente Novamente.";
                    $this->loadTemplate('login', $dados);
                }
            
            } else {
                $this->loadTemplate('login', $dados);
            }
    }
    
    public function comissaoAtivos(){
        global $config;
        $id = $_SESSION['multLogin'];
        $dados = array();
        $c = new comissao();
        $dados['comissao'] = $c->calcularComissao($id, $config['limit']);
        $total = 0;
        
//        foreach ($dados['comissao'] as $usuario){ 
////            echo $usuario['name'].': '.$usuario['compras'].'<br/>';
//            $total += $usuario['compras'];
//
//            if(count($usuario['filhos']) > 0) {
//                foreach ($usuario['filhos'] as $filhos){
////                    echo $filhos['name'].': '.$filhos['compras'].'<br/>';
//                    $total += $filhos['compras'];
//                    $dados['pontos'] = $this->calcularComprasFilhos($filhos, $total);
//                }
//            }
//                
//        }
         
         return $total;
        
    }
    
    public function contagemPontosTotal(){
        $id = $_SESSION['multLogin'];
        $dados = array();
        $c = new comissao();
        $array = $c->calcularPontosTotal($id);
        $total = 0;
        $total2 = 0;
       
        foreach ($array as $usuario){ 
//            echo $usuario['name'].': '.$usuario['compras'].'<br/>';
            $total += $usuario['compras'];
            if(count($usuario['filhos']) > 0) {
                foreach ($usuario['filhos'] as $filhos){
//                    echo $filhos['name'].': '.$filhos['compras'].'<br/>';
                    $total += $filhos['compras'];
                    $total2 = $this->calcularComprasFilhos($filhos, $total);
                }
            }
        }return $total2;
    }
    
    function calcularComprasFilhos($array, &$total) {
    $soma = 0;
  
        if(isset($array['filhos']) && count($array['filhos']) > 0) {
            foreach($array['filhos'] as $filho) {
//               echo $filho['name'].': '.$filho['compras'].'<br/>';
                $soma += $filho['compras'];
                $this->calcularComprasFilhos($filho, $total);
            }
        }
    $total += $soma;
    return $total;
}
    public function ativacaoMesAtual($id) {
        $c = new comissao();
        
                
        $ativacao = $c->calcularAtivacao($id);
        
        return $ativacao;
        
    }
}

