<?php
@session_start();
require_once "iDaoModeCrud.php";
class DaoCaixa implements iDaoModeCrud{

    private $instanciaConexaoAtiva;
    private $tabela;

    public function __construct(){
        $this->instanciaConexaoAtiva= Conexao::getInstancia();
        $this->tabela="caixa";
    }


    public function read($id) {
        $sqlStmt = "SELECT * from {$this->tabela} WHERE idCaixa=:id";
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);
           $operacao->bindValue(":id", $id, PDO::PARAM_INT);
           $operacao->execute();
           $getRow = $operacao->fetch(PDO::FETCH_OBJ);
          
           $objeto = new CaixaModel();
           $objeto->setDescricao($getRow->descricao);
           $objeto->setStatusCaixa($getRow->statusCaixa);
           $objeto->setDataCaixa($getRow->dataCaixa);
           $objeto->setIdCaixa($id);
           return $objeto;

        } catch( PDOException $excecao ){
           return $excecao->getMessage();
        }
     }
     
     public function getAll(){
        $sqlStmt = "SELECT * from {$this->tabela} order by idCaixa desc";
        $dados=[];
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);         
           $operacao->execute();
           if($operacao->execute())
           {
               while ($rs = $operacao->fetchObject(CaixaModel::class)) {
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
         $descricao = $objeto->getDescricao();
         $statusCaixa = $objeto->getStatusCaixa();
         $id = $this->getNewIdCaixa();
         $operacao="INSERT INTO {$this->tabela} SET descricao=:descricao, statusCaixa=:statusCaixa, idCaixa=:id";
         try {
             $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
             $operacao->bindValue(":descricao",$descricao, PDO::PARAM_STR);
             $operacao->bindValue(":statusCaixa", $statusCaixa, PDO::PARAM_INT);
             $operacao->bindValue(":id", $id, PDO::PARAM_INT);
             if($operacao->execute()){
                if($operacao->rowCount() > 0) {
                    $objeto->setIdCaixa($id);
                    $_SESSION['caixa']=$id;
                    return "Caixa ".$descricao." cadastrada com Sucesso";

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
        $id = $objeto->getIdCaixa();
        $statusCaixa = $objeto->getStatusCaixa();
        $operacao="UPDATE {$this->tabela} SET statusCaixa=:statusCaixa,dataCaixa=now() where  idCaixa=:id";
        try {
            $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
            $operacao->bindValue(":statusCaixa", $statusCaixa, PDO::PARAM_INT);
            $operacao->bindValue(":id", $id, PDO::PARAM_INT);
            if($operacao->execute())
            {
                if($operacao->rowCount() > 0){
                    return "Caixa ".$statusCaixa." atualizada com Sucesso";
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
        $operacao = "DELETE FROM {$this->tabela} WHERE idCaixa=:id";
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



     private function getNewIdCaixa(){
        $sqlStmt = "SELECT MAX(idCaixa) AS id FROM {$this->tabela}";
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

     public function verifica() {
      $sqlStmt = "SELECT * from {$this->tabela} where statusCaixa=1";
        $dados=[];
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);         
           $operacao->execute();
           if($operacao->execute())
           {
               while ($rs = $operacao->fetchObject(CaixaModel::class)) {
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

}
?>