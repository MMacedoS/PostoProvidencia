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
        $PersitenciaBico = new DaoBico();
        $caixa = new CaixaModel();
        $this->bicos=$PersitenciaBico->getAll();
        
        $this->verifica=$PersitenciaCaixa->verifica();
        // var_dump($this->verifica);
       
        $this->verifica==false?$id='':$id=$this->verifica[0]->getIdCaixa();

       if($id!=''){
              $this->getBicos();
             $dados=$PersitenciaBico->getMovimentoBicos(@$id);
             $q=count($_SESSION['bicos'])-count($dados);
             for($i=4;$i>$q;$i--){
                 array_shift($_SESSION['bicos']);
             }
             $this->historico="SIM";
              if($q==0){
                $this->updateCaixa($id);
              }
       }
       
   
    }

    public function getBicos()
    {
        $PersitenciaBico = new DaoBico();      
        $_SESSION['bicos']=$PersitenciaBico->getAll();               
                
    }

    public function addCaixa()
    {
       if(!$this->verifica){
        $caixa = new CaixaModel();
        $caixa->setDescricao($_POST['nomeCaixa']);
        $caixa->setStatusCaixa(intval($_POST['statusCaixa'])); 
        $PersitenciaCaixa = new DaoCaixa();
        $retorno=$PersitenciaCaixa->create($caixa); 
        $this->getBicos();
        echo json_encode($retorno);
       }else{
           
            echo json_encode("Existe um Caixa sendo executado CAIXA->".$_SESSION['caixa']);
       }
    }

    public function updateCaixa($id)
    {
      
        $caixa = new CaixaModel();
        $caixa->setStatusCaixa(0); 
        $caixa->setIdCaixa(intval($id));
        $PersitenciaCaixa = new DaoCaixa();
        $retorno=$PersitenciaCaixa->update($caixa);
        // session_destroy();      
    }

    public function addFechamento()
    {
        if(!empty($_POST['fechamento'])){ 
        $HistoricoBico = new HistoricoBicoModel();
        $HistoricoBico->setFechamento($_POST['fechamento']);
        $HistoricoBico->setIdBico(intval($_POST['idBico'])); 
        $HistoricoBico->setIdCaixa(intval($this->verifica[0]->getIdCaixa()));
        $PersitenciaHistoricoBico = new DaoHistoricoBico();
        $retorno=$PersitenciaHistoricoBico->create($HistoricoBico);
        $retorno='Inserido';
        if(count($_SESSION['bicos'])==0){                
            $this->updateCaixa($this->verifica);
            
        }else{
            $retorno=$PersitenciaHistoricoBico->update($HistoricoBico);
            array_shift($_SESSION['bicos']);
        }
        echo json_encode($retorno);
    }else
    {
        echo json_encode("O campo Fechamento não pode ser vazio");
    }
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
        if(!empty($_POST['valorDinheiro']) && !empty($_POST['valorCredito']) && !empty($_POST['valorDebito']) && !empty($_POST['valorPix'])){   
        $PersitenciaPagamento = new DaoPagamento();

        $dinheiro = new PagamentoModel();
        $dinheiro->setValorPagamento($_POST['valorDinheiro']);
        $dinheiro->setTipoPagamento($_POST['tipoDinheiro']); 
        $dinheiro->setIdCaixa(intval($_POST['idCaixaPagamento']));
        $retorno=$PersitenciaPagamento->create($dinheiro);

        $credito = new PagamentoModel();
        $credito->setValorPagamento($_POST['valorCredito']);
        $credito->setTipoPagamento($_POST['tipoCredito']); 
        $credito->setIdCaixa(intval($_POST['idCaixaPagamento']));
        $retorno=$PersitenciaPagamento->create($credito);

        $debito = new PagamentoModel();
        $debito->setValorPagamento($_POST['valorDebito']);
        $debito->setTipoPagamento($_POST['tipoDebito']); 
        $debito->setIdCaixa(intval($_POST['idCaixaPagamento']));
        $retorno=$PersitenciaPagamento->create($debito);

        $pix = new PagamentoModel();
        $pix->setValorPagamento($_POST['valorPix']);
        $pix->setTipoPagamento($_POST['tipoPix']); 
        $pix->setIdCaixa(intval($_POST['idCaixaPagamento']));
        $retorno=$PersitenciaPagamento->create($pix);
       
        echo json_encode($retorno);
        }else{
            echo json_encode("Os dados não podem ser vaziios");
        }
    }

    public function buscaPagamento($id)
    {
        $array=[];
        $PersitenciaPagamento = new DaoPagamento();
        $this->dadosBuscados=$PersitenciaPagamento->findPagamentos($id);
       
        if($this->dadosBuscados){
        foreach($this->dadosBuscados as $key=> $value)
        {
            array_push($array,$PersitenciaPagamento->jsonSerialize($value));
        }
    }
        // var_dump($array);
        echo json_encode($array);
    }
    
    public function upPagamento()
    {      
        if(!empty($_POST['valorDinheiro']) && !empty($_POST['valorCredito']) && !empty($_POST['valorDebito']) && !empty($_POST['valorPix'])){   
        $PersitenciaPagamento = new DaoPagamento();

        $dinheiro = new PagamentoModel();
        $dinheiro->setValorPagamento($_POST['valorDinheiro']);
        $dinheiro->setTipoPagamento($_POST['tipoDinheiro']); 
        $dinheiro->setIdCaixa(intval($_POST['idCaixaPagamento']));
        $retorno=$PersitenciaPagamento->update($dinheiro);

        $credito = new PagamentoModel();
        $credito->setValorPagamento($_POST['valorCredito']);
        $credito->setTipoPagamento($_POST['tipoCredito']); 
        $credito->setIdCaixa(intval($_POST['idCaixaPagamento']));
        $retorno=$PersitenciaPagamento->update($credito);

        $debito = new PagamentoModel();
        $debito->setValorPagamento($_POST['valorDebito']);
        $debito->setTipoPagamento($_POST['tipoDebito']); 
        $debito->setIdCaixa(intval($_POST['idCaixaPagamento']));
        $retorno=$PersitenciaPagamento->update($debito);

        $pix = new PagamentoModel();
        $pix->setValorPagamento($_POST['valorPix']);
        $pix->setTipoPagamento($_POST['tipoPix']); 
        $pix->setIdCaixa(intval($_POST['idCaixaPagamento']));
        $retorno=$PersitenciaPagamento->update($pix);
       
        echo json_encode($retorno);
        }else{
            echo json_encode("Os dados não podem ser vaziios");
        }
    }
    
}



?>