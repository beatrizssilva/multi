<?php 
ob_start();
?>
Nº  Descrição           Tamanho         Posição         Formato
1   Assalariado: Tipo   1               1               1
2   Assalariado: Numero 4               2               5
3   Nro                 4               6               9
4   Valor               7               10              16
            
<?php
$html = ob_get_contents();
ob_end_clean();
        $name = date('dmyhis').'.txt';
        // Abre ou cria o arquivo bloco1.txt
        // "a" representa que o arquivo é aberto para ser escrito
        $fp = fopen($name, "a");

        // Escreve "exemplo de escrita" no bloco1.txt
        $escreve = fwrite($fp, $html);

        // Fecha o arquivo
        fclose($fp);
      