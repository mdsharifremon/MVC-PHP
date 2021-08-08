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
        
        $users = $this->userModel->getUser();

        $data = [
            'title' => 'Home Page',
            'users' => $users,
        ];
        $this->view('pages/index', $data);
    }

    public function about(){
        $this->view('pages/about');
    }

    public function contact(){
        $this->view('pages/contact');
    }


}



?>