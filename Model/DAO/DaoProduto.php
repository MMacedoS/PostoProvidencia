<?php
require_once "iDaoModeCrud.php";
class DaoProduto implements iDaoModeCrud{

    private $instanciaConexaoAtiva;
    private $tabela;

    public function __construct(){
        $this->instanciaConexaoAtiva= Conexao::getInstancia();
        $this->tabela="produto";
    }


    public function read($id) {
        $sqlStmt = "SELECT * from {$this->tabela} WHERE idProduto=:id";
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);
           $operacao->bindValue(":id", $id, PDO::PARAM_INT);
           $operacao->execute();
           $getRow = $operacao->fetch(PDO::FETCH_OBJ);
           $nome = $getRow->nomeProduto;          
           $objeto = new ProdutoModel();
           $objeto->setNomeProduto($nome);
           $objeto->setValorProduto($getRow->valorProduto);
           $objeto->setIdCategoria($getRow->idCategoria);
           $objeto->setIdProduto($id);
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
               while ($rs = $operacao->fetchObject(ProdutoModel::class)) {
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
         $nome = $objeto->getNomeProduto();
         $valor=$objeto->getValorProduto();
         $idcategoria=$objeto->getIdCategoria();
         $id = $this->getNewIdProduto();
         $operacao="INSERT INTO {$this->tabela} SET nomeProduto=:Produto, valorProduto=:valor,idCategoria=:idcategoria, idProduto=:id";
         try {
             $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
             $operacao->bindValue(":Produto",$nome, PDO::PARAM_STR);
             $operacao->bindValue(":valor",$valor, PDO::PARAM_STR);
             $operacao->bindValue(":idcategoria",$idcategoria, PDO::PARAM_STR);
             $operacao->bindValue(":id", $id, PDO::PARAM_INT);
             if($operacao->execute()){
                if($operacao->rowCount() > 0) {
                    $objeto->setIdProduto($id);
                    return "Produto ".$nome." cadastrada com Sucesso";
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
        $id = $objeto->getIdProduto();
        $nome = $objeto->getNomeProduto();
         $valor=$objeto->getValorProduto();
         $idcategoria=$objeto->getIdCategoria();
        $operacao="UPDATE {$this->tabela} SET nomeProduto=:Produto, valorProduto=:valor,idCategoria=:idcategoria where  idProduto=:id";
        try {
            $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
            $operacao->bindValue(":Produto",$nome, PDO::PARAM_STR);
             $operacao->bindValue(":valor",$valor, PDO::PARAM_STR);
             $operacao->bindValue(":idcategoria",$idcategoria, PDO::PARAM_STR);
            $operacao->bindValue(":id", $id, PDO::PARAM_INT);
            if($operacao->execute())
            {
                if($operacao->rowCount() > 0){
                    return "Produto ".$nome." atualizada com Sucesso";
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
        $operacao = "DELETE FROM {$this->tabela} WHERE idProduto=:id";
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



     private function getNewIdProduto(){
        $sqlStmt = "SELECT MAX(idProduto) AS id FROM {$this->tabela}";
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