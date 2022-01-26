<?php

class HomeController extends Controller{

    public function __construct()
    {
       $PersitenciaBico = new DaoBico();
        $this->bicos=$PersitenciaBico->getAll();  
        // $this->graficosPagamentos();        
      
    }

    public function index(){
        // echo 10054.52-4;
        // die;
        $this->home('home');
      
    }

    public function mensagem(){
        echo "mensagem";
    }

    public function graficosPagamentos()
    {
        $array=[];
        for($i=1;$i<=12;$i++){
        $PersitenciaPagamento = new DaoPagamento();
        $this->dadosBuscados=$PersitenciaPagamento->graficosPagamentos($i);       
           array_push($array,$this->dadosBuscados[0]);
         }
        // var_dump($array);
        
        echo json_encode($array);
    }
    
}
?>