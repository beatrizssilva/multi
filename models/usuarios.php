<?php
class usuarios extends model {

    public function editFoto($id, $name){
        $sql = "SELECT * FROM user_dados WHERE id_user = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            
            $sql = "UPDATE user_dados SET foto_perfil = :foto WHERE id_user = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":foto", $name);      
            $sql->execute();
        } else {
            $sql = "INSERT INTO user_dados (id_user, foto_perfil) values (:id, :foto)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":foto", $name);        
            $sql->execute();
        }
    }

    public function getDadosAfiliados($id){
        $array = array();
        
        $sql = "SELECT * FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
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
            } else {
                $array['dados']['foto_perfil'] = "user.jpg";
                $array['dados']['telefone'] = "358282828282";
            }
        }
       
        return $array;
    }

    //Reseta Ativo e Patente para o inicio do mes
    public function resetMes(){
       
        $sql = "UPDATE user SET ativo = :ativo, patent = :patent";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":ativo", 0);
        $sql->bindValue(":patent", 1);        
        $sql->execute();

        
    }
    
    //verifica o login do usuario
    public function verifyUser($id, $senha){
       
        $sql = "SELECT * FROM user WHERE email = :email OR cpf = :cpf AND pass = :pass";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $id);
        $sql->bindValue(":cpf", $id);
        $sql->bindValue(":pass", MD5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;    
        } else {       
            return false;
        }
    }
    
    //seleciona as informações do usuario
    public function getDadosUser ($id){
        $array = array();
        
        $sql = "SELECT *, (select patent.name from patent where patent.id = user.patent)as cargo FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }        
        return $array;
    }

    //Seleciona os dados do usuario após o login 
    public function getUser($id, $senha){
        $array = array();

        $sql = "SELECT * FROM user WHERE email = :email OR cpf = :cpf AND pass = :pass";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $id);
        $sql->bindValue(":cpf", $id);
        $sql->bindValue(":pass", MD5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }
    
    //cadastrar novo usuario
    public function setNewUser($email, $nome, $senha, $id, $cpf) {
        $sql = "SELECT * FROM user WHERE identificador = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        $ativo = 0;
        $data_ativacao = date("Y-m-d h:m:i");
        $id_dad = $array['id'];
        
        $sql = "INSERT INTO user (id_dad, name, cpf, email, pass, ativo, data_ativacao) VALUES (:id_dad, :name, :cpf, "
                . ":email, :pass, :ativo, :data_ativacao)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_dad", $id_dad);
        $sql->bindValue(":name", $nome);
        $sql->bindValue(":cpf", $cpf);
        $sql->bindValue("email", $email);
        $sql->bindValue(":pass", MD5($senha));
        $sql->bindValue(":ativo", $ativo);
        $sql->bindValue(":data_ativacao", $data_ativacao);        
        $sql->execute();
        
        $id_user = $this->db->lastInsertId();
        $token = md5(date('Y-m-d H:i:s').rand(0, 999).rand(0, 999));
        $token1 = str_split($token);
        $t = $token1[0].$token1[1].$token1[2].$token1[3];
        $n = intval(1000+$id_user); 
        $identificador = $n.$t;
        
        $sql = "UPDATE user SET identificador = :identificador WHERE id =:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":identificador", $identificador);
        $sql->bindValue(":id", $id_user);
        $sql->execute();
        
        return true;
    }
    
    //seleciona a arvore até a 5ª geração definida na global $config
    public function getFilhos($id, $limite) {
        $array = array();

        $sql = "SELECT *, (select patent.name from patent where patent.id = user.patent)as patente FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_dad", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($array as $chave => $usuario){
                $array[$chave]['filhos'] = array();
//                if($limite > 0){
                    
                    $array[$chave]['filhos'] = $this->getFilhos($usuario['id'], $limite - 1);
//                }
            }
        }
        return $array;
    }
    
    //verifica se email ja cadastrado
    public function verifyEmail($email) {
        $sql = "SELECT * FROM user WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
            return true;
        } else {
            return false;
        }
    }

        //verifica se ID está correto
    public function verifyID($id) {
        $sql = "SELECT * FROM user WHERE identificador = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
            return true;
        } else {
            return false;
        }
    }
    
    //verifica se CPF já Cadastrado
    public function verifyCPF($cpf) {
        $sql = "SELECT * FROM user WHERE cpf = :cpf";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":cpf", $cpf);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
            return true;
        } else {
            return false;
        }
    }
    
    public function convidar($nome, $email){
        $id_user = $_SESSION['multLogin'];
        $data = date('Y-m-d H:i:s');
        $status = 0;
        
        $sql = "INSERT INTO convites (id_user, data, nome, email, status) VALUES (:id_user, :data, :nome, :email, :status)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":data", $data);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":status", $status);        
        $sql->execute();
        return true;
    }
    
     public function convidados($id){
         $array = array();
     
        $sql = "SELECT * FROM convites WHERE id_user = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
     }
}