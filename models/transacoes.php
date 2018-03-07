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
        
        return $pedido;
    }
}