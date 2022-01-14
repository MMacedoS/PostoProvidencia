<?php
@session_start();
class DaoHistoricoBico implements iDaoModeCrud
{
    private $instanciaConexaoAtiva;
    private $tabela;

    public function __construct(){
        $this->instanciaConexaoAtiva= Conexao::getInstancia();
        $this->tabela="historicobico";
    }

    public function read($id) {
        $sqlStmt = "SELECT * from {$this->tabela} WHERE idHistoricoBico=:id";
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);
           $operacao->bindValue(":id", $id, PDO::PARAM_INT);
           $operacao->execute();
           $getRow = $operacao->fetch(PDO::FETCH_OBJ);
           $objeto = new HistoricoBicoModel();
           $objeto->setFechamento($objeto->fechamento);
           $objeto->setData($getRow->data);
           $objeto->setIdBico($getRow->idBico);
           $objeto->setIdCaixa($getRow->idCaixa);
           $objeto->setIdHistoricoBico($id);
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
               while ($rs = $operacao->fetchObject(HistoricoBicoModel::class)) {
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
         $fechamento = $objeto->getFechamento();
         $idBico=$objeto->getIdBico(); 
         $idCaixa=$objeto->getIdCaixa();
         $id = $this->getNewIdHistoricoBico();
         $operacao="INSERT INTO {$this->tabela} SET fechamento=:fechamento,idCaixa=:caixa, idBico=:bico,idHistoricoBico=:id";
         try {
             $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
             $operacao->bindValue(":fechamento", $fechamento, PDO::PARAM_STR);
             $operacao->bindValue(":bico", $idBico, PDO::PARAM_INT);
             $operacao->bindValue(":caixa", $idCaixa, PDO::PARAM_INT);
             $operacao->bindValue(":id", $id, PDO::PARAM_INT);
             if($operacao->execute()){
                if($operacao->rowCount() > 0) {
                    $objeto->setIdHistoricoBico($id);                                 
                    return "Inserido";
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
        $fechado=$objeto->getFechamento();
            $operacao="UPDATE bico SET Fechado=:fechado where  idBico=:id";
         
        
        try {
            $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
           
            $operacao->bindValue(":fechado", $fechado, PDO::PARAM_STR);
            $operacao->bindValue(":id", $id, PDO::PARAM_INT);
            if($operacao->execute())
            {
                if($operacao->rowCount() > 0){
                    return "Bico Atualizado";
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
        $operacao = "DELETE FROM {$this->tabela} WHERE idHistoricoBico=:id";
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

    public function buscaMovimento($id){
        
    }

     private function getNewIdHistoricoBico(){
        $sqlStmt = "SELECT MAX(idHistoricoBico) AS id FROM {$this->tabela}";
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