<?php

class HomeController extends Controller{

    public function __construct()
    {
       $PersitenciaBico = new DaoBico();
        $this->bicos=$PersitenciaBico->getAll();  
                    
      
    }

    public function index(){
        $this->home('home');
      
    }

    public function mensagem(){
        echo "mensagem";
    }

}
?>