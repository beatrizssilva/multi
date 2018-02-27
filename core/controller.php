<?php

class controller {
    public function loadView($viewName, $viewData = array()) {
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }       
    public function loadTemplate($viewName, $viewData = array()){
        require 'views/template.php';
    }    
    public function loadViewinTemplate($viewName, $viewData = array()){
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }
    public function loadViewDescricao($viewName, $viewData = array()) {
        extract($viewData);
        require 'views-descricao/'.$viewName.'.php';
    }    
    public function loadViewinTemplateDescricao($viewName, $viewData = array()){
        extract($viewData);
        require 'views-descricao/'.$viewName.'.php';
    }
}
