<?php

class ProdutoModel
{  
    private int $idProduto;private string $nomeProduto;private float $valorProduto;private int $idCategoria;

    public function __construct(){    
    
    }

    public function getIdProduto(){return $this->idProduto;}
    public function getNomeProduto(){return $this->nomeProduto;}
    public function getValorProduto(){return $this->valorProduto;}
    public function getIdCategoria(){return $this->idCategoria;}

    public function setIdProduto($idProduto){
        $this->idProduto=$idProduto;
    }
    public function setNomeProduto($nomeProduto){
        $this->nomeProduto=$nomeProduto;
    }
    public function setValorProduto($valorProduto){
        $this->valorProduto=$valorProduto;
    }
    public function setIdCategoria($idCategoria){
        $this->idCategoria=$idCategoria;
    }
}


?>