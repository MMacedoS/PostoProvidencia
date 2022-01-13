<?php
header("Content-Type: text/html; charset=utf-8",true);
class CadastroController extends Controller{
   
   public function index(){
    $PersitenciaBico = new DaoBico();
    $this->bicos=$PersitenciaBico->getAll();  
    $PersitenciaCategoria = new DaoCategoria();
    $this->categorias=$PersitenciaCategoria->getAll();   
    $PersitenciaProduto = new DaoProduto();
    $this->produtos=$PersitenciaProduto->getAll(); 
    $PersitenciaFuncionario = new DaoFuncionario();
    $this->funcionarios=$PersitenciaFuncionario->getAll();     
    
    $this->cadastro('index');
   }
   
    
    public function Bico()
    {
        $PersitenciaBico = new DaoBico();
        $this->bicos=$PersitenciaBico->getAll();   
        // var_dump($this->bicos);
        // die;
        $this->cadastro('bico');
        
    }
    public function Idproduto($id){
        
        $PersitenciaBico = new DaoProduto();
        $retorno=$PersitenciaBico->read($id);       
        
        return $retorno->getNomeProduto();

    }
    public function addBico()
    {
       
        $bico = new BicoModel();
        $bico->setNomeBico($_POST['nomeBico']);
        $bico->setIdProduto(intval($_POST['idProduto']));
        $bico->setFechado($_POST['Fechado']);
        $bico->setCor($_POST['cor']);
        $PersitenciaBico = new DaoBico();
        $retorno=$PersitenciaBico->create($bico); 
        echo json_encode($retorno);
    }

    public function updateBico()
    {
        $bico = new BicoModel();
        $bico->setNomeBico($_POST['nomeBico']);
        $bico->setIdProduto(intval($_POST['idProduto']));
        $bico->setFechado($_POST['Fechado']);
        $bico->setCor($_POST['cor']);        
        $bico->setIdBico(intval($_POST['idBico']));
        $PersitenciaBico = new DaoBico();
        $retorno=$PersitenciaBico->update($bico); 
        echo json_encode($retorno);
    }

    public function findBico($id){
        
        $PersitenciaBico = new DaoBico();
        $this->dadosBuscados=$PersitenciaBico->read($id);     
        
        echo json_encode($this->dadosBuscados);

    }
    public function deletarBico($id){
        $PersitenciaBico = new DaoBico();
        $retorno=$PersitenciaBico->delete($id);       
        
        echo json_encode($retorno);
    }


    //categoria

    public function Categoria()
    {
        $PersitenciaCategoria = new DaoCategoria();
        $this->categorias=$PersitenciaCategoria->getAll();   
        $this->cadastro('categoria');
        
    }

    public function addCategoria()
    {
        $categoria = new CategoriaModel();
        $categoria->setNome($_POST['categoria']);
        $PersitenciaCategoria = new DaoCategoria();
        $retorno=$PersitenciaCategoria->create($categoria); 
        echo json_encode($retorno);
    }
    public function findCategoria($id){
        
        $PersitenciaCategoria = new DaoCategoria();
        $retorno=$PersitenciaCategoria->read($id);       
        
        echo json_encode($retorno->getNome());

    }

    public function updateCategoria()
    {
        $categoria = new CategoriaModel();
        $categoria->setNome($_POST['categoria']);
        $categoria->setId($_POST['id']);
        $PersitenciaCategoria = new DaoCategoria();
        $retorno=$PersitenciaCategoria->update($categoria); 
        echo json_encode($retorno);
    }

    public function deletarCategoria($id){
        $PersitenciaCategoria = new DaoCategoria();
        $retorno=$PersitenciaCategoria->delete($id);       
        
        echo json_encode($retorno);
    }

    public function CategoriaAll()
    {
        $PersitenciaCategoria = new DaoCategoria();
        return $PersitenciaCategoria->getAll();   
     
        
    }

