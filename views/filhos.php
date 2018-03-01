<?php

echo '<ol>';
        foreach ($filho as $usuario){
            echo '<li>';
            echo $usuario['name'].' ('.utf8_encode($usuario['patente']).')  tem '.count($usuario['filhos']).' cadastros diretos';
            if(count($usuario['filhos']) > 0) {
                $this->loadView('filhos',array('filho' => $usuario['filhos']));
            }
            echo '</li>';
        }
echo '</ol>';
?>






