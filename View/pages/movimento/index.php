<?php require_once PATH_TOPO."cabecalho.php";
ini_set('display_errors', 0 );
error_reporting(0);
?>

<link rel="stylesheet" href="<?=ROTA_CSS?>/cards.css">

<h1>Movimentações</h1>




<div class="cards">
    <a href="<?=ROTA_GERAL?>/Movimento/caixa">
    <div class="card">
        <div class="card_title"><i class='bx bxs-gas-pump'></i>Caixa</div>
        <div class="card_body">4</div>
    </div>
    </a>
</div>

<div class="cards">
    <div class="card">
        <div class="card_title"><i class='bx bxs-gas-pump'></i>Listar</div>
        <div class="card_body">4</div>
    </div>
</div>



<script src="<?=ROTA_JS?>/datatable.js"></script>
<script src="<?=ROTA_JS?>/modal.js"></script>
<?php require_once PATH_TOPO."rodape.php";
?>