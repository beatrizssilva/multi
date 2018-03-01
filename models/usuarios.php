<?php
class usuarios extends model {

    public function verifyUser($email, $senha){
       
        $sql = "SELECT * FROM user WHERE email = :email AND pass = :pass";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("email", $email);
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


    public function getUser($email, $senha){
        $array = array();

        $sql = "SELECT * FROM user WHERE email = :email AND pass = :pass";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("email", $email);
        $sql->bindValue("pass", MD5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }
    
    public function setNewUser($email, $nome) {
        $senha = 123;
        $id_dad = $_SESSION['multLogin'];
        $sql = "INSERT INTO user (id_dad, name, email, pass) VALUES (:id_dad, :name, :email, :pass)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id_dad);
        $sql->bindValue("name", $nome);
        $sql->bindValue("email", $email);
        $sql->bindValue("pass", MD5($senha));
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
    
    public function calcularPatente($id, $limite) {
	$lista = array();
	

	$sql = "SELECT * FROM user WHERE id_dad = :id";
        $sql = $this->db->prepare($sql);
	$sql->bindValue(":id", $id);
	$sql->execute();
	$filhos = 0;
	
	if($sql->rowCount() > 0) {
		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);

		$filhos = $sql->rowCount();

		foreach($lista as $chave => $usuario) {
			if($limite > 0) {
				$filhos += $this->calcularPatente($usuario['id'], $limite-1);
			}
		}
	}

	return $filhos;
    }
}