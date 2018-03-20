<?php
class comissao extends model {
  
    public function calcularComissao($id, $limite){
        $array = array();
        
              
        $sql = "SELECT *, (select sum(transacoes.qtde) from transacoes where transacoes.id_user = user.id) as compras FROM user WHERE id_dad = :id_dad AND ativo = 1 ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id);
        $sql->execute();
        $array['total'] = 0;
        if($sql->rowCount() > 0) {
            $array['qtde'] = $sql->rowCount();
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            $total = 0;
            foreach ($array as $user){
                $total += $user['compras'];
            }
            foreach($array as $chave => $usuario){
                $array[$chave]['filhos'] = array();
                
                if($limite > 0){
                    
                    $array[$chave]['filhos'] = $this->calcularComissao($usuario['id'], $limite - 1);
                    
                }
            }
           
        }
               
        return $array;
    }

    public function calcularPontosTotal($id){
         $array = array();
        
              
        $sql = "SELECT *, (select sum(transacoes.qtde) from transacoes where transacoes.id_user = user.id) as compras FROM user WHERE id_dad = :id_dad AND ativo = 1 ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array['qtde'] = $sql->rowCount();
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($array as $chave => $usuario){
                $array[$chave]['filhos'] = array();
                 
                    $array[$chave]['filhos'] = $this->calcularPontosTotal($usuario['id']);
                    
                
            }
           
        }
               
        return $array;       
    }
    
}