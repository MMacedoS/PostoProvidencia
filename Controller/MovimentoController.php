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

    public function findMovimento($id)
    {
        $array=[];
        $PersitenciaMovimento = new DaoMovimento();
        $this->dadosBuscados=$PersitenciaMovimento->getAllMovimentos($id);
        foreach($this->dadosBuscados as $key=> $value)
        {
            array_push($array,$PersitenciaMovimento->jsonSerialize($value));
        }
        // var_dump($array);
        echo json_encode($array);
    }

    public function addPagamento()
    {         
        $PersitenciaPagamento = new DaoPagamento();

        $dinheiro = new PagamentoModel();
        $dinheiro->setValorPagamento($_POST['valorDinheiro']);
        $dinheiro->setTipoPagamento($_POST['tipoDinheiro'])); 
        $dinheiro->setIdCaixa(intval($_POST['idCaixa']));
        $retorno=$PersitenciaPagamento->create($dinheiro);

        $credito = new PagamentoModel();
        $credito->setValorPagamento($_POST['valorCredito']);
        $credito->setTipoPagamento($_POST['tipoCredito'])); 
        $credito->setIdCaixa(intval($_POST['idCaixa']));
        $retorno=$PersitenciaPagamento->create($credito);

        $debito = new PagamentoModel();
        $debito->setValorPagamento($_POST['valorDebito']);
        $debito->setTipoPagamento($_POST['tipoDebito'])); 
        $debito->setIdCaixa(intval($_POST['idCaixa']));
        $retorno=$PersitenciaPagamento->create($debito);

        $pix = new PagamentoModel();
        $pix->setValorPagamento($_POST['valorPix']);
        $pix->setTipoPagamento($_POST['tipoPix'])); 
        $pix->setIdCaixa(intval($_POST['idCaixa']));
        $retorno=$PersitenciaPagamento->create($pix);
       
        echo json_encode($retorno);
      
    }
    

    
}



?>