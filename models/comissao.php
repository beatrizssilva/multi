<?php
class comissao extends model {
  

    public function calcularPontosTotal($id){
         $array = array();
        
              
        $sql = "SELECT *, (select sum(transacoes.qtde) from transacoes where transacoes.id_user = user.id) as compras FROM user WHERE id_dad = :id_dad ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array['qtde'] = $sql->rowCount();
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($array as $chave => $usuario){
                $array[$chave]['filhos'] = array();
                 
                    $array[$chave]['filhos'] = $this->calcularPontosTotal($usuario['id']);
                    
                
            }
           
        }
               
        return $array;       
    }
    
    public function calcularAtivacao($id){
         $array = array();
     $array['qtde'] = 0;
        $mes = 3;
        $sql = "SELECT * FROM user WHERE data_ativacao LIKE :data AND id_dad = :id_dad AND ativo = 1";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("data", '%'.$mes.'%');
        $sql->bindValue("id_dad", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array['qtde'] = $sql->rowCount();
//            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            
//            foreach($array as $chave => $usuario){
//                $array[$chave]['filhos'] = array();
//                 
//                    $array[$chave]['filhos'] = $this->calcularPontosTotal($usuario['id']);
//                    
//                
//            }
           
        }
       
               
        return $array['qtde']; 
    }
    
    public function calcularComissao() {
              
        $sql = "SELECT id, name FROM user ORDER BY id DESC";
        $sql = $this->db->query($sql);
        
        $usuarios = array();
       
        if($sql->rowCount() > 0) {
            $usuarios = $sql->fetchAll();
            
            foreach($usuarios as $chave => $usuario) {
                $usuarios[$chave]['pontuacao'] = $this->getValores($usuario['id']);
                }
        } 
                
//                echo '<pre>';
//                print_r($usuarios);
//                exit();
           
    }
    
    public function getValoresBronze($id) {
	$array = array();
        $sql = "SELECT patent FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetch();
            
            $sql = "SELECT *, (select comissoes.kits_geral from comissoes where comissoes.id_user = user.id)as kits_geral FROM user WHERE id_dad = :id_dad AND patent < :patent AND ativo = 1";
            $sql = $this->db->prepare($sql);
            $sql->bindValue("id_dad", $id);
            $sql->bindValue("patent", $array['patent']);
            $sql->execute();
            
            if($sql->rowCount() > 0){
                $array['qtde'] = $sql->rowCount();
                $array['kits'] = 0;
                $user = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($user as $usuario){
                    $array['kits'] += $usuario['kits_geral'];
                }
             }
             
             $sql = "SELECT *, (select sum(transacoes.qtde) from transacoes where transacoes.id_user = user.id) as compras FROM user WHERE id_dad = :id_dad AND patent < :patent AND ativo = 1";
            $sql = $this->db->prepare($sql);
            $sql->bindValue("patent", $array['patent']);
            $sql->bindValue("id_dad", $id);
            $sql->execute();
            
            if($sql->rowCount() > 0){
                $kits = $sql->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($kits as $kit) {
                    $array['kits'] += $kit['compras'];
                }
            }
        }
        return $array;
    }
}