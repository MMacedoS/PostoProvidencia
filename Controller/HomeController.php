<?php

class HomeController extends Controller{

    public function index(){
        $this->home('home');
      
    }

    public function mensagem(){
        echo "mensagem";
    }

}
?>