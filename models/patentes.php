<?php
class patentes extends model {
    
    public function atualizarPatente() {
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
            $total = 0;
            $ativos =0;
            $consumidor = array();
          $this->qualificados();
            foreach($usuarios as $chave => $usuario) {
                $usuarios[$chave]['pontuacao'] = $this->getPontos($usuario['id']);
                
		$usuarios[$chave]['consumidoresTotal'] = $this->calcularFilhosTotal($usuario['id'], $config['limit']);
                $usuarios[$chave]['consumidoresAtivos'] = $this->calcularFilhosAtivos($usuario['id'], $config['limit'], $ativos);
                $usuarios[$chave]['consumidorPre'] = $this->calcularFilhosPre($usuario['id']);
                $usuarios[$chave]['consumidorBronze'] = $this->calcularFilhosBronze($usuario['id']);
                $usuarios[$chave]['consumidorPrata'] = $this->calcularFilhosPrata($usuario['id']);
                $usuarios[$chave]['consumidorOuro'] = $this->calcularFilhosOuro($usuario['id']);
                $usuarios[$chave]['consumidorRubi'] = $this->calcularFilhosRubi($usuario['id']);
                $usuarios[$chave]['consumidorDiamante'] = $this->calcularFilhosDiamante($usuario['id']);
                $usuarios[$chave]['consumidorDuploDiamante'] = $this->calcularFilhosDuploDiamante($usuario['id']);
                
//                echo '<pre>';
//                print_r($usuarios);
//                exit();
                
            if(intval($usuarios[$chave]['consumidoresAtivos']) >= 3 && intval($usuarios[$chave]['consumidorDiamante']) >= 3 && intval($usuarios[$chave]['pontuacao']) >= 540000 || intval($usuarios[$chave]['consumidoresAtivos']) >= 3 && intval($usuarios[$chave]['consumidorDuploDiamante']) >= 1 && intval($usuarios[$chave]['pontuacao']) >= 540000){
            
                $patent = $patentes[6]['id'];//duplo-diamante  
                
            } else if(intval($usuarios[$chave]['consumidoresAtivos']) >= 3 && intval($usuarios[$chave]['consumidorRubi']) >= 3 && intval($usuarios[$chave]['pontuacao']) >= 180000 || intval($usuarios[$chave]['consumidoresAtivos']) >= 3 && intval($usuarios[$chave]['consumidorDiamante']) >= 1 && intval($usuarios[$chave]['pontuacao']) >= 180000){
            
                $patent = $patentes[5]['id'];//diamante
                
            } else if(intval($usuarios[$chave]['consumidoresAtivos']) >= 3 && intval($usuarios[$chave]['consumidorOuro']) >= 3 && intval($usuarios[$chave]['pontuacao']) >= 60000 || intval($usuarios[$chave]['consumidoresAtivos']) >= 3 && intval($usuarios[$chave]['consumidorRubi']) >= 1 && intval($usuarios[$chave]['pontuacao']) >= 60000){
            
                $patent = $patentes[4]['id'];//rubi
                
            } else if(intval($usuarios[$chave]['consumidoresAtivos']) >= 3 && intval($usuarios[$chave]['consumidorPrata']) >= 3 && intval($usuarios[$chave]['pontuacao']) >= 18000 || intval($usuarios[$chave]['consumidoresAtivos']) >= 3 && intval($usuarios[$chave]['consumidorOuro']) >= 1 && intval($usuarios[$chave]['pontuacao']) >= 18000){
                
                $patent = $patentes[3]['id'];//ouro
                
            } else if(intval($usuarios[$chave]['consumidoresAtivos']) >= 3 && intval($usuarios[$chave]['consumidorBronze']) >= 1 && intval($usuarios[$chave]['consumidorPre']) >= 1 && intval($usuarios[$chave]['pontuacao']) >= 6000 || intval($usuarios[$chave]['consumidoresAtivos']) >= 3 && intval($usuarios[$chave]['consumidorPrata']) >= 1 && intval($usuarios[$chave]['pontuacao']) >= 6000){
                
                $patent = $patentes[2]['id'];//prata
                
            } else if(intval($usuarios[$chave]['consumidoresAtivos']) >= 3 && intval($usuarios[$chave]['consumidorPre']) >= 1 && intval($usuarios[$chave]['pontuacao']) >= 2000 || intval($usuarios[$chave]['consumidoresAtivos']) >= 3 && intval($usuarios[$chave]['consumidorBronze']) >= 1 && intval($usuarios[$chave]['pontuacao']) >= 2000){
                
                $patent = $patentes[1]['id'];//bronze
                
            } else {
                
                $patent = $patentes[0]['id'];//pre
                
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

    public function getPontos($id){
        $sql = "SELECT pontos FROM comissoes WHERE id_user = :id";
        $sql = $this->db->prepare($sql);
	$sql->bindValue(":id", $id);
	$sql->execute();
        $p = 0;
        if($sql->rowCount() > 0) {
            $p = $sql->fetch(PDO::FETCH_ASSOC);
            
        }
        return $p['pontos'];
    }
    
    public function calcularFilhosAtivos($id, $limite, &$ativos) {
	$lista = array();
	

	$sql = "SELECT * FROM user WHERE id_dad = :id";
        $sql = $this->db->prepare($sql);
	$sql->bindValue(":id", $id);
	$sql->execute();        
	
	if($sql->rowCount() > 0) {
		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);

		foreach($lista as $chave => $usuario) {
                $ativos += intval($usuario['ativo']);
                    if($limite > 0) {
                        $this->calcularFilhosTotal($usuario['id'], $limite-1, $ativos);            
                    }
		}
	}
        
	return $ativos;
    }
    
        public function calcularFilhosTotal($id, $limite) {
	$lista = array();
	

	$sql = "SELECT * FROM user WHERE id_dad = :id";
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
    public function calcularFIlhosPre($id) {
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
    
    public function qualificados(){
        $array = array();
                     
        $sql = "SELECT * FROM user ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array['qtde'] = $sql->rowCount();    
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
           
            foreach($array as $chave => $usuario){
                   
                $array[$chave]['consumidor'] = array();                
                    $array[$chave]['consumidor'] = $this->cadeiaPatenteFilhos($usuario['id']); 
                    
            }
        }
        return $array;
    }
    
    public function cadeiaPatenteFilhos($id){
        $array = array();
        $consumidor = array();
        $consumidor['patent'] = 0;
        $consumidor['pre'] = 0;
        $consumidor['bronze'] = 0;
        $consumidor['prata'] = 0;
        $consumidor['ouro'] = 0;
        $consumidor['rubi'] = 0;
        $consumidor['diamante'] = 0;
        $consumidor['duploDiamante'] = 0;
        
        $sql = "SELECT patent FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {  
            
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
       
        $consumidor['patent'] = $array['patent'];
        
        $sql = "SELECT * FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {  
            
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($array as $chave => $usuario){   
                if($usuario['ativo'] == 1){
                    
                  switch ($usuario['patent']){
                    case '1':
                    $consumidor['pre'] += 1;
                    break;
                    case '2':
                    $consumidor['bronze'] += 1;
                    break;
                    case '3':
                    $consumidor['prata'] += 1;
                    break;
                    case '4':
                    $consumidor['ouro'] += 1;
                    break;
                    case '5':
                    $consumidor['rubi'] += 1;
                    break;
                    case '6':
                    $consumidor['diamante'] += 1;
                    break;
                    case '7':
                    $consumidor['duploDiamante'] += 1;
                    break;                        
                }
                }
                 
                $array[$chave]['consumidor'] = array();                
                    $array[$chave]['consumidor'] = $this->cadeiaPatenteFilhos($usuario['id']); 
                    
            }

        }
        //Inserindo ou Atualizando Tabela de Qualificados
      
            $mes = date('m');
            $ano = date('Y');
            $sql = "SELECT id FROM qualificados WHERE id_user = :id AND mes = :mes AND ano = :ano";
            $sql = $this->db->prepare($sql);        
            $sql->bindValue(":id", $id);
            $sql->bindValue(":mes", $mes);
            $sql->bindValue(":ano", $ano);
            $sql->execute();

            if($sql->rowCount() > 0) {  
                $id_table = $sql->fetch(PDO::FETCH_ASSOC);
                                    
                    $sql = "UPDATE qualificados SET patent = :patent, pre = :pre, bronze = :bronze, prata = :prata, ouro = :ouro, rubi = :rubi, diamante = :diamante, duploDiamante = :duploDiamante WHERE id = :id";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":id", $id_table['id']);
                    $sql->bindValue(":patent", $consumidor['patent']);
                    $sql->bindValue(":pre", $consumidor['pre']);
                    $sql->bindValue(":bronze", $consumidor['bronze']);
                    $sql->bindValue(":prata", $consumidor['prata']);
                    $sql->bindValue(":ouro", $consumidor['ouro']);
                    $sql->bindValue(":rubi", $consumidor['rubi']);
                    $sql->bindValue(":diamante", $consumidor['diamante']);
                    $sql->bindValue(":duploDiamante", $consumidor['duploDiamante']);
                    $sql->execute();
            } else {
                $sql = "SELECT id_dad FROM user WHERE id = :id ";
                    $sql = $this->db->prepare($sql);        
                    $sql->bindValue(":id", $id);
                    $sql->execute();

                    if($sql->rowCount() > 0) {  
                        $id_dad = $sql->fetch(PDO::FETCH_ASSOC);
                        
                        $sql = "INSERT INTO qualificados (id_user, patent, id_dad, pre, bronze, prata, ouro, rubi, diamante, duploDiamante, mes, ano) VALUES (:id_user, :patent, :id_dad, :pre, :bronze, :prata, :ouro, :rubi, :diamante, :duploDiamante, :mes, :ano)";
                        $sql = $this->db->prepare($sql);
                        $sql->bindValue(":id_user", $id);
                        $sql->bindValue(":id_dad", $id_dad['id_dad']);
                        $sql->bindValue(":patent", $consumidor['patent']);
                        $sql->bindValue(":pre", $consumidor['pre']);
                        $sql->bindValue(":bronze", $consumidor['bronze']);
                        $sql->bindValue(":prata", $consumidor['prata']);
                        $sql->bindValue(":ouro", $consumidor['ouro']);
                        $sql->bindValue(":rubi", $consumidor['rubi']);
                        $sql->bindValue(":diamante", $consumidor['diamante']);
                        $sql->bindValue(":duploDiamante", $consumidor['duploDiamante']);
                        $sql->bindValue(":mes", $mes);
                        $sql->bindValue(":ano", $ano);
                        $sql->execute();
                    }
            }
        return $consumidor;
    }
}