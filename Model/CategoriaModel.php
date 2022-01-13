<?php

class CategoriaModel
{  
   private $idCategoria = null;
   private $nomeCategoria;

    public function __construct(){     
    }

    public function getId(){return $this->idCategoria;}
    public function getNome(){return $this->nomeCategoria;}

    public function setId($idCategoria){
        $this->idCategoria=$idCategoria;
    }
    public function setNome($nomeCategoria){
        $this->nomeCategoria=$nomeCategoria;
    }
}


?>