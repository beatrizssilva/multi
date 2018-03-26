<?php
class transacoes extends model {
    
    public function comprando($id, $qtde){
        global $config;
        
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
            
        if($sql->rowCount() > 0) {
            $id = $sql->fetch(PDO::FETCH_ASSOC);
           
            
            $this->insertPontosTotal($id['id_dad'], $qtde);
            $this->insertPontosMes($id['id_dad'], $qtde);
            $this->insertKitsGeral($id['id_dad'], $qtde);//Inserindo Qtde de kits vendidos de toda a cadeia
            $this->insertKitsCadeia($id['id_dad'], $config['limit'], $qtde);//Inserindo Qtde Kits vendidos até 5ª Geração
        }
        
        return $pedido;
    }
    
    public function insertKitsCadeia($id, $limite, $qt) {
        $mes = date('m');
        
        $sql = "SELECT id FROM comissoes WHERE id_user = :id AND mes = :mes";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->bindValue(":mes", $mes);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $comissao = $sql->fetch(PDO::FETCH_ASSOC);
            
                    
            $sql = "SELECT kits_cadeia FROM comissoes WHERE id = :id";
            $sql = $this->db->prepare($sql);        
            $sql->bindValue(":id", $comissao['id']);            
            $sql->execute();
            
            if($sql->rowCount() > 0) {
                $k = $sql->fetch(PDO::FETCH_ASSOC);
                $kits = $k['kits_cadeia'] + $qt;
                $sql = "UPDATE comissoes SET kits_cadeia = :kits WHERE id = :id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":kits", $kits);           
                $sql->bindValue(":id", $comissao['id']);
                $sql->execute();
            }
            if($limite > 0) {
                $sql = "SELECT id_dad FROM user WHERE id = :id";
                $sql = $this->db->prepare($sql);        
                $sql->bindValue(":id", $id);
                $sql->execute();

                    if($sql->rowCount() > 0) {
                        $id = $sql->fetch(PDO::FETCH_ASSOC);
                        if($id['id_dad'] <> 0){
                            $this->insertKitsCadeia($id['id_dad'], $limite-1, $qt);
                        }
                    }
            }
        } 
    }
    
    public function insertKitsGeral($id, $qt) {
        $mes = date('m');
        
        $sql = "SELECT id FROM comissoes WHERE id_user = :id AND mes = :mes";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->bindValue(":mes", $mes);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $comissao = $sql->fetch(PDO::FETCH_ASSOC);
            
                    
            $sql = "SELECT kits_geral FROM comissoes WHERE id = :id";
            $sql = $this->db->prepare($sql);        
            $sql->bindValue(":id", $comissao['id']);            
            $sql->execute();
            
            if($sql->rowCount() > 0) {
                $k = $sql->fetch(PDO::FETCH_ASSOC);
                $kits = $k['kits_geral'] + $qt;
                $sql = "UPDATE comissoes SET kits_geral = :kits WHERE id = :id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":kits", $kits);           
                $sql->bindValue(":id", $comissao['id']);
                $sql->execute();
            }
        $sql = "SELECT id_dad FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->execute();
            
            if($sql->rowCount() > 0) {
                $id = $sql->fetch(PDO::FETCH_ASSOC);
                if($id['id_dad'] <> 0){
                    $this->insertKitsGeral($id['id_dad'], $qt);
                }
            }
        } 
    }
    
    public function insertPontosTotal($id, $qt) {
        
        $ponto = intval($qt) * 200;
       
        $sql = "SELECT pontos FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $p = $sql->fetch(PDO::FETCH_ASSOC);
            $pontos = $p['pontos'] + $ponto;
           
        $sql = "UPDATE user SET pontos = :pontos WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":pontos", $pontos);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        $sql = "SELECT id_dad FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->execute();
            
            if($sql->rowCount() > 0) {
                $id = $sql->fetch(PDO::FETCH_ASSOC);
                if($id['id_dad'] <> 0){
                    $this->insertPontosTotal($id['id_dad'], $qt);
                }
            }
        }
    }
    public function insertPontosMes($id, $qt) {
        $mes = date('m');
        $ponto = intval($qt) * 200;
        
        $sql = "SELECT id FROM comissoes WHERE id_user = :id AND mes = :mes";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->bindValue(":mes", $mes);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $comissao = $sql->fetch(PDO::FETCH_ASSOC);
            
                    
            $sql = "SELECT pontos FROM comissoes WHERE id = :id";
            $sql = $this->db->prepare($sql);        
            $sql->bindValue(":id", $comissao['id']);            
            $sql->execute();
            
            if($sql->rowCount() > 0) {
            $p = $sql->fetch(PDO::FETCH_ASSOC);
            $pontos = $p['pontos'] + $ponto;
            $sql = "UPDATE comissoes SET pontos = :pontos WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":pontos", $pontos);           
            $sql->bindValue(":id", $comissao['id']);
            $sql->execute();
            }
        $sql = "SELECT id_dad FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->execute();
            
            if($sql->rowCount() > 0) {
                $id = $sql->fetch(PDO::FETCH_ASSOC);
                if($id['id_dad'] <> 0){
                    $this->insertPontosMes($id['id_dad'], $qt);
                }
            }
        } else {
            
            if($id <> 0){
                $pontos = $ponto;

                $sql = "INSERT INTO comissoes (id_user, pontos, mes) VALUES (:id_user, :pontos, :mes)";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id_user", $id);
                $sql->bindValue(":pontos", $pontos);
                $sql->bindValue(":mes", $mes);
                $sql->execute();

                $sql = "SELECT id_dad FROM user WHERE id = :id";
                $sql = $this->db->prepare($sql);        
                $sql->bindValue(":id", $id);
                $sql->execute();

                if($sql->rowCount() > 0) {
                    $id = $sql->fetch(PDO::FETCH_ASSOC);
                    if($id['id_dad'] <> 0){
                        $this->insertPontosMes($id['id_dad'], $qt);
                    }
                }
            }
        }
        
    }
}