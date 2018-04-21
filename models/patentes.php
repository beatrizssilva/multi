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
            //atualiza a tabela de qualificados
            $this->qualificados();
            foreach($usuarios as $chave => $usuario) {
                $usuarios[$chave]['pontuacao'] = $this->getPontos($usuario['id']);
                $usuarios[$chave]['resultado'] = $this->cadeiaAtivos($usuario['id']);                
                
                $l = 1;
                $linha = array();
    
    //['filhosAtivos']['ativos'] -> quantidade de filhos ativos na primeira camada
     if($usuarios[$chave]['resultado']['filhosAtivos']['ativos'] >= 1){
               
        foreach ($usuarios[$chave]['resultado'] as $user){    

            $linha[$l]['pre'] = 0;
            $linha[$l]['bronze'] = 0;
            $linha[$l]['prata'] = 0;
            $linha[$l]['ouro'] = 0;
            $linha[$l]['rubi'] = 0;
            $linha[$l]['diamante'] = 0;
            $linha[$l]['DuploDiamante'] = 0;
            
            if(isset($user['pre']) && $user['pre'] > 0){
                $linha[$l]['pre'] += $user['pre'];
            }
            if(isset($user['bronze']) && $user['bronze'] > 0){
                $linha[$l]['bronze'] += $user['bronze'];
            }
            if(isset($user['prata']) && $user['prata'] > 0){
                $linha[$l]['prata'] += $user['prata'];
            }
            if(isset($user['ouro']) && $user['ouro'] > 0){
                $linha[$l]['ouro'] += $user['ouro'];
            }
            if(isset($user['rubi']) && $user['rubi'] > 0){
                $linha[$l]['rubi'] += $user['rubi'];
            }
            if(isset($user['pdiamantere']) && $user['diamante'] > 0){
                $linha[$l]['diamante'] += $user['diamante'];
            }
            if(isset($user['pduploDiamantere']) && $user['duploDiamante'] > 0){
                $linha[$l]['DuploDiamante'] += $user['duploDiamante']; 
            }
            
            if($user['ativo'] > 0){
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
            }
            //qualificados -> função complementar para puxar os filhos dos filhos ativos
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
        
        return $usuarios;
    }
    
    //atualiza as comissoes do usuario na tabela comissao
    public function getComissao(){
        $sql = "SELECT id FROM user ORDER BY id ASC";
        $sql = $this->db->query($sql);
        
        if($sql->rowCount() > 0) {
            $user = $sql->fetchAll();                     
        
            foreach ($user as $usuario) {                
        
                $sql = "SELECT * FROM user WHERE id_dad = :id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id", $usuario['id']);
                $sql->execute();

                if($sql->rowCount() > 0) {
                    $ids = $sql->fetchAll();
                }
                $comissao = 0;
                foreach ($ids as $filho){
                    $sql = "SELECT * FROM comissao WHERE id_user = :id";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":id", $usuario['id']);
                    $sql->execute();

                    if($sql->rowCount() > 0) {
                        $valores = $sql->fetch();    
                        
                    }
                    $sql = "SELECT * FROM comissao WHERE id_user = :id";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":id", $filho['id']);
                    $sql->execute();
                    if($sql->rowCount() > 0) {
                        $f = $sql->fetch();
                        $x = $valores['percentual'] - $f['percentual'];
                        
                        $comissao += floatval($f['valor_cadeia'] * $x)/100;   
                       
                    }
                }
                if($comissao > 0){
                    $mes = date('m');
                    $ano = date('Y');
                    $sql = "UPDATE comissao SET comissao = :comissao WHERE id = :id";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":id", $valores['id']);
                    $sql->bindValue(":comissao", $comissao);
                    $sql->execute();
                }
            }
        }
    }
    
    //atualiza o valor da comissao na tabela comissao
    public function setComissao(){
        $sql = "SELECT id, patent FROM user ORDER BY id DESC";
        $sql = $this->db->query($sql);
        
        if($sql->rowCount() > 0) {
            $usuarios = $sql->fetchAll();                     
        }
        foreach ($usuarios as $user){   
            switch ($user['patent']){
                case '1':
                    $percentual = 0;
                    break;
                case '2':
                    $percentual = 3;
                    break;
                case '3':
                    $percentual = 6;
                    break;
                case '4':
                    $percentual = 9;
                    break;
                case '5':
                    $percentual = 12;
                    break;
                case '6':
                    $percentual = 15;
                    break;
                case '7':
                    $percentual = 18;
                    break;
            }
            $mes = date('m');
            $ano = date('Y');
            $sql = "SELECT pontos FROM comissoes WHERE id_user = :id_user AND mes = :mes AND ano = :ano";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_user", $user['id']);
            $sql->bindValue(":mes", $mes);
            $sql->bindValue(":ano", $ano);
            $sql->execute();
            
            if($sql->rowCount() > 0) {
                $pontos = $sql->fetch();
            } else {
                $pontos['pontos'] = 0;
            }
            
            $sql = "SELECT SUM(qtde) as qtde FROM transacoes WHERE id_user = :id_user AND MONTH(data) = :mes";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_user", $user['id']);
            $sql->bindValue(":mes", $mes);
            $sql->execute();
            
            if($sql->rowCount() > 0) {
                $transacoes = $sql->fetch();
                $qtde = $transacoes['qtde'] * 220;
            } else {
                $qtde = 0;
            }
            
            
            $mes = date('m');
            $ano = date('Y');
            $sql = "SELECT id FROM comissao WHERE id_user = :id_user AND mes = :mes AND ano = :ano";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_user", $user['id']);
            $sql->bindValue(":mes", $mes);
            $sql->bindValue(":ano", $ano);
            $sql->execute();
            
            $valor_cadeia = $pontos['pontos'] + $qtde;
            
            if($sql->rowCount() > 0) {
                $resultado = $sql->fetch();
                
                $mes = date('m');
                $ano = date('Y');
                $sql = "UPDATE comissao SET  valor_cadeia = :valor, percentual = :percentual WHERE id = :id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id", $resultado['id']);
                $sql->bindValue(":valor", $valor_cadeia);
                $sql->bindValue(":percentual", $percentual);
                $sql->execute();

            } else {

                $mes = date('m');
                $ano = date('Y');
                                
                $sql = "INSERT INTO comissao (id_user, valor_cadeia, percentual, mes, ano) VALUES (:id_user, :valor, :percentual, :mes, :ano)";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id_user", $user['id']);
                $sql->bindValue(":valor", $valor_cadeia);
                $sql->bindValue(":percentual", $percentual);
                $sql->bindValue(":mes", $mes);
                $sql->bindValue(":ano", $ano);
                $sql->execute();               
                
            }
        }
       
    }

    //pega a quantidade de pontos do usuario
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
    
    //atualiza a tabela qualificados para calulcar a quantidade filhos por graduação ativos por linha
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
    
    //função complementar da função qualificados
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
        
        $sql = "SELECT patent, ativo FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {  
            
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
       
        $consumidor['patent'] = $array['patent'];
        $consumidor['ativo'] = $array['ativo'];
        
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
                                    
                    $sql = "UPDATE qualificados SET patent = :patent, ativo = :ativo, pre = :pre, bronze = :bronze, prata = :prata, ouro = :ouro, rubi = :rubi, diamante = :diamante, duploDiamante = :duploDiamante WHERE id = :id";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":id", $id_table['id']);
                    $sql->bindValue(":patent", $consumidor['patent']);
                    $sql->bindValue(":ativo", $consumidor['ativo']);
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
                        
                        $sql = "INSERT INTO qualificados (id_user, patent, ativo, id_dad, pre, bronze, prata, ouro, rubi, diamante, duploDiamante, mes, ano) VALUES (:id_user, :patent, :ativo, :id_dad, :pre, :bronze, :prata, :ouro, :rubi, :diamante, :duploDiamante, :mes, :ano)";
                        $sql = $this->db->prepare($sql);
                        $sql->bindValue(":id_user", $id);
                        $sql->bindValue(":id_dad", $id_dad['id_dad']);
                        $sql->bindValue(":patent", $consumidor['patent']);
                        $sql->bindValue(":ativo", $consumidor['ativo']);
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
    
    //Calcula a quantidade de filhos Ativos - cadeiaComplementar: Calcula os filhos dos filhos ativos
     public function cadeiaAtivos($id){
        
        $array = array();
        
         $sql = "SELECT COUNT(id) as ativos FROM user WHERE id_dad = :id_dad AND ativo = 1";
        $sql = $this->db->prepare($sql);
        $sql->bindvalue(":id_dad", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) { 
            $filhos = $sql->fetch(PDO::FETCH_ASSOC);           
        }
                       
        $array = $this->cadeiaComplementar($id);
        
        $array['filhosAtivos'] = $filhos;//ativos da primeira camada
        return $array;
    }
    //função complementar da função cadeiaAtivos
    public function cadeiaComplementar($id){
        $array = array();
       
        
        $sql = "SELECT *, (select user.ativo from user where user.id = qualificados.id_user) as ativo FROM qualificados WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_dad", $id);
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