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
        $dados['kits_vendidos'] = $this->comissao_ativo();
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
                    $dados['kits_vendidos'] = $this->comissao_ativo();
                    $this->loadTemplate('painel', $dados);
                    
                  
                } else {
                    $dados['msg'] = "E-mail ou Senha Incorretos. Tente Novamente.";
                    $this->loadTemplate('login', $dados);
                }
            
            } else {
                $this->loadTemplate('login', $dados);
            }
    }
    
    public function comissao_ativo(){
        global $config;
        $dados = array();
        $c = new comissao();
        $dados['comissao'] = $c->calcularComissao($_SESSION['multLogin'], $config['limit']);
        $total = array();
         $total['venda'] = 0;
        foreach ($dados['comissao'] as $usuario){ 
//             echo '<pre>';
//        echo '-'.$usuario['name'].': '.$usuario['compras'];
        $total['venda'] += $usuario['compras'];
//        echo '<br/>';
             if(count($usuario['filhos']) > 0) {
                 foreach ($usuario['filhos'] as $filho){ 
//                echo '--'.$filho['name'].': '.$filho['compras'];   
                    $total['venda'] += $filho['compras'];
//                echo '<br/>';
                    if(count($filho['filhos']) > 0) {
                        foreach ($filho['filhos'] as $filho){ 
//                        echo '---'.$filho['name'].': '.$filho['compras'];   
                            $total['venda'] += $filho['compras'];
//                        echo '<br/>';
                            if(count($filho['filhos']) > 0) {
                                foreach ($filho['filhos'] as $filho){ 
//                                echo '----'.$filho['name'].': '.$filho['compras'];   
                                    $total['venda'] += $filho['compras'];
//                                echo '<br/>';
                                    if(count($filho['filhos']) > 0) {
                                        foreach ($filho['filhos'] as $filho){ 
//                                        echo '-----'.$filho['name'].': '.$filho['compras'];   
                                            $total['venda'] += $filho['compras'];
//                                        echo '<br/>';
                                        }
                                    }
                                }
                            }
                        }
                   }
                 }
            }        
         }
         
         return $total;
        
    }
    
    
}

