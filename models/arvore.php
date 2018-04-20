<?php   
class arvore extends model {    
  
    //calcular a quantidade de ativos durante o periodo
    public function pagamentoAtivacao($id, $limite) {
        $array = array();
        $res = 0;
        $array['ativos'] = $this->cadeiaPagamentoAtivacao($id, $limite);
        
        $qtde = 0;
        $qtde2 = 0;
        foreach ($array['ativos'] as $ativos){
           
            if($ativos['ativo'] == 1){
                $qtde += 1;
            }     

            $qtde += $ativos['filhosAtivos']['c'];
            $qtde2 += $this->contador($ativos['filhos']);
                
        }
       
        $total = $qtde + $qtde2;        
        return $total;    
    }
    
    protected function contador($ativos){
        $q = 0;
        foreach ($ativos as $filhos){            
            $q += $filhos['filhosAtivos']['c']; 
            if(isset($filhos['filhos']) && !empty($filhos['filhos'])){
                $q += $this->contador($filhos['filhos']);
            }
        }
        if(isset($q) && $q > 0){
            return $q;
        }
    }

    protected function contador2($ativos){
       $q = 0;
        foreach ($ativos as $filhos){            
            $q += $filhos['filhosIndicados']['c']; 
            if(isset($filhos['filhos']) && !empty($filhos['filhos'])){
                $q += $this->contador2($filhos['filhos']);
            }
        }
      
        if(isset($q) && $q > 0){
            return $q;
        }
        
    }
    //função complementar para pagamento de Ativação
    public function cadeiaPagamentoAtivacao($id , $limite){
        $array = array();
      
             
        $sql = "SELECT * FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_dad", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($array as $chave => $usuario){
            
            $sql = "SELECT COUNT(id) as c FROM user WHERE ativo = 1 AND id_dad = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue("id", $usuario['id']);
            $sql->execute();
            if($sql->rowCount() > 0) {
                $array[$chave]['filhosAtivos'] = $sql->fetch(PDO::FETCH_ASSOC);
            }
              $array[$chave]['filhos'] = array();
              if ($usuario['ativo'] == 0) {
                  $limite = $limite+1;
              }
              
                   if($limite > 0){                    
                                   
                    $array[$chave]['filhos'] = $this->cadeiaPagamentoAtivacao($usuario['id'], $limite - 1); 
                }   
            }
           
        }
  
        return $array;
    }
    
    //calcula a quantidade de indicados durante o periodo
    public function pagamentoIndicados($id, $limite) {
        $array = array();
        
        $array['indicados'] = $this->cadeiaPagamentoIndicacao($id, $limite);
        
        $qtde = 0;
        $qtde2 = 0;
        foreach ($array['indicados'] as $ativos){
        $data = explode("-", $ativos['data_ativacao']);
        $mes = date('m');
        if($ativos['ativo'] == 1 && $data[1] == $mes){
            $qtde += 1;
        }
            $qtde += $ativos['filhosIndicados']['c'];  
            $qtde2 += $this->contador2($ativos['filhos']);
                
        }
  
        $total = $qtde + $qtde2;
        return $total; 
    }

    //função complementar para calcular os indicados
    public function cadeiaPagamentoIndicacao($id , $limite){
        $array = array();
      
             
        $sql = "SELECT * FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_dad", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
                        
            $mes = date('m');
            foreach($array as $chave => $usuario){
            
            $sql = "SELECT COUNT(id) as c FROM user WHERE MONTH(data_ativacao) = :mes AND ativo = 1 AND id_dad = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $usuario['id']);
            $sql->bindValue(":mes", $mes);
            $sql->execute();
            if($sql->rowCount() > 0) {
                $array[$chave]['filhosIndicados'] = $sql->fetch(PDO::FETCH_ASSOC);
            }
              $array[$chave]['filhos'] = array();
              if ($usuario['ativo'] == 0) {
                  $limite = $limite+1;
              }
              
                   if($limite > 0){                    
                                   
                    $array[$chave]['filhos'] = $this->cadeiaPagamentoIndicacao($usuario['id'], $limite - 1); 
                }   
            }
           
        }
  
        return $array;
    }
    
    //Pega a cadeia de filhos completa do ID Logado
     public function cadeiaCompleta($id){
        $array = array();
             
        $sql = "SELECT *, (select patent.name from patent where patent.id = user.patent)as patente FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_dad", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array['qtde'] = $sql->rowCount();
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
           
            foreach($array as $chave => $usuario){
                
                $array[$chave]['filhos'] = array();                
                    $array[$chave]['filhos'] = $this->cadeiaCompleta($usuario['id']); 
                    
            }
           
        }
        return $array;
    }    
}