<?php

class testecontroller extends controller {
    
    public function comissao() {
        global $config;
        $id = $_SESSION['multLogin'];
        $dados = array();
        $consumidor = array();
        $a = new arvore();
        $dados['comissao'] = $a->setComissao();
        $dados['getComissao'] = $a->getComissao();
        $this->loadTemplate('testeComissoes', $dados);
    }


    public function patente(){
        global $config;
        $id = $_SESSION['multLogin'];
        $dados = array();
        $consumidor = array();
        $a = new arvore();
//        $dados['arvore'] = $a->getList();
        $dados['arvore'] = $a->cadeiaPatente($id);
        $this->loadTemplate('teste', $dados);
    }
    
      public function ativacao(){
        global $config;
        $id = $_SESSION['multLogin'];
        $dados = array();
        $a = new arvore();
        $dados['ativacao'] = $a->cadeiaPagamentoAtivacao($id ,$config['limit']);
        $this->loadTemplate('teste', $dados);
    }
    
    
    
    

    public function arvore(){
    
        $id = $_SESSION['multLogin'];
        $dados = array();
        $a = new arvore();
//        $dados['arvore'] = $a->getList();
        $dados['arvore'] = $a->cadeiaCompleta($id);
        $this->loadTemplate('teste2', $dados);
    }
    
    public function comissaoAtivos(){
        global $config;
        $id = $_SESSION['multLogin'];
        $dados = array();
        $c = new comissao();
        $dados['comissao'] = $c->calcularComissao($id, $config['limit']);
        $total = 0;
        
        foreach ($dados['comissao'] as $usuario){ 
//            echo $usuario['name'].': '.$usuario['compras'].'<br/>';
            $total += $usuario['compras'];

            if(count($usuario['filhos']) > 0) {
                foreach ($usuario['filhos'] as $filhos){
//                    echo $filhos['name'].': '.$filhos['compras'].'<br/>';
                    $total += $filhos['compras'];
                    $dados['pontos'] = $this->calcularComprasFilhos($filhos, $total);
                }
            }
                
        }
         $dados['totalVendas'] = $total;
        $this->loadTemplate('comissao', $dados);
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
                    $dados['pontos'] = $this->calcularComprasFilhos($filhos, $total);
                }
            }
                
        }
        
        $total2 += $dados['pontos'];
        $dados['totalPontos'] = $total2;
        
        $this->loadTemplate('comissao', $dados);
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
	
}

