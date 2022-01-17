<?php

class HomeController extends Controller{

    public function __construct()
    {
       $PersitenciaBico = new DaoBico();
        $this->bicos=$PersitenciaBico->getAll();  
                    
      
    }

    public function index(){
        // echo 10054.52-4;
        // die;
        $this->home('home');
      
    }

    public function mensagem(){
        echo "mensagem";
    }

}
?>