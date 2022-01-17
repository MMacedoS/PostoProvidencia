
<?php

class DaoMovimento implements iDaoModeCrud
{

    private $instanciaConexaoAtiva;
    private $tabela;

    public function __construct(){
        $this->instanciaConexaoAtiva= Conexao::getInstancia();
        $this->tabela="movimento";
    }
    public function create($object)
    {

    }
    public function read($param){}
    public function update($object){}
    public function delete($param){}
    public function getAll(){}
    public function getAllMovimentos($id){
        $sqlStmt = "SELECT m.*,b.nomeBico,p.nomeProduto,p.valorProduto FROM {$this->tabela} m INNER JOIN bico b on m.idBico=b.idBico INNER JOIN produto p on p.idProduto=b.idProduto where m.idCaixa='$id'";
        $dados=[];
        try {
           $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);         
           $operacao->execute();
           if($operacao->execute())
           {
               while ($rs = $operacao->fetchObject(MovimentoModel::class)) {
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


    public function jsonSerialize($object)
    {
            return [
                'idMovimento' =>$object->getIdMovimento(),
                'idCaixa' =>$object->getIdCaixa(),
                'idBico' =>$object->getIdBico(),
                'dataMovimento' =>$this->invertedata($object->getDataMovimento()),
                'qtdoFechado' =>$object->getQtdoFechado(),
                'qtdoAberto' =>$object->getQtdoAberto(),
                'nomeBico' =>$object->getNomeBico(),
                'nomeProduto' =>$object->getNomeProduto(),
                'valorProduto' =>$object->getValorProduto(),
                'totalBico' =>$this->somarQtdo($object->getQtdoFechado(),$object->getQtdoAberto())
            ];
    }
    private function invertedata($data)
    {
        $data=explode(" ",$data);
        return implode("/", array_reverse(explode("-",$data[0])))." ".$data[1];
    }
    private function somarQtdo($fechado,$aberto)
    {
        $fechado=str_replace(".","",$fechado);
        $fechado=str_replace(",",".",$fechado);
        $aberto=str_replace(".","",$aberto);
        $aberto=str_replace(",",".",$aberto);  
        return floatval($fechado)- floatval($aberto);
    }
    
}
?>