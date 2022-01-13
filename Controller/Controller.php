<?php
@session_start();
require_once "./Functions/autoload.php";
class Controller
{
    public $categorias;    
    public $produtos;
    public $dadosBuscados;
    public $funcionarios;
    public $bicos;
    public $caixas;
    public $verifica;
    public function cadastro($arquivo)
    {
        require_once "View/pages/cadastro/".$arquivo.".php";
       
    }
    public function home($arquivo)
    {
        require_once "View/pages/home/".$arquivo.".php";
       
    }
    public function movimento($arquivo)
    {
        require_once "View/pages/movimento/".$arquivo.".php";
       
    }
    
}


?>