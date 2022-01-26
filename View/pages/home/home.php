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

<style>
    .row {
    display: flex;
}
    .graficos {
    margin:45px;
    width: 40%;
}
.graficos.rosca {
    width: 25%;
    margin-left: 87px;
}
</style>
<div class="row">
<div class="graficos">
  <canvas id="myChart"></canvas>
</div>
<div class="graficos rosca">
  <canvas id="Rosca"></canvas>
</div>
</div>

<script>
     let dados=[];
     $(document).ready(function(){
        $.ajax({
            url:"<?=ROTA_GERAL?>/Home/graficosPagamentos",
            method:"POST",
            dataType:"json",
            success:function(resposta){
            //    console.log(resposta[0].valor);
            resposta.forEach(element => {
                if(element.valor != null){
                    dados.push(parseFloat(element.valor))
                }else{
                    dados.push(0);
                }
            });
              
               grafico();
               rosca();
               
            }
        });
      
    });
</script>
<script>
function grafico(){
    console.log(dados);   
  var labels = [
    'Janeiro',
    'Fevereiro',
    'Março',
    'Abril',
    'Maio',
    'Junho',
    'Julho',
    'Agosto',
    'Setembro',
    'Outubro',
    'Novembro',
    'Dezembro',
  ];

  var data = {
    labels: labels,
    datasets: [{
      label: 'Entradas Mensais',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
    //   data: [0, 10.5, 55.5, 2, 20, 30, 45],
      data:dados,
    }]
  };

  var config = {
    type: 'line',
    data: data,
    options: {}
  };

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
}

function rosca()
{
    const data = {
  labels: [
    'Red',
    'Blue',
    'Yellow'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [300, 50, 100],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
    hoverOffset: 4
  }]
};

const config = {
  type: 'doughnut',
  data: data,
};
const rosca = new Chart(
    document.getElementById('Rosca'),
    config
  );
}
</script>



<?php require_once PATH_TOPO."rodape.php"

?>