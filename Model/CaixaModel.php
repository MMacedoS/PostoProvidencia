<?php

class CaixaModel
{  
   private int $idCaixa;
   private string $descricao;
   private int $statusCaixa;
   private string $dataCaixa;

    public function __construct(){     
    }

    public function getIdCaixa(){return $this->idCaixa;}
    public function getDescricao(){return $this->descricao;}
    public function getStatusCaixa(){return $this->statusCaixa;}
    public function getDataCaixa(){return $this->dataCaixa;}

    public function setIdCaixa($idCaixa){
        $this->idCaixa=$idCaixa;
    }
    public function setDescricao($descricao){
        $this->descricao=$descricao;
    }
    public function setStatusCaixa($statusCaixa){
        $this->statusCaixa=$statusCaixa;
    }
    public function setDataCaixa($dataCaixa){
        $this->dataCaixa=$dataCaixa;
    }
}


?>