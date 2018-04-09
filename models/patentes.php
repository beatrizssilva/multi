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
                $usuarios[$chave]['resultado'] = $this->cadeiaPatente($usuario['id']);
                
                
                $l = 1;
                $linha = array();
    
     if($usuarios[$chave]['resultado']['filhosAtivos']['ativos'] >= 1){
               
        foreach ($usuarios[$chave]['resultado'] as $user){    

            $linha[$l]['pre'] = 0;
            $linha[$l]['bronze'] = 0;
            $linha[$l]['prata'] = 0;
            $linha[$l]['ouro'] = 0;
            $linha[$l]['rubi'] = 0;
            $linha[$l]['diamante'] = 0;
            $linha[$l]['DuploDiamante'] = 0;

            $linha[$l]['pre'] += $user['pre'];
            $linha[$l]['bronze'] += intval($user['bronze']);
            $linha[$l]['prata'] += $user['prata'];
            $linha[$l]['ouro'] += $user['ouro'];
            $linha[$l]['rubi'] += $user['rubi'];
            $linha[$l]['diamante'] += $user['diamante'];
            $linha[$l]['DuploDiamante'] += $user['duploDiamante']; 
            switch ($user['patent']){
                case '1':
                $linha[$l]['pre'] += 1;
                break;
                case '2':
                $linha[$l]['bronze'] += 1;
                break;
                case '3':
                $linha[$l]['prata'] += 1;
                break;
                case '4':
                $linha[$l]['ouro'] += 1;
                break;
                case '5':
                $linha[$l]['rubi'] += 1;
                break;
                case '6':
                $linha[$l]['diamante'] += 1;
                break;
                case '7':
                $linha[$l]['DuploDiamante'] += 1;
                break;    
            }

            if(isset($user['qualificados']) && $user['qualificados'] > 0){
                foreach ($user['qualificados'] as $user){
                    $linha[$l]['pre'] += $user['pre'];
                    $linha[$l]['bronze'] += $user['bronze'];
                    $linha[$l]['prata'] += $user['prata'];
                    $linha[$l]['ouro'] += $user['ouro'];
                    $linha[$l]['rubi'] += $user['rubi'];
                    $linha[$l]['diamante'] += $user['diamante'];
                    $linha[$l]['DuploDiamante'] += $user['duploDiamante']; 

                    if(isset($user['qualificados']) && $user['qualificados'] > 0){
                        foreach ($user['qualificados'] as $user){                    
                            $linha[$l]['pre'] += $user['pre'];
                            $linha[$l]['bronze'] += $user['bronze'];
                            $linha[$l]['prata'] += $user['prata'];
                            $linha[$l]['ouro'] += $user['ouro'];
                            $linha[$l]['rubi'] += $user['rubi'];
                            $linha[$l]['diamante'] += $user['diamante'];
                            $linha[$l]['DuploDiamante'] += $user['duploDiamante']; 

                            if(isset($user['qualificados']) && $user['qualificados'] > 0){
                                foreach ($user['qualificados'] as $user){                            
                                    $linha[$l]['pre'] += $user['pre'];
                                    $linha[$l]['bronze'] += $user['bronze'];
                                    $linha[$l]['prata'] += $user['prata'];
                                    $linha[$l]['ouro'] += $user['ouro'];
                                    $linha[$l]['rubi'] += $user['rubi'];
                                    $linha[$l]['diamante'] += $user['diamante'];
                                    $linha[$l]['DuploDiamante'] += $user['duploDiamante']; 

                                    if(isset($user['qualificados']) && $user['qualificados'] > 0){
                                        foreach ($user['qualificados'] as $user){                                    
                                            $linha[$l]['pre'] += $user['pre'];
                                            $linha[$l]['bronze'] += $user['bronze'];
                                            $linha[$l]['prata'] += $user['prata'];
                                            $linha[$l]['ouro'] += $user['ouro'];
                                            $linha[$l]['rubi'] += $user['rubi'];
                                            $linha[$l]['diamante'] += $user['diamante'];
                                            $linha[$l]['DuploDiamante'] += $user['duploDiamante']; 

                                        }
                                    }
                                }
                            }
                        }
                    }                    
                }    
            }
                $l++;
        }
    } 
        $linhas = count($linha);    

        $qtdePre = 0;
        $qtdeBronze = 0;
        $qtdePrata = 0;
        $qtdeOuro = 0;
        $qtdeRubi = 0;
        $qtdeDiamante = 0;
        $qtdeDuploDiamante = 0;

        for($q = 1; $q < $linhas; $q++){
            if($linha[$q]['pre'] >= 1){
                $qtdePre += 1;
            }
            if($linha[$q]['bronze'] >= 1){
                $qtdeBronze += 1;
            }
            if($linha[$q]['prata'] >= 1){
                $qtdePrata += 1;
            }
            if($linha[$q]['ouro'] >= 1){
                $qtdeOuro += 1;
            }
            if($linha[$q]['rubi'] >= 1){
                $qtdeRubi += 1;
            }
            if($linha[$q]['diamante'] >= 1){
                $qtdeDiamante += 1;
            }
            if($linha[$q]['DuploDiamante'] >= 1){
                $qtdeDuploDiamante += 1;
            }
        }
        $p = 1;
        if($qtdePre >= 3 && intval($usuarios[$chave]['pontuacao']) >= 2000){
           $p = 2;
        }
        if($qtdeBronze >= 3 && intval($usuarios[$chave]['pontuacao']) >= 6000){
           $p = 3;
        }
        if($qtdePrata >= 3 && intval($usuarios[$chave]['pontuacao']) >= 18000){
           $p = 4;
        }
        if($qtdeOuro >= 3 && intval($usuarios[$chave]['pontuacao']) >= 60000){
           $p = 5;
        }
        if($qtdeRubi >= 3 && intval($usuarios[$chave]['pontuacao']) >= 180000){
           $p = 6;
        }
        if($qtdeDiamante >= 3 && intval($usuarios[$chave]['pontuacao']) >= 540000){
           $p = 7;
        }

                
            $sql = "UPDATE user SET patent = :patente WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":patente", $p);
            $sql->bindValue(":id", $usuario['id']);
            $sql->execute();
            
            $sql = "UPDATE qualificados SET patent = :patente WHERE id_user = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":patente", $p);
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
    
