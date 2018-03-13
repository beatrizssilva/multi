<?php
class transacoes extends model {
    
    public function comprando($id, $qtde){
        
        $date = date("Y-m-d");
        $sql = "INSERT INTO transacoes (id_user, data, qtde) VALUES (:id_user, :data, :qtde)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id);
        $sql->bindValue(":data", $date);
        $sql->bindValue(":qtde", $qtde);
        $sql->execute();
        
        $id_venda = $this->db->lastInsertId();
        $n = intval(100000+$id_venda);        
        $data = intval(date("Y").date("m").date("d"));
        $pedido = $data.'345'.$n;
        
        $sql = "UPDATE transacoes SET protocolo = :protocolo WHERE id =:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":protocolo", $pedido);
        $sql->bindValue(":id", $id_venda);
        $sql->execute();
        
        $sql = "UPDATE user SET ativo = 1 WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        $sql = "SELECT id_dad FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        $id_dad = 0;
        
        if($sql->rowCount() > 0) {
            $id_dad = $sql->fetch(PDO::FETCH_ASSOC);
            
            $sql = "SELECT * FROM comissoes WHERE id_user = :id";
            $sql = $this->db->prepare($sql);        
            $sql->bindValue(":id", $id_dad['id_dad']);
            $sql->execute();
            
            if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
                $qtde += intval($array['qtde']);
                $valor = $qtde*8;
                $sql = "UPDATE comissoes SET qtde = :qtde, valor = :valor";
                $sql = $this->db->prepare($sql);  
                $sql->bindValue(":qtde", $qtde);
                $sql->bindValue(":valor", floatval($valor));
                $sql->execute();  
            }else{
           
                $mes = date("m");
                $valor = $qtde*8;
                $sql = "INSERT INTO comissoes SET id_user = :id_dad, qtde = :qtde, mes  = :mes, valor = :valor";
                $sql = $this->db->prepare($sql);        
                $sql->bindValue(":id_dad", $id_dad['id_dad']);
                $sql->bindValue(":qtde", $qtde);
                $sql->bindValue(":mes", $mes);
                $sql->bindValue(":valor", floatval($valor));
                $sql->execute();
            }
        }
        
        return $pedido;
    }
}