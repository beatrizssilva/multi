<h1>Teste - Arvore Completa</h1>
<?php 


    $l = 1;
    $linha = array();
    
     if($arvore['filhosAtivos']['ativos'] >= 1){
        echo 'Um ou Mais Ativos na Primeira Camada.<br/>';
       
foreach ($arvore as $user){    
    
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
     } else {
         echo 'Não há ativos na primeira camada.<br/>';
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
     echo'<br/><pre>';
     if($arvore['filhosAtivos']['ativos'] >= 1){
        echo 'Um ou Mais Ativos na Primeira Camada.<br/>';
     } else {
         echo 'Não há ativos na primeira camada.<br/>';
     }
     
     echo 'Quantas linhas tem usuarios Pré? '.$qtdePre;
     echo '<br/>Quantas linhas tem usuarios Bronze? '.$qtdeBronze;
     echo '<br/>Quantas linhas tem usuarios Prata? '.$qtdePrata;
     echo '<br/>Quantas linhas tem usuarios Ouro? '.$qtdeOuro;
     echo '<br/>Quantas linhas tem usuarios Rubi? '.$qtdeRubi;
     echo '<br/>Quantas linhas tem usuarios Diamante? '.$qtdeDiamante;
     echo '<br/>Quantas linhas tem usuarios Duplo Diamante? '.$qtdeDuploDiamante;
     $p = 1;
     if($qtdePre >= 3){
        $p = 2;
     }
     if($qtdeBronze >= 3){
        $p = 3;
     }
     if($qtdePrata >= 3){
        $p = 4;
     }
     if($qtdeOuro >= 3){
        $p = 5;
     }
     if($qtdeRubi >= 3){
        $p = 6;
     }
     if($qtdeDiamante >= 3){
        $p = 7;
     }
     
     echo '<hr>';
     switch($p){
         case '1':
             $patent = "Consumidor Pré.";
             break;
         case '2':
             $patent = "Consumidor Bronze.";
             break;
         case '3':
             $patent = "Consumidor Prata.";
             break;
         case '4':
             $patent = "Consumidor Ouro.";
             break;
         case '5':
             $patent = "Consumidor Rubi.";
             break;
         case '6':
             $patent = "Consumidor Diamante.";
             break;
         case '7':
             $patent = "Consumidor Duplo Diamante.";
             break;
     }
     echo 'Você é: '.$patent;
?>












<a href="<?php echo BASE_URL;?>">Voltar</a>