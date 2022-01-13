<link rel="stylesheet" href="<?=ROTA_CSS?>/cards.css">
<?php require_once PATH_TOPO."cabecalho.php"
?>



<h1>Pagina Cadastro</h1>


<div class="cards">
    <a href="<?=ROTA_GERAL?>/Cadastro/bico">
    <div class="card">
        <div class="card_title"><i class='bx bxs-gas-pump'></i>Bico</div>
        <div class="card_body"><?=@count($this->bicos)?></div>
    </div>
    </a>
</div>
<div class="cards">
<a href="<?=ROTA_GERAL?>/Cadastro/funcionario">
    <div class="card">
        <div class="card_title"><i class='bx bxs-gas-pump'></i>Funcionario</div>
        <div class="card_body"><?=@count($this->funcionarios)?></div>
    </div>
    </a>
</div>
<div class="cards">
    <a href="<?=ROTA_GERAL?>/Cadastro/categoria">
    <div class="card">
        <div class="card_title"><i class='bx bxs-gas-pump'></i>Categoria</div>
        <div class="card_body"><?=@count($this->categorias)?></div>
    </div>
    </a>
</div>
<div class="cards">
<a href="<?=ROTA_GERAL?>/Cadastro/produto">
    <div class="card">
        <div class="card_title"><i class='bx bxs-gas-pump'></i>Produto</div>
        <div class="card_body"><?=@count($this->produtos)?></div>
    </div>
    </a>
</div>







<?php require_once PATH_TOPO."rodape.php"

?>