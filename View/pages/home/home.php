<?php require_once PATH_TOPO."cabecalho.php"
?>

<link rel="stylesheet" href="<?=ROTA_CSS?>/cards.css">

<h1>Ultimo Fechamentos</h1>



<?php 
foreach($this->bicos as $key =>$value)
{?>
<div class="cards">    
    <div class="card ">
        <div class="card_title <?=$value->getCor()?>"><i class='bx bxs-gas-pump'></i><?=$value->getNomeBico()?></div>
        <div class="card_body"><?=$value->getFechado()?></div>
    </div>
</div>
<?php  }?>






<?php require_once PATH_TOPO."rodape.php"

?>