<h1>Teste - Arvore Completa</h1>
<?php 
    $pre = 0; $bronze = 0; $prata = 0; $ouro = 0; $rubi = 0; $diamante = 0; $duploDiamante = 0;
    $pre2 = 0; $bronze2 = 0; $prata2 = 0; $ouro2 = 0; $rubi2 = 0; $diamante2 = 0; $duploDiamante2 = 0;
    $pre3 = 0; $bronze3 = 0; $prata3 = 0; $ouro3 = 0; $rubi3 = 0; $diamante3 = 0; $duploDiamante3 = 0;
    $pre4 = 0; $bronze4 = 0; $prata4 = 0; $ouro4 = 0; $rubi4 = 0; $diamante4 = 0; $duploDiamante4 = 0;
    $pre5 = 0; $bronze5 = 0; $prata5 = 0; $ouro5 = 0; $rubi5 = 0; $diamante5 = 0; $duploDiamante5 = 0;
    $firstPre = 0; $secondPre = 0; $thirtPre = 0; $fourtPre = 0; $fiftPre = 0;
    $firstBronze = 0; $secondBronze = 0; $thirtBronze = 0; $fourtBronze = 0; $fiftBronze = 0;
    $firstPrata = 0; $secondPrata = 0; $thirtPrata = 0; $fourtPrata = 0; $fiftPrata = 0;
    $firstOuro = 0; $secondOuro = 0; $thirtOuro = 0; $fourtOuro = 0; $fiftOuro = 0;
    $firstRubi = 0; $secondRubi = 0; $thirtRubi = 0; $fourtRubi = 0; $fiftRubi = 0;
    $firstDiamante = 0; $secondDiamante = 0; $thirtDiamante = 0; $fourtDiamante = 0; $fiftDiamante = 0;
    $firstDuploDiamante = 0; $secondDuploDiamante = 0; $thirtDuploDiamante = 0; $fourtDuploDiamante = 0; $fiftDuploDiamante = 0;
    
