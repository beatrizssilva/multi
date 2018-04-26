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
    
    
    
    public function loadViewLogin($viewName, $viewData = array()) {
        extract($viewData);
        require 'views-login/'.$viewName.'.php';
    }    
    public function loadTemplateLogin($viewName, $viewData = array()){
        require 'views-login/templateLogin.php';
    }
    public function loadViewinTemplateLogin($viewName, $viewData = array()){
        extract($viewData);
        require 'views-login/'.$viewName.'.php';
    }
    
    
    
    
    
    public function loadViewPanel($viewName, $viewData = array()) {
        extract($viewData);
        require 'views-panel/'.$viewName.'.php';
    }    
    public function loadTemplatePanel($viewName, $viewData = array()){
        require 'views-panel/templatePanel.php';
    }
    public function loadViewinTemplatePanel($viewName, $viewData = array()){
        extract($viewData);
        require 'views-panel/'.$viewName.'.php';
    }
}
