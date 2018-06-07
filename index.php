<?php
//phpinfo();
//exit;
//error_reporting(E_ALL);
//ini_set("display_errors", "On");

//ini_set("max_execution_time", "3600");
//ini_set("max_input_time", "3600");
//ini_set("max_input_vars", "6000");
//ini_set("memory_limit", "512M");
//ini_set("post_max_size", "512M");
//ini_set("upload_max_filesize", "512M");
//ini_set("max_file_uploads", "50");
//
ini_set("memory_limit", "1024M");
set_time_limit(120);
session_start();

require 'config.php';

spl_autoload_register(function($class){
   
    if(file_exists('controllers/'.$class.'.php')) {
        require 'controllers/'.$class.'.php';
    } else if(file_exists('models/'.$class.'.php')) {
        require 'models/'.$class.'.php';
        
    } else if(file_exists('core/'.$class.'.php')) {
        require 'core/'.$class.'.php';
    }
        
    
});
$core = new core();
$core->start();
