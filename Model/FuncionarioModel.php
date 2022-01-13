<?php

class FuncionarioModel
{  
    private int $idFuncionario;
    private string $usuario;
    private string $senha;
    private int $statusFuncionario;
    private string $nomeFuncionario;
    private string $painel;

    public function __construct(){    
    
    }

    public function getIdFuncionario(){return $this->idFuncionario;}
    public function getUsuario(){return $this->usuario;}
    public function getSenha(){return $this->senha;}
    public function getStatusFuncionario(){return $this->statusFuncionario;}
    public function getNomeFuncionario(){return $this->nomeFuncionario;}
    public function getPainel(){return $this->painel;}

    public function setIdFuncionario($idFuncionario){
        $this->idFuncionario=$idFuncionario;
    }
    public function setUsuario($usuario){
        $this->usuario=$usuario;
    }
    public function setSenha($senha){
        $this->senha=$senha;
    }
    public function setStatusFuncionario($statusFuncionario){
        $this->statusFuncionario=$statusFuncionario;
    }
    public function setNomeFuncionario($nomeFuncionario){
        $this->nomeFuncionario=$nomeFuncionario;
    }
    public function setPainel($painel){
        $this->painel=$painel;
    }
}


?>