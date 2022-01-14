<?php require_once PATH_TOPO."cabecalho.php";
ini_set('display_errors', 0 );
error_reporting(0);

// var_dump($this->verifica);
?>
<link rel="stylesheet" href="<?=ROTA_CSS?>/table.css">
<link rel="stylesheet" href="<?=ROTA_CSS?>/modal.css">
<link rel="stylesheet" href="<?=ROTA_TABLE?>/datatables.min.css">
<script type="text/javascript" src="<?=ROTA_TABLE?>/datatables.min.js"></script>



<small> <div align="center" class="mt-1" id="mensagem"></div></small>


<h1>Caixa</h1>
<button id="myBtn" class="myButton">Adiconar novo</button>

<br>
<br>

<style>
            input.form-control {
                border: solid;
                border-radius: 19px;
            }
        </style>

        <input type="date" class="form-control" name="data" id="">
           

            <table id="example" class="blueTable">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Descrição</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Acessar</th>
                        <th>Visualizar</th>
                    </tr>
                </thead>
                <tbody>
              <?php  foreach ($this->caixas as $key => $value) {
              ?>
                        <tr>
                            <td><?=$value->getIdCaixa()?></td>
                            <td><?=$value->getDescricao()?></td>   
                            <?php $data=explode(" ",$value->getDataCaixa())?>
                            <td><?=implode("/", array_reverse(explode("-",$data[0])))." ".$data[1]?></td>                                
                            <td><?=$value->getStatusCaixa()?'Ativo':'Efetivado'?></td>                        
                            <td><button class="myButton primary" onclick="inserir('<?=$value->getIdCaixa()?>')">!</button></td>
                            <td><button class="myButton danger" onclick="visualizar('<?=$value->getIdCaixa()?>')">@</button></td>

                        </tr>
                       
                        
                  <?php  }?>
                
                </tbody>
                </tr>
            </table>





<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width:40% !important;">
    <span class="close">&times;</span>
    <p>Cadastro de Caixa</p>
    <div class="modal-body">
        <form action="" name="myForm" id="myForm">
            <fieldset>
                <div class="form-row">
                   
                    <div class="inputform">
                        <label for="">Caixa</label>
                        <input class="texto" type="text" name="nomeCaixa" id="nomeCaixa">
                    </div>
                    <div class="inputform">
                    <label for="">Codigo</label>
                        <input class="texto" type="hidden" name="idCaixa" id="idCaixa"  >
                        <input class="texto" type="text" name="idCaixas" id="idCaixas" disabled >
                    </div>
                   
                </div>
            </fieldset>   
            <fieldset>
                <div class="form-row">
                    <div class="inputform">
                        <label for="">Status</label>
                        <select class="texto" name="statusCaixa" id="statusCaixa">
                           <option value="1">Ativo</option>
                           <option value="0">Inativo</option>
                        </select>
                    </div>
                                       
                </div>
            </fieldset>     
                 

        </form>
    </div>
    <hr>
    <div class="modal-footer">
             <div class="form-row right">
                <button type="submit" id="btn_add" class="myButton success">Adicionar</button>
                <button id="btnClose" class="myButton cancelar">Cancelar</button>
             </div>
    </div>
  </div>

</div>




<!-- The Modal pagamento -->
<div id="myPagamento" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width:40% !important;">
    <span class="close">&times;</span>
    <p>Pagamento de Caixa</p>
    <div class="modal-body">
        <form action="" name="myForm" id="myForm">
            <fieldset>
                <div class="form-row">                   
                    <div class="inputform">
                        <label for="">Dinheiro</label>
                        <input class="texto" type="hidden" name="tipoDinheiro" value="dinheiro" id="tipoDinheiro">
                        <input class="texto" type="number" name="valorDinheiro" id="valorDinheiro">
                    </div>
                    <div class="inputform">
                    <label for="">Crédito</label>
                    <input class="texto" type="hidden" name="tipoCredito" value="Credito" id="tipoCredito">
                        <input class="texto" type="number" name="valorCredito" id="valorCredito" >
                    </div>                   
                </div>
            </fieldset>   
            <fieldset>
                <div class="form-row">                   
                    <div class="inputform">
                        <label for="">Pix</label>
                        <input class="texto" type="hidden" name="tipoPix" value="Pix" id="tipoPix">
                        <input class="texto" type="number" name="valorPix" id="valorPix">
                    </div>

                    <div class="inputform">
                    <label for="">Débito</label>      
                    <input class="texto" type="hidden" name="tipoDebito" value="Debito" id="tipoDebito">
                        <input class="texto" type="number" name="valorDebito" id="valorDebito" >
                    </div>
                   
                </div>
            </fieldset>   
            
                 

        </form>
    </div>
    <hr>
    <div class="modal-footer">
             <div class="form-row right">
                <button type="submit" id="btn_add" class="myButton success">Adicionar</button>
                <button id="btnClose" onclick="fechaModal('myPagamento');" class="myButton cancelar">Cancelar</button>
             </div>
    </div>
  </div>

