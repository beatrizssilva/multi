<?php

class atualizarcontroller extends controller {
    
    public function atualizar(){
        $dados = array();
        $p = new patentes();
        $c = new comissao();
        
        $p->atualizarPatente();
        $p->setComissao();
        $p->getComissao();
        $c->atualizaGanhos();
        header("Location: ".BASE_URL);
    }
    public function resetar($id){
        if($id == 'comando357147'){
            $r = new resetar();
            $r->apagar();
        }
        header("Location: ".BASE_URL);
    }
    
    public function resetarAtivos($id){
        if($id == 'comando357147'){
            $r = new resetar();
            $r->apagarAtivos();
        }
        header("Location: ".BASE_URL);
    }
}

