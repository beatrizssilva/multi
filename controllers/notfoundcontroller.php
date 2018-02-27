<?php

class notfoundcontroller extends controller {
    public function index() {
        $this->loadView('404', array());
    }
}
