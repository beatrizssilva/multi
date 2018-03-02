<?php

class atualizarcontroller extends controller {
    
    public function patentes(){
        global $config;
        $dados = array();
        $u = new usuarios();
        $dados['patente'] = $u->patente();
        
    }
}

