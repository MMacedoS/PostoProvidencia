<?php

class  PagamentoModel 
{
    private int $idPagamento;
    private int $idCaixa;
    private string $dataPagamento;
    private float $valorPagamento;
    private string $tipoPagamento;


    public function getIdPagamento(){return $this->idPagamento;}
    public function getIdCaixa(){return $this->idCaixa;}  
    public function getValorPagamento(){return $this->valorPagamento;}
    public function getDataPagamento(){return $this->dataPagamento;}
    public function getTipoPagamento(){return $this->tipoPagamento;}
    
    public function setIdPagamento($idPagamento)
    {
        $this->idPagamento=$idPagamento;
    }
    public function setIdCaixa($idCaixa)
    {
        $this->idCaixa=$idCaixa;
    }
    public function setValorPagamento($valorPagamento)
    {
        $this->valorPagamento=$valorPagamento;
    }
    public function setDataPagamento($dataPagamento)
    {
        $this->dataPagamento=$dataPagamento;
    }
    public function setTipoPagamento($tipoPagamento)
    {
        $this->tipoPagamento=$tipoPagamento;
    }
    
}


?>