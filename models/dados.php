<?php
class dados extends model {
    
    public function contabil(){
        $array = array();
        $sql = "SELECT * FROM contabil";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        
        return $array;
    }


    /*  public function whatsapp($id){
        
        $sql = "SELECT *, (select user.name from user where mensagens_recebidas.id_user_de = user.id)as autor "
                . "FROM mensagens_recebidas WHERE id_user_para = :id AND lido = 0 ORDER BY data DESC LIMIT 5 ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $array = '';
        }
        return $array;
    }*/
    
    public function getDadosAfiliado($id){
        $array = array();
        $sql = "UPDATE notificacoes SET lido = 1 WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        $sql = "SELECT * FROM notificacoes WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $identificador = $sql->fetch();
            
            $sql = "SELECT * FROM user WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $identificador['identificador']);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $array = $sql->fetch();

                $sql = "SELECT * FROM transacoes WHERE id_user = :id ORDER BY data DESC";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id", $id);
                $sql->execute();

                if($sql->rowCount() > 0) {
                    $array['compra'] = $sql->fetch();
                } else {
                    $array['compra']['data'] = "2018-01-01";
                }

                $sql = "SELECT * FROM user_dados WHERE id_user = :id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id", $id);
                $sql->execute();

                if($sql->rowCount() > 0) {
                    $array['dados'] = $sql->fetch();
                    if (empty($array['dados']['foto_perfil'])){
                        $array['dados']['foto_perfil'] = "user.jpg";    
                    }
                } else {
                    $array['dados']['foto_perfil'] = "user.jpg";
                }
            }
        }
        return $array;
    }
     
    public function notificacoes($id){
        
        $sql = "SELECT *, (select notificacao_tipo.tipo from notificacao_tipo where notificacoes.tipo = notificacao_tipo.id)as nome_tipo "
                . "FROM notificacoes WHERE id_user_para = :id AND lido = 0 ORDER BY data DESC LIMIT 8 ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $array = '';
        }
        return $array;
    }
    
    public function setNotificacao($id){
        
        $sql = "SELECT *, (select user.name from user where notificacoes.identificador = user.id)as user FROM notificacoes WHERE id_user_para = :id ORDER BY data DESC ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $array = '';
        }
        return $array;
    }
    public function dellNotificacao($id){
        $sql = "DELETE FROM notificacoes WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    public function mensagem($id){
        
        $sql = "SELECT *, (select user.name from user where mensagens_recebidas.id_user_de = user.id)as autor "
                . "FROM mensagens_recebidas WHERE id_user_para = :id AND lido = 0 ORDER BY data DESC LIMIT 5 ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $array = '';
        }
        return $array;
    }
    
    public function openMensagemRecebida($id){
        $sql = "UPDATE mensagens_recebidas SET lido = 1 WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        $sql = "SELECT *, (select user.name from user where mensagens_recebidas.id_user_de = user.id) as de"
                . " FROM mensagens_recebidas WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function dellMensagemRecebidas($id){
        $sql = "DELETE FROM mensagens_recebidas WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    public function dellMensagemEnviadas($id){
        $sql = "DELETE FROM mensagens_enviadas WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
    public function enviarMensagem($id_de, $id_para, $msg){
        $data = date('Y-m-d H:i:s');
        $sql = "INSERT INTO mensagens_enviadas (id_user_para, id_user_de, data, mensagem) VALUES (:para, :de, :data, "
                . ":msg)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":para", $id_para);
        $sql->bindValue(":de", $id_de);
        $sql->bindValue(":data", $data);
        $sql->bindValue(":msg", $msg);        
        $sql->execute();
        
        $data = date('Y-m-d H:i:s');
        $sql = "INSERT INTO mensagens_recebidas (id_user_para, id_user_de, data, mensagem) VALUES (:para, :de, :data, "
                . ":msg)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":para", $id_para);
        $sql->bindValue(":de", $id_de);
        $sql->bindValue(":data", $data);
        $sql->bindValue(":msg", $msg);        
        $sql->execute();
    }

    public function mensagemRecebida($id){
        
        $sql = "SELECT *, (select user.name from user where mensagens_recebidas.id_user_de = user.id)as autor FROM mensagens_recebidas WHERE id_user_para = :id ORDER BY data DESC ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $array = '';
        }
        return $array;
    }
    
     public function mensagemEnviada($id){
        
        $sql = "SELECT *, (select user.name from user where mensagens_enviadas.id_user_para = user.id)as recebedor"
                . " FROM mensagens_enviadas WHERE id_user_de = :id ORDER BY data DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $array = '';
        }
        return $array;
    }
    
    public function qtdeMensagem($id){
        
        $sql = "SELECT * FROM mensagens_recebidas WHERE id_user_para = :id AND lido = 0";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        $array = array('qt'=>0);

        if($sql->rowCount() > 0) {
            $array['qt'] = $sql->rowCount();
        }
        return $array['qt'];
    }
    
    public function qtdeNotificacoes($id){
        
        $sql = "SELECT * FROM notificacoes WHERE id_user_para = :id AND lido = 0";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        $array = array('qt'=>0);

        if($sql->rowCount() > 0) {

                $array['qt'] = $sql->rowCount();

        }
        return $array['qt'];
    }

}