//    public function calcularFilhosAtivos($id, $limite, &$ativos) {
//	$lista = array();
//	
//
//	$sql = "SELECT * FROM user WHERE id_dad = :id";
//        $sql = $this->db->prepare($sql);
//	$sql->bindValue(":id", $id);
//	$sql->execute();        
//	
//	if($sql->rowCount() > 0) {
//		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
//
//		foreach($lista as $chave => $usuario) {
//                $ativos += intval($usuario['ativo']);
//                    if($limite > 0) {
//                        $this->calcularFilhosTotal($usuario['id'], $limite-1, $ativos);            
//                    }
//		}
//	}
//        
//	return $ativos;
//    }
//    
//        public function calcularFilhosTotal($id, $limite) {
//	$lista = array();
//	
//
//	$sql = "SELECT * FROM user WHERE id_dad = :id";
//        $sql = $this->db->prepare($sql);
//	$sql->bindValue(":id", $id);
//	$sql->execute();
//	$consumidor = 0;
//	
//	if($sql->rowCount() > 0) {
//		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
//
//		$consumidor = $sql->rowCount();
//
//		foreach($lista as $chave => $usuario) {
//			if($limite > 0) {
//				$consumidor += $this->calcularFilhosTotal($usuario['id'], $limite-1);
//			}
//		}
//	}
//        
//	return $consumidor;
//    }
//    public function calcularFIlhosPre($id) {
//	$lista = array();
//	
//
//	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 1";
//        $sql = $this->db->prepare($sql);
//	$sql->bindValue(":id", $id);
//	$sql->execute();
//	$consumidor = 0;
//	
//	if($sql->rowCount() > 0) {
//		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
//		$consumidor = $sql->rowCount();
//	}
//        
//	return $consumidor;
//    }
//    
//     public function calcularFilhosBronze($id) {
//	$lista = array();
//	
//
//	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 2";
//        $sql = $this->db->prepare($sql);
//	$sql->bindValue(":id", $id);
//	$sql->execute();
//	$consumidor = 0;
//	
//	if($sql->rowCount() > 0) {
//		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
//		$consumidor = $sql->rowCount();
//	}
//        
//	return $consumidor;
//    }
//    
//    public function calcularFilhosPrata($id) {
//	$lista = array();
//	
//
//	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 3";
//        $sql = $this->db->prepare($sql);
//	$sql->bindValue(":id", $id);
//	$sql->execute();
//	$consumidor = 0;
//	
//	if($sql->rowCount() > 0) {
//		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
//		$consumidor = $sql->rowCount();
//	}
//        
//	return $consumidor;
//    }
//    
//    public function calcularFilhosOuro($id) {
//	$lista = array();
//	
//
//	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 4";
//        $sql = $this->db->prepare($sql);
//	$sql->bindValue(":id", $id);
//	$sql->execute();
//	$consumidor = 0;
//	
//	if($sql->rowCount() > 0) {
//		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
//		$consumidor = $sql->rowCount();
//	}
//        
//	return $consumidor;
//    }
//    
//    public function calcularFilhosRubi($id) {
//	$lista = array();
//	
//
//	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 5";
//        $sql = $this->db->prepare($sql);
//	$sql->bindValue(":id", $id);
//	$sql->execute();
//	$consumidor = 0;
//	
//	if($sql->rowCount() > 0) {
//		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
//		$consumidor = $sql->rowCount();
//	}
//        
//	return $consumidor;
//    }
//    
//    public function calcularFilhosDiamante($id) {
//	$lista = array();
//	
//
//	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 6";
//        $sql = $this->db->prepare($sql);
//	$sql->bindValue(":id", $id);
//	$sql->execute();
//	$consumidor = 0;
//	
//	if($sql->rowCount() > 0) {
//		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
//		$consumidor = $sql->rowCount();
//	}
//        
//	return $consumidor;
//    }
//    
//    public function calcularFilhosDuploDiamante($id) {
//	$lista = array();
//	
//
//	$sql = "SELECT * FROM user WHERE id_dad = :id AND ativo = 1 AND patent = 7";
//        $sql = $this->db->prepare($sql);
//	$sql->bindValue(":id", $id);
//	$sql->execute();
//	$consumidor = 0;
//	
//	if($sql->rowCount() > 0) {
//		$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
//		$consumidor = $sql->rowCount();
//	}
//        
//	return $consumidor;
//    }
    
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
    
     public function cadeiaPatente($id){
        
        $array = array();
        
         $sql = "SELECT COUNT(id) as ativos FROM user WHERE id_dad = :id_dad AND ativo = 1";
        $sql = $this->db->prepare($sql);
        $sql->bindvalue("id_dad", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) { 
            $filhos = $sql->fetch(PDO::FETCH_ASSOC);           
        }
                       
        $array = $this->cadeiaComplementar($id);
        
        $array['filhosAtivos'] = $filhos;//ativos da primeira camada
        return $array;
    }
    
    public function cadeiaComplementar($id){
        $array = array();
       
        
        $sql = "SELECT *, (select user.ativo from user where user.id = qualificados.id_user) as ativo FROM qualificados WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) { 
            
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
           
            foreach($array as $chave => $usuario){

                $array[$chave]['qualificados'] = array();                
                $array[$chave]['qualificados'] = $this->cadeiaComplementar($usuario['id_user']); 
                
            }
        }
        
        return $array;
    }
}