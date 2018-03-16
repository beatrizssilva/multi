<?php

class testecontroller extends controller {
    
    public function arvore(){
        global $config;
        $id = $_SESSION['multLogin'];
        $dados = array();
        $a = new arvore();
//        $dados['arvore'] = $a->getList();
        $dados['arvore'] = $a->filhosPatentes($id, $config['limit']);
        $this->loadTemplate('teste', $dados);
    }
    
    public function comissao_ativo(){
        global $config;
        $id = $_SESSION['multLogin'];
        $dados = array();
        $c = new comissao();
        $dados['comissao'] = $c->calcularComissao($id, $config['limit']);
        $total = 0;
        
        foreach ($dados['comissao'] as $usuario){ 
             echo '<pre>';
        echo '-'.$usuario['name'].': '.$usuario['compras'];
        $total += $usuario['compras'];
        echo '<br/>';
             if(count($usuario['filhos']) > 0) {
                 foreach ($usuario['filhos'] as $filho){ 
                echo '--'.$filho['name'].': '.$filho['compras'];   
                    $total += $filho['compras'];
                echo '<br/>';
                    if(count($filho['filhos']) > 0) {
                        foreach ($filho['filhos'] as $filho){ 
                        echo '---'.$filho['name'].': '.$filho['compras'];   
                            $total += $filho['compras'];
                        echo '<br/>';
                            if(count($filho['filhos']) > 0) {
                                foreach ($filho['filhos'] as $filho){ 
                                echo '----'.$filho['name'].': '.$filho['compras'];   
                                    $total += $filho['compras'];
                                echo '<br/>';
                                    if(count($filho['filhos']) > 0) {
                                        foreach ($filho['filhos'] as $filho){ 
                                        echo '-----'.$filho['name'].': '.$filho['compras'];   
                                            $total += $filho['compras'];
                                        echo '<br/>';
                                        }
                                    }
                                }
                            }
                        }
                   }
                 }
            }        
         }
         $dados['totalVendas'] = $total;
         echo '<pre>';
        print_r($dados['totalVendas']);
        exit();
        $this->loadTemplate('comissao', $dados);
    }
  
	
}

