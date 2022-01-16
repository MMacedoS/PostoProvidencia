<?php
class DaoPagamento implements iDaoModeCrud
{
    private $tabela;
    private $instanciaConexaoAtiva;

    public function __construct()
    {
        $this->instanciaConexaoAtiva=Conexao::getInstancia();
        $this->tabela="pagamento";
    }
    public function read($id)
    {
        $sqlStmt="SELECT * FROM {$this->tabela} where idPagamento=:id";
        try {
            $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);
            $operacao->bindValue(':id',$id, PDO::PARAM_INT);
            $operacao->bindValue(':idcaixa',$id, PDO::PARAM_INT);
            $operacao->execute();
            $getRow=$operacao->fetch(PDO::FETCH_OBJ);
            $objeto= new PagamentoModel();
            $objeto->setIdPagamento($getRow->idPagamento);
            $objeto->setIdCaixa($getRow->idCaixa);
            $objeto->setValorPagamento($getRow->valorPagamento);
            $objeto->setDataPagamento($getRow->dataPagamento);
            $objeto->setTipoPagamento($getRow->tipoPagamento);

            return $objeto;
        } catch (PDOException $excecao) {

            return $excecao->getMessage();
        }
    }

    public function create($objeto){
        $idCaixa=$objeto->getIdCaixa();
        $tipoPagamento=$objeto->getTipoPagamento();
        $valorPagamento=$objeto->getValorPagamento();
        $id = $this->getNewIdPagamento();
        $operacao="INSERT INTO {$this->tabela} set idCaixa=:idcaixa, tipoPagamento=:tipo,valorPagamento=:valor,idPagamento=:id";
        try {
            $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
            $operacao->bindValue(':idcaixa',$idCaixa, PDO::PARAM_INT);
            $operacao->bindValue(':valor',$valorPagamento,PDO::PARAM_STR);
            $operacao->bindValue(':tipo',$tipoPagamento,PDO::PARAM_STR);
            $operacao->bindValue(':id',$id,PDO::PARAM_STR);
            
            if($operacao->execute()){
                if($operacao->rowCount()>0){
                    $objeto->setIdPagamento($id);
                    return "Pagemento do caixa ".$idCaixa." cadastrado com Sucesso";
                }else
                {
                    return false;
                }
            }else{
                return false;
            }

        } catch (PDOException $excecao) {
            return $excecao->getMessage();
        }
    }

    public function update($objeto){
        $idCaixa=$objeto->getIdCaixa();
        $tipoPagamento=$objeto->getTipoPagamento();
        $valorPagamento=$objeto->getValorPagamento();
        $operacao="UPDATE {$this->tabela} set tipoPagamento=:tipo,valorPagamento=:valor WHERE idCaixa=:idcaixa and tipoPagamento=:tipo";
        try {
            $operacao=$this->instanciaConexaoAtiva->prepare($operacao);
            $operacao->bindValue(':idcaixa',$idCaixa, PDO::PARAM_INT);
            $operacao->bindValue(':valor',$valorPagamento,PDO::PARAM_STR);
            $operacao->bindValue(':tipo',$tipoPagamento,PDO::PARAM_STR);            
            if($operacao->execute()){
                if($operacao->rowCount()>0){                   
                    return "Pagemento do caixa ".$idCaixa." Atualizado com Sucesso";
                }else
                {
                    return false;
                }
            }else{
                return false;
            }

        } catch (PDOException $excecao) {
            return $excecao->getMessage();
        }
    }

    public function delete($id){}

    public function getAll(){
        $sqlStmt="SELECT * FROM {$this->tabela}";
        $dados=[];

        try {
            $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);
            
            if($operacao->execute())
            {
                while($rs = $operacao->fetchObject(PagamentoModel::class)){
                    $dados[]=$rs;
                }
            }
            if(count($dados)>0){
                return $dados;
            }
            return false;
        } catch (PDOException $excecao) {
            return $excecao->getMessage();
            //throw $th;
        }
    }

    public function findPagamentos($id)
    {
        $sqlStmt = "SELECT * FROM {$this->tabela} where idCaixa='$id'";
        $dados=[];
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);         
           $operacao->execute();
           if($operacao->execute())
           {
               while ($rs = $operacao->fetchObject(PagamentoModel::class)) {
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

    private function getNewIdPagamento(){
        $sqlStmt = "SELECT MAX(idPagamento) AS id FROM {$this->tabela}";
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

     public function jsonSerialize($object)
     {
             return [
                 'idPagamento' =>$object->getIdPagamento(),
                 'idCaixa' =>$object->getIdCaixa(),
                 'valorPagamento' =>$object->getValorPagamento(),
                 'dataPagamento' =>$this->invertedata($object->getDataPagamento()),
                 'tipoPagamento' =>$object->getTipoPagamento(),
                
             ];
     }
     
     private function invertedata($data)
     {
         $data=explode(" ",$data);
         return implode("/", array_reverse(explode("-",$data[0])))." ".$data[1];
     }
}
?>