</div>


<!-- The Modal -->
<div id="modalDetalhes" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width:80% !important;">
    <span class="close">&times;</span>
    <p>Dados do Caixa</p>
    <div class="modal-body" id="lista">
                <?php var_dump($this->dadosBuscados);?>
    </div>
    <hr>
    <div class="modal-footer">
             <div class="form-row right">
                
                <button id="btnClose" onclick="fechaModal('modalDetalhes');" class="myButton cancelar">Fechar</button>
             </div>
    </div>
  </div>

</div>

<!-- The Modal Historico -->

<?php 

$array=@$_SESSION['bicos'];
// var_dump($array);
// echo is_null($array);
if(!is_null($array)){    
    if(count($array)!=0){
        require_once ("historicoBico.php");
    }else{
    $this->updateCaixa();
    }
}

?>


<?php require_once PATH_TOPO."rodape.php";
?>


<script>
function openModal(nome)
    {
        var modal = document.getElementById(nome);
        modal.style.display='block';
    }
function fechaModal(nome){    
    var modal = document.getElementById(nome);
    modal.style.display = "none";
    }

    $('#btn_add').click(function(e){
        e.preventDefault();
        let id=document.getElementById('idCaixa').value;
       
        if(id!='')
        {
            $.ajax({
                url:'<?=ROTA_GERAL?>/Movimento/updateCaixa',
                method:'POST',
                dataType:'JSON',
                data:$('#myForm').serialize(),
                success:function(resposta){
                    alertaTempo(resposta, '2000');
                }
            });

        }else
        {
            $.ajax({
                url:'<?=ROTA_GERAL?>/Movimento/addCaixa',
                method:'POST',
                dataType:'JSON',
                data:$('#myForm').serialize(),
                success:function(resposta){
                    alertaTempo(resposta, '1000');
                }
            });
        }
        
    });

    $('#btn_fechamento').click(function(e){
        e.preventDefault();
        let id=document.getElementById('idCaixa').value;
        $.ajax({
                url:'<?=ROTA_GERAL?>/Movimento/addFechamento',
                method:'POST',
                dataType:'JSON',
                data:$('#formFechamento').serialize(),
                success:function(resposta){
                    alertaTempo(resposta, '500');
                }
            });
    });

    function inserir(id){
        openModal('myPagamento');
        // $.ajax({
        //         url:'<=ROTA_GERAL?>/Movimento/addPagamento/'+id,
        //         method:'POST',
        //         dataType:'JSON',               
        //         success:function(resposta){
        //             tableDetalhes(resposta);
                 
        //         }
        //     });
        
    }
    function visualizar(id){
        
        $.ajax({
                url:'<?=ROTA_GERAL?>/Movimento/findMovimento/'+id,
                method:'POST',
                dataType:'JSON',               
                success:function(resposta){
                    tableDetalhes(resposta);
                    openModal('modalDetalhes');
                }
            });
        
    }

    function tableDetalhes(dados){
        html='';
        html+='<table>';
        html+='<thead>';
        html+='<tr>';
        html+='<th>Bico</th>';
        html+='<th>Data</th>';       
        html+='<th>Produto</th>';
        html+='<th>Valor</th>';
        html+='<th>Aberto</th>';
        html+='<th>Fechado</th>';
        html+='<th>Total R$</th>';
        html+='</tr>';
        html+='</thead>';
        html+='<tbody>';
        dados.forEach(element => {          
        html+='<tr>';
        html+='<td>'+element['nomeBico']+'</td>';
        html+='<td>'+element['dataMovimento']+'</td>';       
        html+='<td>'+element['nomeProduto']+'</td>';
        html+='<td>'+element['valorProduto']+'</td>';
        html+='<td>'+element['qtdoAberto']+'</td>';
        html+='<td>'+element['qtdoFechado']+'</td>';
        html+='<td>'+(element['valorProduto']*(element['qtdoFechado']-element['qtdoAberto'])).toLocaleString('pt-BR')+'</td>';
        
        html+='</tr>';
        });
        html+='</tbody>';
        html+='</table>';

        $('#lista').html(html);
    }
  
</script>





<script>
    $(document).ready(function(){
        let session = "<?= !empty($this->verifica)?'SIM':'NAO'?>";
        if(session=='SIM'){
        openModal("modalHistorico");        
        }
    });
    
</script>


<script src="<?=ROTA_JS?>/datatable.js"></script>
<script src="<?=ROTA_JS?>/modal.js"></script>