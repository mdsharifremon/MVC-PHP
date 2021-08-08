<?php

/**
 * Page Class Controller
 * 
 */

class Pages extends Controller{
    function __construct(){
        
        $this->userModel = $this->model('User');
    }

    public function index(){ 
        $this->view('pages/index');
    }

    public function about(){
        $this->view('pages/about');
    }

    public function contact(){
        $this->view('pages/contact');
    }


}



?>