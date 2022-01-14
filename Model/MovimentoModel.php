<?php

class  MovimentoModel 
{
    private int $idMovimento;
    private int $idCaixa;
    private int $idBico;
    private string $dataMovimento;
    private string $qtdoFechado;
    private string $qtdoAberto;
    private string $nomeBico;
    private string $nomeProduto;
    private float $valorProduto;


    public function getIdMovimento(){return $this->idMovimento;}
    public function getIdCaixa(){return $this->idCaixa;}
    public function getIdBico(){return $this->idBico;}
    public function getDataMovimento(){return $this->dataMovimento;}
    public function getQtdoFechado(){return $this->qtdoFechado;}
    public function getQtdoAberto(){return $this->qtdoAberto;}
    public function getNomeProduto(){return $this->nomeProduto;}
    public function getValorProduto(){return $this->valorProduto;}
    public function getNomeBico(){return $this->nomeBico;}
    
    public function setIdMovimento($idMovimento)
    {
        $this->idMovimento=$idMovimento;
    }
    public function setIdCaixa($idCaixa)
    {
        $this->idCaixa=$idCaixa;
    }
    public function setIdBico($idBico)
    {
        $this->idBico=$idBico;
    }
    public function setDataMovimento($dataMovimento)
    {
        $this->dataMovimento=$dataMovimento;
    }
    public function setQtdoFechado($qtdoFechado)
    {
        $this->qtdoFechado=$qtdoFechado;
    }
    public function setQtdoAberto($qtdoAberto)
    {
        $this->qtdoAberto=$qtdoAberto;
    }
    public function setNomeProduto($nomeProduto){
        $this->nomeProduto=$nomeProduto;
    }
    public function setValorProduto($valorProduto){
        $this->valorProduto=$valorProduto;
    } 
    public function setNomeBico($nomeBico){
        $this->nomeBico=$nomeBico;
    }
}


?>