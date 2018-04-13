<h1>Teste - Arvore Completa</h1>
<?php 

$qtde = 0;
echo '<pre>';
print_r($ativacao);

   foreach ($ativacao as $ativos){
       if($ativos['ativo'] == 1){
            $qtde += 1;
       }
        $qtde += $ativos['filhosAtivos']['c'];
        if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
            foreach ($ativos['filhos'] as $ativos){
                $qtde += $ativos['filhosAtivos']['c']; 
                if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
                    foreach ($ativos['filhos'] as $ativos){
                        $qtde += $ativos['filhosAtivos']['c']; 
                        if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
                            foreach ($ativos['filhos'] as $ativos){
                                $qtde += $ativos['filhosAtivos']['c'];
                                if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
                                    foreach ($ativos['filhos'] as $ativos){
                                        $qtde += $ativos['filhosAtivos']['c'];
                                        if(isset($ativos['filhos']) && !empty($ativos['filhos'])){
                                            foreach ($ativos['filhos'] as $ativos){
                                                $qtde += $ativos['filhosAtivos']['c']; 
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
   }
   echo "Total de Ativados no mês: ".$qtde;
?>












<a href="<?php echo BASE_URL;?>">Voltar</a>