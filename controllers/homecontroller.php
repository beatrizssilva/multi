<?php

class homecontroller extends controller { 
   
    public function index() {
        $dados = array();
        if(isset($_SESSION['multLogin']) && !empty($_SESSION['multLogin'])){
        global $config;
    
        
        $u = new usuarios();
        $c = new comissao();
    
    
    
        //getDadosUser -> seleciona as informações do usuario
        $dados['dadosUser'] = $u->getDadosUser($_SESSION['multLogin']);
        
        //getFilhos -> seleciona a arvore até a 5ª geração definida na global $config
        $dados['filhos'] = $u->getFilhos($_SESSION['multLogin'], $config['limit']);
        
        //getPremios -> seleciona a premiação do usuario
        $dados['premios'] = $c->getPremios($_SESSION['multLogin']);
        
        $dados['perfil'] = $u->getDadosAfiliados($_SESSION['multLogin']);
        $dados['dados'] = $this->graduacao($_SESSION['multLogin']);
        $this->loadTemplatePanel('painel', $dados);
        
        } else {
            $this->loadTemplateLogin('login', $dados);
        }
    }   
   
    public function graduacao($id){
        $p = new patentes();  
        $dados = array();
        
      
        $dados['graduacao'] = $p->cadeiaAtivos($id);
        
        $l = 1;
        $linha = array();
       
        foreach ($dados['graduacao'] as $user){    

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
            if(isset($user['diamante']) && $user['diamante'] > 0){
                $linha[$l]['diamante'] += $user['diamante'];
            }
            if(isset($user['duploDiamante']) && $user['duploDiamante'] > 0){
                $linha[$l]['DuploDiamante'] += $user['duploDiamante']; 
            }
            
            if(isset($user['ativo']) && $user['ativo'] > 0){
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
        $array['pre'] = $qtdePre;
        $array['bronze'] = $qtdeBronze;
        $array['prata'] = $qtdePrata;
        $array['ouro'] = $qtdeOuro;
        $array['rubi'] = $qtdeRubi;
        $array['diamante'] = $qtdeDiamante;
        $array['duploDiamante'] = $qtdeDuploDiamante;
        $array['F.Ativos'] = $dados['graduacao']['filhosAtivos']['ativos'];
        $dados['dados'] = $array;
        return $dados;
    }
}

