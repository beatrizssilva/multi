<?php

class atualizarcontroller extends controller {
    
    public function patentes(){
        global $config;
        $dados = array();
        $p = new patentes();
        $dados['patente'] = $p->patente();
        header("Location: ".BASE_URL);
    }
}

