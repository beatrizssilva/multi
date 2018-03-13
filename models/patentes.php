<?php
class patentes extends model {
    
    public function patente() {
        global $config;
        
        $sql = "SELECT * FROM patent";
        $sql = $this->db->query($sql);
        $patentes = array();
        
        if($sql->rowCount() > 0) {
                $patentes = $sql->fetchAll();
        }
        
        $sql = "SELECT id, name FROM user ORDER BY id DESC";
        $sql = $this->db->query($sql);
        
        $usuarios = array();
       
        if($sql->rowCount() > 0) {
            $usuarios = $sql->fetchAll();
            
            foreach($usuarios as $chave => $usuario) {
		$usuarios[$chave]['consumidores'] = $this->calcularFilhosTotal($usuario['id'], $config['limit']);
                $usuarios[$chave]['consumidorJunior'] = $this->calcularFilhosJunior($usuario['id']);
                $usuarios[$chave]['consumidorBronze'] = $this->calcularFilhosBronze($usuario['id']);
                $usuarios[$chave]['consumidorPrata'] = $this->calcularFilhosPrata($usuario['id']);
                $usuarios[$chave]['consumidorOuro'] = $this->calcularFilhosOuro($usuario['id']);
                $usuarios[$chave]['consumidorRubi'] = $this->calcularFilhosRubi($usuario['id']);
                $usuarios[$chave]['consumidorDiamante'] = $this->calcularFilhosDiamante($usuario['id']);
                $usuarios[$chave]['consumidorDuploDiamante'] = $this->calcularFilhosDuploDiamante($usuario['id']);
                
//                echo '<pre>';
//                print_r($usuarios);
//                exit();
                
            if(intval($usuarios[$chave]['consumidores']) >= 3 && intval($usuarios[$chave]['consumidorDiamante']) >= 3
                 || intval($usuarios[$chave]['consumidores']) >= 3 && intval($usuarios[$chave]['consumidorDuploDiamante']) >= 1){
            
                $patent = $patentes[6]['id'];//duplo-diamante  
                
            } else if(intval($usuarios[$chave]['consumidores']) >= 3 && intval($usuarios[$chave]['consumidorRubi']) >= 3 || intval($usuarios[$chave]['consumidores']) >= 3 && intval($usuarios[$chave]['consumidorDiamante']) >= 1){
            
                $patent = $patentes[5]['id'];//diamante
                
            } else if(intval($usuarios[$chave]['consumidores']) >= 3 && intval($usuarios[$chave]['consumidorOuro']) >= 3 || intval($usuarios[$chave]['consumidores']) >= 3 && intval($usuarios[$chave]['consumidorRubi']) >= 1){
            
                $patent = $patentes[4]['id'];//rubi
                
            } else if(intval($usuarios[$chave]['consumidores']) >= 3 && intval($usuarios[$chave]['consumidorPrata']) >= 3 || intval($usuarios[$chave]['consumidores']) >= 3 && intval($usuarios[$chave]['consumidorOuro']) >= 1){
                
                $patent = $patentes[3]['id'];//ouro
                
            } else if(intval($usuarios[$chave]['consumidores']) >= 3 && intval($usuarios[$chave]['consumidorBronze']) >= 3 || intval($usuarios[$chave]['consumidores']) >= 3 && intval($usuarios[$chave]['consumidorPrata']) >= 1){
                
                $patent = $patentes[2]['id'];//prata
                
            } else if(intval($usuarios[$chave]['consumidores']) >= 3 && intval($usuarios[$chave]['consumidorJunior']) >= 1 || intval($usuarios[$chave]['consumidores']) >= 3 && intval($usuarios[$chave]['consumidorBronze']) >= 1){
                
                $patent = $patentes[1]['id'];//bronze
                
            } else {
                
                $patent = $patentes[0]['id'];//junior
                
            }
                
            $sql = "UPDATE user SET patent = :patente WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":patente", $patent);
            $sql->bindValue(":id", $usuario['id']);
            $sql->execute();
    
            }
        }

        echo '<pre>';
                print_r($usuarios);
                exit();
        return $usuarios;
    }

    public function calcularFilhosTotal($id, $limite) {
	$lista = array();
	

	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1";
        $sql = $this->db->prepare($sql);
	$sql->bindValue(":id", $id);
	$sql->execute();
	$consumidor = 0;
	
	if($sql->rowCount() > 0) {
		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);

		$consumidor = $sql->rowCount();

		foreach($lista as $chave => $usuario) {
			if($limite > 0) {
				$consumidor += $this->calcularFilhosTotal($usuario['id'], $limite-1);
			}
		}
	}
        
	return $consumidor;
    }
    
    public function calcularFIlhosJunior($id) {
	$lista = array();
	

	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 1";
        $sql = $this->db->prepare($sql);
	$sql->bindValue(":id", $id);
	$sql->execute();
	$consumidor = 0;
	
	if($sql->rowCount() > 0) {
		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
		$consumidor = $sql->rowCount();
	}
        
	return $consumidor;
    }
    
     public function calcularFilhosBronze($id) {
	$lista = array();
	

	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 2";
        $sql = $this->db->prepare($sql);
	$sql->bindValue(":id", $id);
	$sql->execute();
	$consumidor = 0;
	
	if($sql->rowCount() > 0) {
		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
		$consumidor = $sql->rowCount();
	}
        
	return $consumidor;
    }
    
    public function calcularFilhosPrata($id) {
	$lista = array();
	

	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 3";
        $sql = $this->db->prepare($sql);
	$sql->bindValue(":id", $id);
	$sql->execute();
	$consumidor = 0;
	
	if($sql->rowCount() > 0) {
		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
		$consumidor = $sql->rowCount();
	}
        
	return $consumidor;
    }
    
    public function calcularFilhosOuro($id) {
	$lista = array();
	

	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 4";
        $sql = $this->db->prepare($sql);
	$sql->bindValue(":id", $id);
	$sql->execute();
	$consumidor = 0;
	
	if($sql->rowCount() > 0) {
		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
		$consumidor = $sql->rowCount();
	}
        
	return $consumidor;
    }
    
    public function calcularFilhosRubi($id) {
	$lista = array();
	

	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 5";
        $sql = $this->db->prepare($sql);
	$sql->bindValue(":id", $id);
	$sql->execute();
	$consumidor = 0;
	
	if($sql->rowCount() > 0) {
		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
		$consumidor = $sql->rowCount();
	}
        
	return $consumidor;
    }
    
    public function calcularFilhosDiamante($id) {
	$lista = array();
	

	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 6";
        $sql = $this->db->prepare($sql);
	$sql->bindValue(":id", $id);
	$sql->execute();
	$consumidor = 0;
	
	if($sql->rowCount() > 0) {
		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
		$consumidor = $sql->rowCount();
	}
        
	return $consumidor;
    }
    
    public function calcularFilhosDuploDiamante($id) {
	$lista = array();
	

	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 7";
        $sql = $this->db->prepare($sql);
	$sql->bindValue(":id", $id);
	$sql->execute();
	$consumidor = 0;
	
	if($sql->rowCount() > 0) {
		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
		$consumidor = $sql->rowCount();
	}
        
	return $consumidor;
    }
}