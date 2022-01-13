<?php
require_once "iDaoModeCrud.php";
class DaoFuncionario implements iDaoModeCrud{

    private $instanciaConexaoAtiva;
    private $tabela;

    public function __construct(){
        $this->instanciaConexaoAtiva= Conexao::getInstancia();
        $this->tabela="funcionario";
    }


    public function read($id) {
        $sqlStmt = "SELECT * from {$this->tabela} WHERE idFuncionario=:id";
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);
           $operacao->bindValue(":id", $id, PDO::PARAM_INT);
           $operacao->execute();
           $getRow = $operacao->fetch(PDO::FETCH_OBJ);
           $nome = $getRow->nomeFuncionario;          
           $objeto = new FuncionarioModel();
           $objeto->setNomeFuncionario($nome);
           $objeto->setUsuario($getRow->usuario);
           $objeto->setSenha($getRow->senha);
           $objeto->setStatusFuncionario($getRow->statusFuncionario);
           $objeto->setPainel($getRow->painel);
           $objeto->setIdFuncionario($id);
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
               while ($rs = $operacao->fetchObject(FuncionarioModel::class)) {
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
         $nome = $objeto->getNomeFuncionario();
         $usuario=$objeto->getUsuario();
         $senha=$objeto->getSenha();
         $statusFuncionario=$objeto->getStatusFuncionario();
         $painel=$objeto->getPainel();
         $id = $this->getNewIdFuncionario();
         $operacao="INSERT INTO {$this->tabela} SET nomeFuncionario=:nome, usuario=:usuario,senha=:senha, statusFuncionario=:status,painel=:painel,idFuncionario=:id";
         try {
             $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
             $operacao->bindValue(":nome", $nome, PDO::PARAM_STR);
             $operacao->bindValue(":usuario", $usuario, PDO::PARAM_STR);
             $operacao->bindValue(":senha", $senha, PDO::PARAM_STR);
             $operacao->bindValue(":status", $statusFuncionario, PDO::PARAM_INT);
             $operacao->bindValue(":painel", $painel, PDO::PARAM_STR);
             $operacao->bindValue(":id", $id, PDO::PARAM_INT);
             if($operacao->execute()){
                if($operacao->rowCount() > 0) {
                    $objeto->setIdFuncionario($id);
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
        $id = $objeto->getidFuncionario();
        $nome = $objeto->getNomeFuncionario();
         $usuario=$objeto->getUsuario();
         $senha=$objeto->getSenha();
         $statusFuncionario=$objeto->getStatusFuncionario();
         $painel=$objeto->getPainel();
         if($senha!=''){
            $operacao="UPDATE {$this->tabela} SET nomeFuncionario=:nome, usuario=:usuario,senha=:senha, statusFuncionario=:status,painel=:painel where  idFuncionario=:id";
         }else{
            $operacao="UPDATE {$this->tabela} SET nomeFuncionario=:nome, usuario=:usuario,statusFuncionario=:status,painel=:painel where  idFuncionario=:id";
         }
        
        try {
            $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
            $operacao->bindValue(":nome", $nome, PDO::PARAM_STR);
            $operacao->bindValue(":usuario", $usuario, PDO::PARAM_STR);
            $senha!=''?$operacao->bindValue(":senha", md5($senha), PDO::PARAM_STR):'';
            $operacao->bindValue(":status", $statusFuncionario, PDO::PARAM_INT);
            $operacao->bindValue(":painel", $painel, PDO::PARAM_STR);
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
        $operacao = "DELETE FROM {$this->tabela} WHERE idFuncionario=:id";
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



     private function getNewIdFuncionario(){
        $sqlStmt = "SELECT MAX(idFuncionario) AS id FROM {$this->tabela}";
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