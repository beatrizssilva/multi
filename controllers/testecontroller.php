<?php

class testecontroller extends controller {
 
    
    public function codigo() {
        $dados = array();
        
        $token = md5(date('Y-m-d H:i:s').rand(0, 999).rand(0, 999));
        $token1 = str_split($token);
        
        $t = $token1[0].$token1[1].$token1[2].$token1[3];
        
        $dados['token'] = $t;
        $this->loadTemplatePanel('teste', $dados);
    }
    
   
   
}

