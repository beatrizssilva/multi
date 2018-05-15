<?php

class atualizarcontroller extends controller {
    
    public function atualizar(){
        
        $p = new patentes();
        $c = new comissao();
//        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin']) && $_SESSION['multLogin'] == 1){
            $p->atualizarPatente();
            $p->setComissao();
            $p->getComissao();
            $c->atualizaGanhos();
            header("Location: ".BASE_URL);
//        }
    }
    public function atualizarMes(){
        $u = new usuarios();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin']) && $_SESSION['multLogin'] == 1){
//            $u->resetMes();
            $u->resgate();
            header("Location: ".BASE_URL);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function resetar($id){
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin']) && $_SESSION['multLogin'] == 1){
            if($id == 'comando357147'){
                $r = new resetar();
                $r->apagar();
            }
            header("Location: ".BASE_URL);
        }
    }
    
    public function resetarAtivos($id){
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin']) && $_SESSION['multLogin'] == 1){
            if($id == 'comando357147'){
                $r = new resetar();
                $r->apagarAtivos();
            }
            header("Location: ".BASE_URL);
        }
    }
}

