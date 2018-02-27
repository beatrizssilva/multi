<?php

class model {
    
    protected $db;
    public function __construct() {
        global $db;
        $this->db = $db;
        date_default_timezone_set("America/Sao_Paulo");
    }
}

