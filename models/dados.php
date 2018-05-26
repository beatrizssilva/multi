<?php
class dados extends model {


    public function mensagem($id){
        
        $sql = "SELECT *, (select user.name from user where mensagens.id_user_de = user.id)as autor"
                . " FROM mensagens WHERE id_user_para = :id AND lido = 0 ORDER BY data DESC LIMIT 5";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }
    
    public function qtdeMensagem($id){
        
        $sql = "SELECT * FROM mensagens WHERE id_user_para = :id AND lido = 0";
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