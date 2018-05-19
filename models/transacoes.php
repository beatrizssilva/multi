<?php
class transacoes extends model {
    
    public function comprando($id, $qtde, $valor, $resgatado){
        
        
        $date = date("Y-m-d H:i:s");
        //insere na tabela transacoes a nova transacao
        $sql = "INSERT INTO transacoes (id_user, data, qtde, valor_pago) VALUES (:id_user, :data, :qtde, :valor)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id);
        $sql->bindValue(":data", $date);
        $sql->bindValue(":qtde", $qtde);
        $sql->bindValue(":valor", $valor);
        $sql->execute();
        
        //pega o ultimo ID
        $id_venda = $this->db->lastInsertId();
        
        //gera o codigo do pedido
        $n = intval(100+$id_venda);        
        $data = intval(date("Y").date("m").date("d"));
        $pedido = $data.'345'.$n;
        
        //atualiza o campo da tabela com o numero do protocolo
        $sql = "UPDATE transacoes SET protocolo = :protocolo WHERE id =:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":protocolo", $pedido);
        $sql->bindValue(":id", $id_venda);
        $sql->execute();
        
        //atualiza o cadastro do usuario 
        $sql = "UPDATE user SET ativo = 1, data_ativacao = :data WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->bindValue(":data", $date);
        $sql->execute();
        
        //seleciona o id_dad do usuario para adicao dos pontos
        $sql = "SELECT id_dad FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->execute();
            
        if($sql->rowCount() > 0) {
            $dad = $sql->fetch(PDO::FETCH_ASSOC);           
            
            //Inserir pontos total no cadastro do usuario
            $this->insertPontosTotal($dad['id_dad'], $qtde);
            //Insere quantidade de pontos na tabela comissoes
            $this->insertPontosMes($dad['id_dad'], $qtde);
           
        }
        
        //atualiza o valor do saldo do usuario
        $sql = "SELECT * FROM resgate WHERE id_user = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $id = $sql->fetch(PDO::FETCH_ASSOC); 
            $total = $id['total'] - $resgatado;
      
            $sql = "UPDATE resgate SET total = :total, valor_resgatado = :resgatado WHERE id_user = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id['id_user']);
            $sql->bindValue(":resgatado", $resgatado);
            $sql->bindValue(":total", $total);
            $sql->execute();
        }
        return $pedido;
    }
    
      
    //Inserir pontos total no cadastro do usuario
    public function insertPontosTotal($id, $qt) {
        global $config;
        $ponto = intval($qt) * $config['valorCesta'];
       
        //seleciona a quantidade de pontos atual
        $sql = "SELECT pontos FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $p = $sql->fetch(PDO::FETCH_ASSOC);
            $pontos = $p['pontos'] + $ponto;
           
        //atualiza a quantidade de pontos
        $sql = "UPDATE user SET pontos = :pontos WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":pontos", $pontos);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        //seelciona o pai deste usuario, se existe repete a função insertPontosTotal
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
    
    //insere quantidade de pontos na tabela comissoes
    public function insertPontosMes($id, $qt) {
        global $config;
        $mes = date('m');
        $ano = date('Y');
        $ponto = intval($qt) * $config['valorCesta'];
        
        $sql = "SELECT id FROM comissoes WHERE id_user = :id AND mes = :mes AND ano = :ano";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->bindValue(":mes", $mes);
        $sql->bindValue(":ano", $ano);
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

                $sql = "INSERT INTO comissoes (id_user, pontos, mes, ano) VALUES (:id_user, :pontos, :mes, :ano)";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id_user", $id);
                $sql->bindValue(":pontos", $pontos);
                $sql->bindValue(":mes", $mes);
                $sql->bindValue(":ano", $ano);
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