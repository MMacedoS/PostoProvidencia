<?php
require_once "iDaoModeCrud.php";
class DaoBico implements iDaoModeCrud{

    private $instanciaConexaoAtiva;
    private $tabela;

    public function __construct(){
        $this->instanciaConexaoAtiva= Conexao::getInstancia();
        $this->tabela="bico";
    }


    public function read($id) {
        $sqlStmt = "SELECT * from {$this->tabela} WHERE idBico=:id";
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);
           $operacao->bindValue(":id", $id, PDO::PARAM_INT);
           $operacao->execute();
           $getRow = $operacao->fetch(PDO::FETCH_OBJ);
           $nome = $getRow->nomeBico;          
           $objeto = new BicoModel();
           $objeto->setNomeBico($nome);
           $objeto->setIdProduto($getRow->idProduto);
           $objeto->setFechado($getRow->Fechado);
           $objeto->setCor($getRow->cor);
           $objeto->setIdBico($id);
           return $objeto;

        } catch( PDOException $excecao ){
           return $excecao->getMessage();
        }
     }
     
     public function getAll(){
        $sqlStmt = "SELECT * from {$this->tabela} ";
        $dados=[];
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);         
           $operacao->execute();
           if($operacao->execute())
           {
               while ($rs = $operacao->fetchObject(BicoModel::class)) {
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
         $nome = $objeto->getNomeBico();
         $idProduto=$objeto->getIdProduto();
         $fechado=$objeto->getFechado();
         $cor=$objeto->getCor();
         $id = $this->getNewIdBico();
         $operacao="INSERT INTO {$this->tabela} SET nomeBico=:nome,idProduto=:idproduto,fechado=:fechado,cor=:cor, idBico=:id";
         try {
             $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
             $operacao->bindValue(":nome",$nome, PDO::PARAM_STR);
             $operacao->bindValue(":idproduto",$idProduto, PDO::PARAM_INT);
             $operacao->bindValue(":fechado",$fechado, PDO::PARAM_STR);
             $operacao->bindValue(":cor",$cor, PDO::PARAM_STR);
             $operacao->bindValue(":id", $id, PDO::PARAM_INT);
             if($operacao->execute()){
                if($operacao->rowCount() > 0) {
                    $objeto->setIdProduto($id);
                    return "Bico ".$nome." cadastrada com Sucesso";
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
        $id = $objeto->getIdBico();
        $nome = $objeto->getNomeBico();
         $idProduto=$objeto->getIdProduto();
         $fechado=$objeto->getFechado();
         $cor=$objeto->getCor();
        $operacao="UPDATE {$this->tabela} SET nomeBico=:nome,idProduto=:idproduto,fechado=:fechado,cor=:cor where  idBico=:id";
        try {
            $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
             $operacao->bindValue(":nome",$nome, PDO::PARAM_STR);
             $operacao->bindValue(":idproduto",$idProduto, PDO::PARAM_INT);
             $operacao->bindValue(":fechado",$fechado, PDO::PARAM_STR);
             $operacao->bindValue(":cor",$cor, PDO::PARAM_STR);
             $operacao->bindValue(":id", $id, PDO::PARAM_INT);
            if($operacao->execute())
            {
                if($operacao->rowCount() > 0){
                    return "Bico ".$nome." atualizada com Sucesso";
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
        $operacao = "DELETE FROM {$this->tabela} WHERE idBico=:id";
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



     private function getNewIdBico(){
        $sqlStmt = "SELECT MAX(idBico) AS id FROM {$this->tabela}";
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