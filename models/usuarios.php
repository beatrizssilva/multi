<?php
class usuarios extends model {

    public function verifyUser($name, $senha){
       
        $sql = "SELECT * FROM user WHERE name = :name AND pass = :pass";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("name", $name);
        $sql->bindValue("pass", MD5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;    
        } else {       
            return false;
        }
    }
    
    public function getDadosUser ($id){
        $array = array();
        
        $sql = "SELECT *, (select patent.name from patent where patent.id = user.patent)as patente FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        
        return $array;
    }


    public function getUser($name, $senha){
        $array = array();

        $sql = "SELECT * FROM user WHERE name = :name AND pass = :pass";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("name", $name);
        $sql->bindValue("pass", MD5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }
    
    public function setNewUser($email, $nome) {
        $senha = 123;
        $ativo = 0;
        $data_ativacao = date("Y-m-d h:m:i");
        $id_dad = $_SESSION['multLogin'];
        $sql = "INSERT INTO user (id_dad, name, email, pass, ativo, data_ativacao) VALUES (:id_dad, :name, :email, :pass, :ativo, :data_ativacao)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id_dad);
        $sql->bindValue("name", $nome);
        $sql->bindValue("email", $email);
        $sql->bindValue("pass", MD5($senha));
        $sql->bindValue("ativo", $ativo);
        $sql->bindValue("data_ativacao", $data_ativacao);        
        $sql->execute();
    }
    
    public function getFilhos($id, $limite) {
        $array = array();

        $sql = "SELECT *, (select patent.name from patent where patent.id = user.patent)as patente FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($array as $chave => $usuario){
                $array[$chave]['filhos'] = array();
                if($limite > 0){
                    
                    $array[$chave]['filhos'] = $this->getFilhos($usuario['id'], $limite - 1);
                }
            }
        }
        return $array;
    }
    

}