foreach ($arvore as $user){
    $pre += $user['pre'];
    $bronze += $user['bronze'];
    $prata += $user['prata'];
    $ouro += $user['ouro'];
    $rubi += $user['rubi'];
    $diamante += $user['diamante'];
    $duploDiamante += $user['duploDiamante']; 
    
    echo 'Primeira Linha - user: '.$user['id_user'].'<br/>';
    echo 'Consumirdores Pre: '.$pre.'<br/>';
    echo 'Consumirdores Bronze: '.$bronze.'<br/>';
    echo 'Consumirdores Prata: '.$prata.'<br/>';
    echo 'Consumirdores Ouro: '.$ouro.'<br/>';
    echo 'Consumirdores Rubi: '.$rubi.'<br/>';
    echo 'Consumirdores Diamante: '.$diamante.'<br/>';
    echo 'Consumirdores Duplo Diamante: '.$duploDiamante.'<br/>';
    echo '<hr>';
    
    $firstPre += $pre; $firstBronze += $bronze; $firstPrata += $prata; $firstOuro += $ouro; $firstRubi += $rubi; $firstDiamante += $diamante; $firstDuploDiamante += $duploDiamante;
    
    if(isset($user['qualificados']) && $user['qualificados'] > 0){
        foreach ($user['qualificados'] as $user){
            $pre2 += $user['pre'];
            $bronze2 += $user['bronze'];
            $prata2 += $user['prata'];
            $ouro2 += $user['ouro'];
            $rubi2 += $user['rubi'];
            $diamante2 += $user['diamante'];
            $duploDiamante2 += $user['duploDiamante']; 
            
            echo '<ul>Segunda Linha - user: '.$user['id_user'].'<br/>';
            echo 'Consumirdores Pre: '.$pre2.'<br/>';
            echo 'Consumirdores Bronze: '.$bronze2.'<br/>';
            echo 'Consumirdores Prata: '.$prata2.'<br/>';
            echo 'Consumirdores Ouro: '.$ouro2.'<br/>';
            echo 'Consumirdores Rubi: '.$rubi2.'<br/>';
            echo 'Consumirdores Diamante: '.$diamante2.'<br/>';
            echo 'Consumirdores Duplo Diamante: '.$duploDiamante2.'<br/></ul>';
            echo '<hr>';
            
            $secondPre += $pre2; $secondBronze += $bronze2; $secondPrata += $prata2; $secondOuro += $ouro2; $secondRubi += $rubi2; $secondDiamante += $diamante2; $secondDuploDiamante += $duploDiamante2;
            
            if(isset($user['qualificados']) && $user['qualificados'] > 0){
                foreach ($user['qualificados'] as $user){
                    $pre3 += $user['pre'];
                    $bronze3 += $user['bronze'];
                    $prata3 += $user['prata'];
                    $ouro3 += $user['ouro'];
                    $rubi3 += $user['rubi'];
                    $diamante3 += $user['diamante'];
                    $duploDiamante3 += $user['duploDiamante']; 
                    
                    echo '<ul style="margin-left:40px">Terceira Linha - user: '.$user['id_user'].'<br/>';
                    echo 'Consumirdores Pre: '.$pre3.'<br/>';
                    echo 'Consumirdores Bronze: '.$bronze3.'<br/>';
                    echo 'Consumirdores Prata: '.$prata3.'<br/>';
                    echo 'Consumirdores Ouro: '.$ouro3.'<br/>';
                    echo 'Consumirdores Rubi: '.$rubi3.'<br/>';
                    echo 'Consumirdores Diamante: '.$diamante3.'<br/>';
                    echo 'Consumirdores Duplo Diamante: '.$duploDiamante3.'<br/></ul>';
                    echo '<hr>';
                    
                    $thirtPre += $pre3; $thirtBronze += $bronze3; $thirtPrata += $prata3; $thirtOuro += $ouro3; $thirtRubi += $rubi3; $thirtDiamante += $diamante3; $thirtDuploDiamante += $duploDiamante3;
                    
                    if(isset($user['qualificados']) && $user['qualificados'] > 0){
                        foreach ($user['qualificados'] as $user){
                            $pre4 += $user['pre'];
                            $bronze4 += $user['bronze'];
                            $prata4 += $user['prata'];
                            $ouro4 += $user['ouro'];
                            $rubi4 += $user['rubi'];
                            $diamante4 += $user['diamante'];
                            $duploDiamante4 += $user['duploDiamante']; 
                            
                            echo '<ul style="margin-left:70px">Quarta Linha - user: '.$user['id_user'].'<br/>';
                            echo 'Consumirdores Pre: '.$pre4.'<br/>';
                            echo 'Consumirdores Bronze: '.$bronze4.'<br/>';
                            echo 'Consumirdores Prata: '.$prata4.'<br/>';
                            echo 'Consumirdores Ouro: '.$ouro4.'<br/>';
                            echo 'Consumirdores Rubi: '.$rubi4.'<br/>';
                            echo 'Consumirdores Diamante: '.$diamante4.'<br/>';
                            echo 'Consumirdores Duplo Diamante: '.$duploDiamante4.'<br/></ul>';
                            echo '<hr>';
                            
                            $fourtPre += $pre4; $fourtBronze += $bronze4; $fourtPrata += $prata4; $fourtOuro += $ouro4; $fourtRubi += $rubi4; $fourtDiamante += $diamante4; $fourtDuploDiamante += $duploDiamante4;
                            
                            if(isset($user['qualificados']) && $user['qualificados'] > 0){
                                foreach ($user['qualificados'] as $user){
                                    $pre5 += $user['pre'];
                                    $bronze5 += $user['bronze'];
                                    $prata5 += $user['prata'];
                                    $ouro5 += $user['ouro'];
                                    $rubi5 += $user['rubi'];
                                    $diamante5 += $user['diamante'];
                                    $duploDiamante5 += $user['duploDiamante']; 
                                    echo '<ul style="margin-left:100px">Quinta Linha - user: '.$user['id_user'].'<br/>';
                                    echo 'Consumirdores Pre: '.$pre5.'<br/>';
                                    echo 'Consumirdores Bronze: '.$bronze5.'<br/>';
                                    echo 'Consumirdores Prata: '.$prata5.'<br/>';
                                    echo 'Consumirdores Ouro: '.$ouro5.'<br/>';
                                    echo 'Consumirdores Rubi: '.$rubi5.'<br/>';
                                    echo 'Consumirdores Diamante: '.$diamante5.'<br/>';
                                    echo 'Consumirdores Duplo Diamante: '.$duploDiamante5.'<br/></ul>';
                                    echo '<hr>';
                                    
                                    $fiftPre += $pre5; $fourtBronze += $bronze5; $fiftPrata += $prata5; $fiftOuro += $ouro5; $fiftRubi += $rubi5; $fiftDiamante += $diamante5; $fiftDuploDiamante += $duploDiamante5;
                                
                                    $pre5 = 0;
                                    $bronze5 = 0;
                                    $prata5 = 0;
                                    $ouro5 = 0;
                                    $rubi5 = 0;
                                    $diamante5 = 0;
                                    $duploDiamante5 = 0;
                                }
                            }
                        
                            $pre4 = 0;
                            $bronze4 = 0;
                            $prata4 = 0;
                            $ouro4 = 0;
                            $rubi4 = 0;
                            $diamante4 = 0;
                            $duploDiamante4 = 0;
                            }
                        }
                        
                        $pre3 = 0;
                        $bronze3 = 0;
                        $prata3 = 0;
                        $ouro3 = 0;
                        $rubi3 = 0;
                        $diamante3 = 0;
                        $duploDiamante3 = 0;
                    }
                }        
                
                $pre2 = 0;
                $bronze2 = 0;
                $prata2 = 0;
                $ouro2 = 0;
                $rubi2 = 0;
                $diamante2 = 0;
                $duploDiamante2 = 0;
            
            }    
        }

        $pre = 0;
        $bronze = 0;
        $prata = 0;
        $ouro = 0;
        $rubi = 0;
        $diamante = 0;
        $duploDiamante = 0;
    }
