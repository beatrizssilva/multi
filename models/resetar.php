<?php
class resetar extends model {


    public function apagar(){
        
        $sql = "UPDATE user SET ativo = 0, patent = 1";
        $sql = $this->db->query($sql);
        
        $sql = "DELETE FROM comissao";
        $sql = $this->db->query($sql);
        
        $sql = "DELETE FROM comissoes";
        $sql = $this->db->query($sql);
        
        $sql = "DELETE FROM ganhos";
        $sql = $this->db->query($sql);
        
        $sql = "DELETE FROM qualificados";
        $sql = $this->db->query($sql);
        
        $sql = "DELETE FROM transacoes";
        $sql = $this->db->query($sql);
    }
    
    public function apagarAtivos(){
        $sql = "UPDATE user SET ativo = 0, patent = 1";
        $sql = $this->db->query($sql);
    }

}