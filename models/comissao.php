<?php
class comissao extends model {
    
    public function comissao_ativos($id, $limite){
        $array = array();

        $sql = "SELECT *, (select sum(transacoes.qtde) from transacoes where transacoes.id_user = user.id)as qtde FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id_dad", $id);
        $sql->execute();
        $total= 0;
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
           
            
            foreach($array as $chave => $usuario){
                $total += $array[$chave]['qtde'];
                $array[$chave]['filhos'] = array();
                if($limite > 0){
                    
                    $array[$chave]['filhos'] = $this->comissao_ativos($usuario['id'], $limite - 1);
                    $total += $array[$chave]['qtde'];
                }
                
            }
          
        }
           $array['total'] = $total;
        return $array;

    }
}