echo 'Pre Primeira Linha: '.$firstPre.'<br/>';
echo 'Pre Segunda Linha: '.$secondPre.'<br/>';
echo 'Pre Terceira Linha: '.$thirtPre.'<br/>';
echo 'Pre Quarta Linha: '.$fourtPre.'<br/>';
echo 'Pre Quinta Linha: '.$fiftPre.'<br/><hr>';
echo 'Bronze Primeira Linha: '.$firstBronze.'<br/>';
echo 'Bronze Segunda Linha: '.$secondBronze.'<br/>';
echo 'Bronze Terceira Linha: '.$thirtBronze.'<br/>';
echo 'Bronze Quarta Linha: '.$fourtBronze.'<br/>';
echo 'Bronze Quinta Linha: '.$fiftBronze.'<br/><hr>';
echo 'Prata Primeira Linha: '.$firstPrata.'<br/>';
echo 'Prata Segunda Linha: '.$secondPrata.'<br/>';
echo 'Prata Terceira Linha: '.$thirtPrata.'<br/>';
echo 'Prata Quarta Linha: '.$fourtPrata.'<br/>';
echo 'Prata Quinta Linha: '.$fiftPrata.'<br/><hr>';
echo 'Ouro Primeira Linha: '.$firstOuro.'<br/>';
echo 'Ouro Segunda Linha: '.$secondOuro.'<br/>';
echo 'Ouro Terceira Linha: '.$thirtOuro.'<br/>';
echo 'Ouro Quarta Linha: '.$fourtOuro.'<br/>';
echo 'Ouro Quinta Linha: '.$fiftOuro.'<br/><hr>';
echo 'Rubi Primeira Linha: '.$firstRubi.'<br/>';
echo 'Rubi Segunda Linha: '.$secondRubi.'<br/>';
echo 'Rubi Terceira Linha: '.$thirtRubi.'<br/>';
echo 'Rubi Quarta Linha: '.$fourtRubi.'<br/>';
echo 'Rubi Quinta Linha: '.$fiftRubi.'<br/><hr>';
echo 'Diamante Primeira Linha: '.$firstDiamante.'<br/>';
echo 'Diamante Segunda Linha: '.$secondDiamante.'<br/>';
echo 'Diamante Terceira Linha: '.$thirtDiamante.'<br/>';
echo 'Diamante Quarta Linha: '.$fourtDiamante.'<br/>';
echo 'Diamante Quinta Linha: '.$fiftDiamante.'<br/><hr>';
echo 'Duplo Diamante Primeira Linha: '.$firstDuploDiamante.'<br/>';
echo 'Duplo Diamante Segunda Linha: '.$secondDuploDiamante.'<br/>';
echo 'Duplo Diamante Terceira Linha: '.$thirtDuploDiamante.'<br/>';
echo 'Duplo Diamante Quarta Linha: '.$fourtDuploDiamante.'<br/>';
echo 'Duplo Diamante Quinta Linha: '.$fiftDuploDiamante.'<br/><hr>';

//echo '<pre>';
// print_r($arvore);

?>












<a href="<?php echo BASE_URL;?>">Voltar</a>