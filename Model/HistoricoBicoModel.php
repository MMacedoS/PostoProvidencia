<?php
class HistoricoBicoModel {

    private int $idHistoricoBico;
    private string $fechamento;
    private string $data;
    private int $idBico;
    private int $idCaixa;

    public function __construct(){}

    public function getIdHistoricoBico(){return $this->idHistoricoBico;}
    public function getFechamento(){return $this->fechamento;}
    public function getData(){return $this->data;}
    public function getIdBico(){return $this->idBico;}
    public function getIdCaixa(){return $this->idCaixa;}

    public function setIdHistoricoBico($idHistoricoBico)
    {
        $this->idHistoricoBico=$idHistoricoBico;
    }
    public function setFechamento($fechamento)
    {
        $this->fechamento=$fechamento;
    }
    public function setData($data)
    {
        $this->data=$data;
    }
    public function setIdBico($idBico)
    {
        $this->idBico=$idBico;
    }
    public function setIdCaixa($idCaixa)
    {
        $this->idCaixa=$idCaixa;
    }
}

?>