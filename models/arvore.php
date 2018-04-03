<?php
class arvore extends model {

    public function getList() {
        $array = array();
        
        $sql = "SELECT * FROM user ORDER BY id_dad DESC";
        $sql = $this->db->query($sql);
        
        if($sql->rowCount() > 0) {
            foreach($sql->fetchAll() as $item) {//para criar um campo no array de nome subs e incluir os valores
                $item['subs'] = array();
                $array[$item['id']] = $item;
            }
            while($this->aindaPrecisa($array)) {//enquanto retorna true 
                $this->organizarDependentes($array);
            }
        }
   
        return $array;
    }
    
        public function getUsuariosArvore($id) {
        $array = array();
        
        $filho = true;
        //enquanto $filho for true ($filho = se existe subcategoria)
        while($filho) {
            $sql = "SELECT * FROM categorias WHERE id = :id AND ativo = 1";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();
            //se houve resultado, adiciona o resultado no array
            if($sql->rowCount() > 0) {
                $sql = $sql->fetch();
                $array[] = $sql;
                //verificar se ainda existe subcategorias
                if(!empty($sql['sub'])) {
                    //se existe pega o valor da sub e coloca no id para a nova verificaçã do while
                    $id = $sql['sub'];
                }else {
                    $filho = false;
                }
            }
        }
        $array = array_reverse($array);
        return $array;
    }


    private function organizarDependentes(&$array){ //simbolo &= se a variavel for alterada, altera também a variavel de origem
        foreach ($array as $id => $item){
            if(isset($array[$item['id_dad']])) {//se existe sub
                $array[$item['id_dad']]['subs'][$item['id']] = $item;//pega o item e coloca dentro do array sub
                unset($array[$id]);//deleta o item para ficar somente dentro do sub
                break;// para e volta na verificação se aindaPrecisa
            }
        }
    }


    private function aindaPrecisa($array) { //metodo para verificar se há algum sub em branco, retorno true ou false
     foreach($array as $item) {
         if(!empty($item['id_dad'])) {
             return true;
         }
     }
     return false;
    }
    
    public function filhosPatentes($id, $limite){
        $array = array();
        
        $sql = "SELECT patent FROM user WHERE id = :id";
        $sql= $this->db->prepare($sql);
        $sql->bindValue("id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $pat = $sql->fetch(PDO::FETCH_ASSOC);
            $patent = intval($pat['patent']);
        }
        
        $sql = "SELECT *, (select patent.name from patent where patent.id = user.patent)as patente FROM user WHERE id_dad = :id_dad AND ativo = 1 AND patent <= :patent";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id);
        $sql->bindValue("patent", $patent);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array['qtde'] = $sql->rowCount();
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($array as $chave => $usuario){
                $array[$chave]['filhos'] = array();
                 
                if($limite > 0){
                    
                    $array[$chave]['filhos'] = $this->filhosPatentes($usuario['id'], $limite - 1);
                    
                }
            }
           
        }
        return $array;
    }
    
     public function cadeiaCompleta($id){
        $array = array();
        
             
        $sql = "SELECT *, (select patent.name from patent where patent.id = user.patent)as patente FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array['qtde'] = $sql->rowCount();
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
           
            foreach($array as $chave => $usuario){
                
                $array[$chave]['filhos'] = array();                
                    $array[$chave]['filhos'] = $this->cadeiaCompleta($usuario['id']); 
                    
            }
           
        }
        return $array;
    }
    
    public function cadeiaPatente($id, $limite){
        
        $array = array();
                             
        $sql = "SELECT * FROM qualificados WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
//            $array['qtde'] = $sql->rowCount();  
            
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
           
            foreach($array as $chave => $usuario){
                if($limite > 0){
                    $array[$chave]['qualificados'] = array();                
                    $array[$chave]['qualificados'] = $this->cadeiaPatente($usuario['id_user'], $limite - 1); 
                    
                }
            }
        }
        return $array;
    }
    
    public function patentesFilhos($id, $limite){
        $array = array();
        $sql = "SELECT * FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($array as $chave => $usuario){
                   if($limite > 0) {
                $array[$chave]['qualificados'] = array();                
                    $array[$chave]['qualificados'] = $this->cadeiaQualificadosFilhos($usuario['id'], $limite-1); 
                   }  
            }
        }
        return $array;
    }

     public function cadeiaQualificadosFilhos($id, $limite){
        $array = array();
        
        $sql = "SELECT * FROM qualificados WHERE id_user = :id_user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_user", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            
        }
        return $array;
    }
    
    public function cadeiaPatenteFilhos($id, $limite){
        $array = array();
                     
        $sql = "SELECT * FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id);
        $sql->execute();
        
        $consumidor = array();
        $consumidor['pre'] = 0;
        $consumidor['bronze'] = 0;
        $consumidor['prata'] = 0;
        $consumidor['ouro'] = 0;
        $consumidor['rubi'] = 0;
        $consumidor['diamante'] = 0;
        $consumidor['duploDiamante'] = 0;
        if($sql->rowCount() > 0) {  
            
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
           
            foreach($array as $chave => $usuario){              
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
                if($limite > 0) {
                    $array[$chave]['consumidor'] = array();                
                    $array[$chave]['consumidor'] = $this->cadeiaPatenteFilhos($usuario['id'], $limite-1); 
                }   
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

                    $sql = "UPDATE qualificados SET pre = :pre, bronze = :bronze, prata = :prata, ouro = :ouro, rubi = :rubi, diamante = :diamante, duploDiamante = :duploDiamante WHERE id = :id";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":id", $id_table['id']);
                    $sql->bindValue(":pre", $consumidor['pre']);
                    $sql->bindValue(":bronze", $consumidor['bronze']);
                    $sql->bindValue(":prata", $consumidor['prata']);
                    $sql->bindValue(":ouro", $consumidor['ouro']);
                    $sql->bindValue(":rubi", $consumidor['rubi']);
                    $sql->bindValue(":diamante", $consumidor['diamante']);
                    $sql->bindValue(":duploDiamante", $consumidor['duploDiamante']);
                    $sql->execute();
            } else {
                $sql = "INSERT INTO qualificados (id_user, pre, bronze, prata, ouro, rubi, diamante, duploDiamante, mes, ano) VALUES (:id_user, :pre, :bronze, :prata, :ouro, :rubi, :diamante, :duploDiamante, :mes, :ano)";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":id_user", $id);
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
        return $consumidor;
    }
    

}