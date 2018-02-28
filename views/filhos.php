<?php

echo '<ol>';
        foreach ($filho as $usuario){
            echo '<li>';
            echo $usuario['name'].' ('.count($usuario['filhos']).')';
            if(count($usuario['filhos']) > 0) {
                $this->loadView('filhos',array('filho' => $usuario['filhos']));
            }
            echo '</li>';
        }
echo '</ol>';
?>






