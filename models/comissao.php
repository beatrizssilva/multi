<?php
class comissao extends model {
    
    //seleciona o valor da comissao da tabela comissao
    public function getComissao($id) {
        $c = 0;
        $mes = date('m');
        $ano = date('Y');
        $sql = "SELECT * FROM comissao WHERE id_user = :id AND mes = :mes AND ano = :ano";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":mes", $mes);
        $sql->bindValue(":ano", $ano);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $c = $sql->fetch();
            return $c;
        }
        
    }
   
    //seleciona os ganhos do usuario e atualiza a tabela ganhos
    public function atualizaGanhos() {
	       
        $sql = "SELECT id, patent FROM user";
        $sql = $this->db->query($sql);
        
        $usuarios = array();
       
        if($sql->rowCount() > 0) {
            $usuarios = $sql->fetchAll();
        }
        
        foreach ($usuarios as $user){
            global $config;
            $a = new arvore();
            $mes = date('m');
            $ano = date('Y');  
            
            //seleciona o valor da comissão($l['comissao']) caso tenha cargo de liderança
            $l = $this->getComissao($user['id']);
            $p = $this->getPontos($user['id']);
            $ativos = $a->pagamentoAtivacao($user['id'], $config['limit']);
            $indicados = $a->pagamentoIndicados($user['id'], $config['limit']);
            
            $n = $ativos * $config['premioAtivacao'];
            $n1 = $indicados * $config['premioIndicacao'];
            $total = $n+$n1+$l['comissao'];
            
            switch ($user['patent']){
                case '1':
                    if ($total > $config['bonusTotalPre']) {
                        $total = $config['bonusTotalPre'];
                    }
                    break;
                case '2':
                    if ($total > $config['bonusTotalBronze']) {
                        $total = $config['bonusTotalBronze'];
                    }
                    break;
                case '3':
                    if ($total > $config['bonusTotalPrata']) {
                        $total = $config['bonusTotalPrata'];
                    }
                    break;
                case '4':
                    if ($total > $config['bonusTotalOuro']) {
                        $total = $config['bonusTotalOuro'];
                    }
                    break;
                case '5':
                    if ($total > $config['bonusTotalRubi']) {
                        $total = $config['bonusTotalRubi'];
                    }
                    break;
                case '6':
                    if ($total > $config['bonusTotalDiamante']) {
                        $total = $config['bonusTotalDiamante'];
                    }
                    break;
                case '7':
                    if ($total > $config['bonusTotalDuploDiamante']) {
                        $total = $config['bonusTotalDuploDiamante'];
                    }
                    break;
            }
            
            
            //Seleciona na tabela ganhos se há um registro já cadastrado para atualização ou inserção
            $sql = "SELECT id FROM ganhos WHERE id_user = :id AND mes = :mes AND ano = :ano";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $user['id']);
            $sql->bindValue(":mes", $mes);
            $sql->bindValue(":ano", $ano);
            $sql->execute();
            
            if($sql->rowCount() > 0){
                $id_ganhos = $sql->fetch();
                $sql = "UPDATE ganhos SET id_user = :id_user, pontos = :pontos, indicados = :indicados, ativos = :ativos, patent = :patent, com_lider = :lideranca, valor_total = :total WHERE id = :id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id", $id_ganhos['id']);
                $sql->bindValue(":id_user", $user['id']);
                $sql->bindValue(":pontos", $p['pontos']);
                $sql->bindValue(":indicados", $indicados);
                $sql->bindValue(":ativos", $ativos);
                $sql->bindValue(":patent", $user['patent']);
                $sql->bindValue(":lideranca", $l['comissao']);
                $sql->bindValue(":total", $total);
                $sql->execute();
                
                $sql = "UPDATE user SET saldo = :saldo WHERE id = :id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id", $user['id']);
                $sql->bindValue(":saldo", $total);
                $sql->execute();
            } else {
                $sql = "INSERT INTO ganhos (id_user, mes, ano, pontos, indicados, ativos, patent, com_lider, valor_total) VALUES (:id_user, :mes, :ano, :pontos, :indicados, :ativos, :patent, :lideranca, :total)";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id_user", $user['id']);
                $sql->bindValue(":pontos", $p['pontos']);
                $sql->bindValue(":indicados", $indicados);
                $sql->bindValue(":ativos", $ativos);
                $sql->bindValue(":patent", $user['patent']);
                $sql->bindValue(":lideranca", $l['comissao']);
                $sql->bindValue(":total", $total);
                $sql->bindValue(":mes", $mes);
                $sql->bindValue(":ano", $ano);
                $sql->execute();
                
                $sql = "UPDATE user SET saldo = :saldo WHERE id = :id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id", $user['id']);
                $sql->bindValue(":saldo", $total);
                $sql->execute();
            }            
        }
    }
    
    //pegando a quantidade de pontos na tabela comissoes
    public function getPontos($id) {
	       
        $mes = date('m');
        $ano = date('Y');  
        
        $sql = "SELECT pontos FROM comissoes WHERE id_user = :id AND mes = :mes AND ano = :ano";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":mes", $mes);
        $sql->bindValue(":ano", $ano);
        $sql->execute();

        if($sql->rowCount() > 0){
            $c = $sql->fetch();
            return $c;
        }
    }
    
    public function getPremios($id){
        $mes = date('m');
        $ano = date('Y');  
        
        $sql = "SELECT * FROM ganhos WHERE id_user = :id AND mes = :mes AND ano = :ano";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":mes", $mes);
        $sql->bindValue(":ano", $ano);
        $sql->execute();

        if($sql->rowCount() > 0){
            $c = $sql->fetch();
            return $c;
        }
    }
  
}