    //produtooooo //////

    public function produto()
    {
        $PersitenciaProduto = new DaoProduto();
        $this->produtos=$PersitenciaProduto->getAll();   
        $this->cadastro('produto');
        
    }

    public function ProdutoAll()
    {
        $PersitenciaProduto = new DaoProduto();
        return $PersitenciaProduto->getAll();   
     
        
    }

    public function IdCategoria($id){
        
        $PersitenciaCategoria = new DaoCategoria();
        $retorno=$PersitenciaCategoria->read($id);       
        
        return $retorno->getNome();

    }
    public function addProduto()
    {
       
        $produto = new ProdutoModel();
        $produto->setNomeProduto($_POST['nomeProduto']);
        $produto->setValorProduto(doubleval($_POST['valorProduto']));
        $produto->setIdCategoria(intval($_POST['idCategoria']));
        $PersitenciaProduto = new DaoProduto();
        $retorno=$PersitenciaProduto->create($produto); 
        echo json_encode($retorno);
    }

    public function updateProduto()
    {
        $produto = new ProdutoModel();
        $produto->setNomeProduto($_POST['nomeProduto']);
        $produto->setValorProduto(doubleval($_POST['valorProduto']));
        $produto->setIdCategoria(intval($_POST['idCategoria']));
        $produto->setIdProduto(intval($_POST['idProduto']));
        $PersitenciaProduto = new DaoProduto();
        $retorno=$PersitenciaProduto->update($produto); 
        echo json_encode($retorno);
    }

    public function findProduto($id){
        
        $PersitenciaProduto = new DaoProduto();
        $this->dadosBuscados=$PersitenciaProduto->read($id);     
        
        echo json_encode($this->dadosBuscados);

    }
    public function deletarProduto($id){
        $PersitenciaProduto = new DaoProduto();
        $retorno=$PersitenciaProduto->delete($id);       
        
        echo json_encode($retorno);
    }


    /// funcionario

    public function funcionario()
    {
        $PersitenciaFuncionario = new DaoFuncionario();
        $this->funcionarios=$PersitenciaFuncionario->getAll();   
        $this->cadastro('funcionario');
        
    }
    public function addfuncionario()
    {
       
        $funcionario = new FuncionarioModel();
        $funcionario->setNomeFuncionario($_POST['nomeFuncionario']);
        $funcionario->setUsuario($_POST['usuario']);
        $funcionario->setSenha(md5($_POST['senha']));
        $funcionario->setStatusFuncionario(intval($_POST['statusFuncionario']));
        $funcionario->setPainel($_POST['painel']);
        $Persitenciafuncionario = new DaoFuncionario();
        $retorno=$Persitenciafuncionario->create($funcionario); 
        echo json_encode($retorno);
    }

    public function updatefuncionario()
    {
        $funcionario = new FuncionarioModel();
        $funcionario->setNomeFuncionario($_POST['nomeFuncionario']);
        $funcionario->setUsuario($_POST['usuario']);
        $funcionario->setSenha($_POST['senha']);
        $funcionario->setStatusFuncionario(intval($_POST['statusFuncionario']));
        $funcionario->setPainel($_POST['painel']);
        $funcionario->setIdFuncionario($_POST['idFuncionario']);
        $Persitenciafuncionario = new DaoFuncionario();
        $retorno=$Persitenciafuncionario->update($funcionario); 
        echo json_encode($retorno);
    }

    public function findfuncionario($id){
        
        $Persitenciafuncionario = new DaoFuncionario();
        $this->dadosBuscados=$Persitenciafuncionario->read($id);     
        
        echo json_encode($this->dadosBuscados);

    }
    public function deletarfuncionario($id){
        $Persitenciafuncionario = new DaoFuncionario();
        $retorno=$Persitenciafuncionario->delete($id);       
        
        echo json_encode($retorno);
    }

    
}

?>