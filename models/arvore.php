<?php
class arvore extends model {    
    
    public function filhosPatentes($id, $limite){
        $array = array();
        
        $sql = "SELECT patent FROM user WHERE id = :id";
        $sql= $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $pat = $sql->fetch(PDO::FETCH_ASSOC);
            $patent = intval($pat['patent']);
        }
        
        $sql = "SELECT *, (select patent.name from patent where patent.id = user.patent)as patente FROM user WHERE id_dad = :id_dad AND ativo = 1 AND patent <= :patent";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_dad", $id);
        $sql->bindValue(":patent", $patent);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array['qtde'] = $sql->rowCount();
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($array as $chave => $usuario){
                $array[$chave]['filhos'] = array();
                 
                if($limite > 0){
                    
                    $array[$chave]['filhos'] = $this->filhosPatentes($usuario['id'], $limite - 1);
                    
                }
            }
           
        }
        return $array;
    }
    
    public function pagamentoAtivacao($id, $limite) {
        $array = array();
        
        $array['ativados'] = $this->cadeiaPagamentoAtivacao($id, $limite);
        
        $qtde = 0;
        foreach ($array['ativados'] as $ativos){
        if($ativos['ativo'] == 1){
            $qtde += 1;
        }
        $qtde += $ativos['filhosAtivos']['c'];
        if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
            foreach ($ativos['filhos'] as $ativos){
                $qtde += $ativos['filhosAtivos']['c']; 
                if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
                    foreach ($ativos['filhos'] as $ativos){
                        $qtde += $ativos['filhosAtivos']['c']; 
                        if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
                            foreach ($ativos['filhos'] as $ativos){
                                $qtde += $ativos['filhosAtivos']['c'];
                                if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
                                    foreach ($ativos['filhos'] as $ativos){
                                        $qtde += $ativos['filhosAtivos']['c'];
                                        if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
                                            foreach ($ativos['filhos'] as $ativos){
                                                $qtde += $ativos['filhosAtivos']['c']; 
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
    }
    
    $sql = "SELECT COUNT(id) as c FROM user WHERE ativo = 1 AND id_dad = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue("id", $id);
    $sql->execute();
    
    if($sql->rowCount() > 0) {
        $ativos = $sql->fetch(PDO::FETCH_ASSOC);
        $qtde += $ativos['c'];
    }
   
    return $qtde;
    
    }
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
    public function pagamentoIndicados($id, $limite) {
        $array = array();
        
        $array['indicados'] = $this->cadeiaPagamentoIndicacao($id, $limite);
        
        $qtde = 0;
        foreach ($array['indicados'] as $ativos){
        $data = explode("-", $ativos['data_ativacao']);
        $mes = date('m');
        if($ativos['ativo'] == 1 && $data[1] == $mes){
            $qtde += 1;
        }
        $qtde += $ativos['filhosIndicados']['c'];
        if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
            foreach ($ativos['filhos'] as $ativos){
                $qtde += $ativos['filhosIndicados']['c']; 
                if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
                    foreach ($ativos['filhos'] as $ativos){
                        $qtde += $ativos['filhosIndicados']['c']; 
                        if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
                            foreach ($ativos['filhos'] as $ativos){
                                $qtde += $ativos['filhosIndicados']['c'];
                                if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
                                    foreach ($ativos['filhos'] as $ativos){
                                        $qtde += $ativos['filhosIndicados']['c'];
                                        if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
                                            foreach ($ativos['filhos'] as $ativos){
                                                $qtde += $ativos['filhosIndicados']['c']; 
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
   }
        $sql = "SELECT COUNT(id) as c FROM user WHERE MONTH(data_ativacao) = :mes AND ativo = 1 AND id_dad = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":mes", $mes);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $indicados = $sql->fetch(PDO::FETCH_ASSOC);
            $qtde += $indicados['c'];            
        }
        
        return $qtde;
    }

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
    
    public function patentesFilhos($id, $limite){
        $array = array();
        $sql = "SELECT * FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_dad", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($array as $chave => $usuario){
                   if($limite > 0) {
                $array[$chave]['qualificados'] = array();                
                    $array[$chave]['qualificados'] = $this->cadeiaQualificadosFilhos($usuario['id'], $limite-1); 
                   }  
            }
        }
        return $array;
    }

     public function cadeiaQualificadosFilhos($id, $limite){
        $array = array();
        
        $sql = "SELECT * FROM qualificados WHERE id_user = :id_user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            
        }
        return $array;
    }
    
    // O que ela faz????
    public function cadeiaPatenteFilhos($id, $limite){
        $array = array();
                     
        $sql = "SELECT * FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_dad", $id);
        $sql->execute();
        
        $consumidor = array();
        $consumidor['pre'] = 0;
        $consumidor['bronze'] = 0;
        $consumidor['prata'] = 0;
        $consumidor['ouro'] = 0;
        $consumidor['rubi'] = 0;
        $consumidor['diamante'] = 0;
        $consumidor['duploDiamante'] = 0;
        if($sql->rowCount() > 0) {  
            
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
           
            foreach($array as $chave => $usuario){              
                  switch ($usuario['patent']){
                    case '1':
                    $consumidor['pre'] += 1;
                    break;
                    case '2':
                    $consumidor['bronze'] += 1;
                    break;
                    case '3':
                    $consumidor['prata'] += 1;
                    break;
                    case '4':
                    $consumidor['ouro'] += 1;
                    break;
                    case '5':
                    $consumidor['rubi'] += 1;
                    break;
                    case '6':
                    $consumidor['diamante'] += 1;
                    break;
                    case '7':
                    $consumidor['duploDiamante'] += 1;
                    break;                        
                }            
                if($limite > 0) {
                    $array[$chave]['consumidor'] = array();                
                    $array[$chave]['consumidor'] = $this->cadeiaPatenteFilhos($usuario['id'], $limite-1); 
                }   
            }

        }
        //Inserindo ou Atualizando Tabela de Qualificados
            $mes = date('m');
            $ano = date('Y');
            $sql = "SELECT id FROM qualificados WHERE id_user = :id AND mes = :mes AND ano = :ano";
            $sql = $this->db->prepare($sql);        
            $sql->bindValue(":id", $id);
            $sql->bindValue(":mes", $mes);
            $sql->bindValue(":ano", $ano);
            $sql->execute();

            if($sql->rowCount() > 0) {  
                $id_table = $sql->fetch(PDO::FETCH_ASSOC);

                    $sql = "UPDATE qualificados SET pre = :pre, bronze = :bronze, prata = :prata, ouro = :ouro, rubi = :rubi, diamante = :diamante, duploDiamante = :duploDiamante WHERE id = :id";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":id", $id_table['id']);
                    $sql->bindValue(":pre", $consumidor['pre']);
                    $sql->bindValue(":bronze", $consumidor['bronze']);
                    $sql->bindValue(":prata", $consumidor['prata']);
                    $sql->bindValue(":ouro", $consumidor['ouro']);
                    $sql->bindValue(":rubi", $consumidor['rubi']);
                    $sql->bindValue(":diamante", $consumidor['diamante']);
                    $sql->bindValue(":duploDiamante", $consumidor['duploDiamante']);
                    $sql->execute();
            } else {
                $sql = "INSERT INTO qualificados (id_user, pre, bronze, prata, ouro, rubi, diamante, duploDiamante, mes, ano) VALUES (:id_user, :pre, :bronze, :prata, :ouro, :rubi, :diamante, :duploDiamante, :mes, :ano)";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":id_user", $id);
                    $sql->bindValue(":pre", $consumidor['pre']);
                    $sql->bindValue(":bronze", $consumidor['bronze']);
                    $sql->bindValue(":prata", $consumidor['prata']);
                    $sql->bindValue(":ouro", $consumidor['ouro']);
                    $sql->bindValue(":rubi", $consumidor['rubi']);
                    $sql->bindValue(":diamante", $consumidor['diamante']);
                    $sql->bindValue(":duploDiamante", $consumidor['duploDiamante']);
                    $sql->bindValue(":mes", $mes);
                    $sql->bindValue(":ano", $ano);
                    $sql->execute();
            }
        return $consumidor;
    }
    
    
    public function arvoreCompleta($id){
        $array = array();       
             
        $sql = "SELECT *, (select patent.name from patent where patent.id = user.patent)as patente FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_dad", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array['qtde'] = $sql->rowCount();
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
           
            foreach($array as $chave => $usuario){
                $array[$chave]['comprasMes'] = $this->comprasMes($usuario['id']);
                $array[$chave]['filhos'] = array();                
                    $array[$chave]['filhos'] = $this->arvoreCompleta($usuario['id']); 
                    
            }
           
        }
        return $array;
    }
    
    public function comprasMes($id){
        $mes = date('m');
        
        $sql = "SELECT COUNT(qtde) as qtde FROM transacoes WHERE id_user = :id AND MONTH(data) = :mes";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":mes", $mes);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $qtde = $sql->fetch(PDO::FETCH_ASSOC);
            return $qtde['qtde'];            
        } else {
            return 0;
        }
    }

    public function comissao($id){
       
        $dados = array();
        $arvore = $this->arvoreCompleta($id);     
        $filhos = array();
        $id = $_SESSION['multLogin'];
        $patent = $this->minhaPatente($id);
        $qtde = $this->calculoComissao($arvore, $filhos, $patent);       
        
        return $qtde;
    }
    
    public function minhaPatente($id) {
        $sql = "SELECT patent FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $patent = $sql->fetch(PDO::FETCH_ASSOC);
            
            return $patent['patent'];            
        }
    }

    public function calculoComissao($arvore, &$filhos, $patent){
        
        $qt = count($arvore);
        
        
        for($q = 0; $q < $qt ;$q++){    
            if($patent-$arvore[$q]['patent'] == 0){
                $filhos['0%'] += 1;
                if(count($arvore[$q]['filhos']) > 0) {
//                    $patent = 1;
                    $this->calculoComissao($arvore[$q]['filhos'], $filhos, $patent);                    
                }
            } else if($patent-$arvore[$q]['patent'] == 1){
                $filhos['3%'] += 1;
                if(count($arvore[$q]['filhos']) > 0) {
                    $id = $_SESSION['multLogin'];
                    $patent = $this->minhaPatente($id);
                    $patent = $patent - $arvore[$q]['patent']+1;
                    $this->calculoComissao($arvore[$q]['filhos'], $filhos, $patent);                    
                }
            } else if($patent-$arvore[$q]['patent'] == 2){
                $filhos['6%'] += 1;
                if(count($arvore[$q]['filhos']) > 0) {
                    $id = $_SESSION['multLogin'];
                    $patent = $this->minhaPatente($id);
                    $patent = $patent - $arvore[$q]['patent']+1;
                    $this->calculoComissao($arvore[$q]['filhos'], $filhos, $patent);                    
                }
            } else if($patent-$arvore[$q]['patent'] == 3){
                $filhos['9%'] += 1;
                if(count($arvore[$q]['filhos']) > 0) {
                    $id = $_SESSION['multLogin'];
                    $patent = $this->minhaPatente($id);
                    $patent = $patent - $arvore[$q]['patent']+1;
                    //puxar um retorno aqui 
                    $this->calculoComissao($arvore[$q]['filhos'], $filhos, $patent);                    
                }
            } else if($patent-$arvore[$q]['patent'] == 4){
                $filhos['12%'] += 1;
                if(count($arvore[$q]['filhos']) > 0) {
                    $id = $_SESSION['multLogin'];
                    $patent = $this->minhaPatente($id);
                    $patent = $patent - $arvore[$q]['patent']+1;
                    $this->calculoComissao($arvore[$q]['filhos'], $filhos, $patent);                    
                }
            }
            else if($patent-$arvore[$q]['patent'] == 5){
                $filhos['15%'] += 1;
                if(count($arvore[$q]['filhos']) > 0) {
                    $id = $_SESSION['multLogin'];
                    $patent = $this->minhaPatente($id);
                    $patent = $patent - $arvore[$q]['patent']+1;
                    $this->calculoComissao($arvore[$q]['filhos'], $filhos, $patent);                    
                }
            }
            else if($patent-$arvore[$q]['patent'] == 6){
                $filhos['18%'] += 1;
                if(count($arvore[$q]['filhos']) > 0) {
                    $id = $_SESSION['multLogin'];
                    $patent = $this->minhaPatente($id);
                    $patent = $patent - $arvore[$q]['patent']+1;
                    $this->calculoComissao($arvore[$q]['filhos'], $filhos, $patent);                    
                }
            }
            

            
        }
//        echo '<pre>';
//        echo $total;
//        exit();
        return $filhos;
    }
    
  
}