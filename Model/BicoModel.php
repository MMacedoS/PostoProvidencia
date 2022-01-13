<?php

class BicoModel
{  
    private int $idBico;private string $nomeBico;private int $idProduto;private string $Fechado;private string $cor;

    public function __construct(){    
    
    }
    public function getIdBico(){return $this->idBico;}
    public function getIdProduto(){return $this->idProduto;}
    public function getNomeBico(){return $this->nomeBico;}
    public function getFechado(){return $this->Fechado;}
    public function getCor(){return $this->cor;}

    public function setIdBico($idBico){
        $this->idBico=$idBico;
    }
    public function setIdProduto($idProduto){
        $this->idProduto=$idProduto;
    }
    public function setNomeBico($nomeBico){
        $this->nomeBico=$nomeBico;
    }
    public function setFechado($Fechado){
        $this->Fechado=$Fechado;
    }
    public function setCor($cor){
        $this->cor=$cor;
    }
}


?>