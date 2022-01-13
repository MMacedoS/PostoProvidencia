<?php

@session_start();
class  MovimentoController extends Controller
{
    public function __construct()
    {
        $this->verifica();
    }
    public function index()
    {
        $this->movimento('index');
    }
    public function caixa()
    {        
        $PersitenciaCaixa = new DaoCaixa();
        $this->caixas=$PersitenciaCaixa->getAll();   
        $this->movimento('caixa');
    }
    public function verifica()
    {
        $PersitenciaCaixa = new DaoCaixa();
        $this->verifica=$PersitenciaCaixa->verifica();
    }

    public function getBicos()
    {
        $PersitenciaBico = new DaoBico();
        return $this->bicos=$PersitenciaBico->getAll();   
                
    }

    public function addCaixa()
    {
       if(!$this->verifica){
        $caixa = new CaixaModel();
        $caixa->setDescricao($_POST['nomeCaixa']);
        $caixa->setStatusCaixa(intval($_POST['statusCaixa'])); 
        $PersitenciaCaixa = new DaoCaixa();
        $retorno=$PersitenciaCaixa->create($caixa); 
        $_SESSION['bicos']=$this->getBicos();
        echo json_encode($retorno);
       }else{
          
           echo json_encode("Existe um Caixa sendo executado CAIXA->".$_SESSION['caixa']);
       }
    }

    public function updateCaixa()
    {
      
        $caixa = new CaixaModel();
        $caixa->setStatusCaixa(0); 
        $caixa->setIdCaixa(intval($_SESSION['caixa']));
        $PersitenciaCaixa = new DaoCaixa();
        $retorno=$PersitenciaCaixa->update($caixa);
        // session_destroy();      
    }

    public function addFechamento()
    {
       
        $HistoricoBico = new HistoricoBicoModel();
        $HistoricoBico->setFechamento($_POST['fechamento']);
        $HistoricoBico->setIdBico(intval($_POST['idBico'])); 
        $HistoricoBico->setIdCaixa(intval($_SESSION['caixa']));
        $PersitenciaHistoricoBico = new DaoHistoricoBico();
        $retorno=$PersitenciaHistoricoBico->create($HistoricoBico);
        $retorno='Inserido';
        if(count($_SESSION['bicos'])==0){                
            updateCaixa($this->verifica);
            
        }else{
            $retorno=$PersitenciaHistoricoBico->update($HistoricoBico);
            array_shift($_SESSION['bicos']);
        }
        echo json_encode($retorno);
      
    }

    
}



?>