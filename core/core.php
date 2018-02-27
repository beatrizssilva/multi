<?php

class core {
   
    public function start() {

        $url = '/';
        $params = array();
        if(isset($_GET['url'])) {
            $url .=$_GET['url'];
        }
        if(!empty($url) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url);//remove o primeiro item do array.
            
            $currentController = $url[0].'controller';//se existe url, o primeiro item da url é o controller
            array_shift($url);
            
            if(isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }
            
            if(count($url) > 0) {
		$params = $url;
            }
                        
        } else {
            $currentController = 'homecontroller';//se não existe url, então o controller padrão é homeController.
            $currentAction = 'index';//se não existe action, a action padrão é index.
        }
                
        if(!file_exists('controllers/'.$currentController.'.php') || !method_exists($currentController, $currentAction)) {
            $currentController = 'notfoundcontroller';//se não existe o controle abre o controller notfound
            $currentAction = 'index';
	}
            $c = new $currentController();//instaciando o controller escolhido
            
	if(!method_exists($c, $currentAction)) {
            $currentAction = 'index';
	}
            call_user_func_array(array($c, $currentAction), $params);//executar uma action escolhida
   
    }
}
