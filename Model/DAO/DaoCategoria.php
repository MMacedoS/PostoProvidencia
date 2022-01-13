<?php
require_once "iDaoModeCrud.php";
class DaoCategoria implements iDaoModeCrud{

    private $instanciaConexaoAtiva;
    private $tabela;

    public function __construct(){
        $this->instanciaConexaoAtiva= Conexao::getInstancia();
        $this->tabela="categoria";
    }


    public function read($id) {
        $sqlStmt = "SELECT * from {$this->tabela} WHERE idCategoria=:id";
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);
           $operacao->bindValue(":id", $id, PDO::PARAM_INT);
           $operacao->execute();
           $getRow = $operacao->fetch(PDO::FETCH_OBJ);
           $nome = $getRow->nomeCategoria;          
           $objeto = new CategoriaModel();
           $objeto->setNome($nome);
           $objeto->setId($id);
           return $objeto;

        } catch( PDOException $excecao ){
           return $excecao->getMessage();
        }
     }
     
     public function getAll(){
        $sqlStmt = "SELECT * from {$this->tabela}";
        $dados=[];
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);         
           $operacao->execute();
           if($operacao->execute())
           {
               while ($rs = $operacao->fetchObject(CategoriaModel::class)) {
                $dados[] = $rs;
            }
           }
           if(count($dados)>0){
            return $dados;
           }
           return false;
           
        } catch( PDOException $excecao ){
           return $excecao->getMessage();
        }
     }
     public function create($objeto){
         $nome = $objeto->getNome();
         $id = $this->getNewIdCategoria();
         $operacao="INSERT INTO {$this->tabela} SET nomeCategoria=:categoria, idCategoria=:id";
         try {
             $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
             $operacao->bindValue(":categoria",$nome, PDO::PARAM_STR);
             $operacao->bindValue(":id", $id, PDO::PARAM_INT);
             if($operacao->execute()){
                if($operacao->rowCount() > 0) {
                    $objeto->setID($id);
                    return "Categoria ".$nome." cadastrada com Sucesso";
                 } else {
                    return false;
                 }
                
             }
             else {
                return false;
          }

         } catch (\Throwable $th) {
            return $th->getMessage();
         }
     }
     public function update($objeto){
        $id = $objeto->getId();
        $nome = $objeto->getNome();
        $operacao="UPDATE {$this->tabela} SET nomeCategoria=:categoria where  idCategoria=:id";
        try {
            $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
            $operacao->bindValue(":categoria",$nome, PDO::PARAM_STR);
            $operacao->bindValue(":id", $id, PDO::PARAM_INT);
            if($operacao->execute())
            {
                if($operacao->rowCount() > 0){
                    return "Categoria ".$nome." atualizada com Sucesso";
                 } else {
                    return false;
                 }
              } else {
                 return false;
              }
        } catch (PDOException $th) {
            return $th->getMessage();
        }
     }
     public function delete($param){
        $operacao = "DELETE FROM {$this->tabela} WHERE idCategoria=:id";
        try {
            $operacao = $this->instanciaConexaoAtiva->prepare($operacao);
            $operacao->bindValue(":id", $param, PDO::PARAM_INT);
            if($operacao->execute()){
                if($operacao->rowCount()>0) {
                      return true;
                } else {
                      return false;
                }
             } else {
                return false;
             }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }

     }



     private function getNewIdCategoria(){
        $sqlStmt = "SELECT MAX(idCategoria) AS id FROM {$this->tabela}";
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);
           if($operacao->execute()) {
              if($operacao->rowCount() > 0){
                 $getRow = $operacao->fetch(PDO::FETCH_OBJ);
                 $idReturn = (int) $getRow->id + 1;
                 return $idReturn;
              } else {
                 throw new Exception("Ocorreu um problema com o banco de dados");
                 exit();
              }
           } else {
              throw new Exception("Ocorreu um problema com o banco de dados");
              exit();
            }
        } catch (PDOException $excecao) {
           return $excecao->getMessage();
        }
     }

}
?>