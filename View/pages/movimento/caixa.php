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
                        <label for="">Nome do Caixa</label>
                        <input class="texto" type="text" name="nomeCaixa" id="nomeCaixa">
                    </div>
                    <div class="inputform">
                    <label for="">Codigo</label>
                        <input class="texto" type="hidden" name="idCaixa" id="idCaixa"  >
                        <input class="texto" type="text" name="idCaixas" id="idCaixas" disabled >
                    </div>
                   
                </div>
            </fieldset>   
                <div class="form-row">
                    <div class="inputform">
                      
                        <input type="hidden" value="1" name="statusCaixa" id="statusCaixa">
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
        <form action="" name="myFormPagamento" id="myFormPagamento">
            <fieldset>
                <div class="form-row">                   
                    <div class="inputform">
                    <input class="texto" type="hidden" name="idCaixaPagamento"  id="idCaixaPagamento">
                    <input class="texto" type="hidden" name="acao"  id="acao">
                        <label for="">Dinheiro</label>
                        <input class="texto" type="hidden" name="tipoDinheiro" value="Dinheiro" id="tipoDinheiro">
                        <input class="texto" type="number" required name="valorDinheiro" id="valorDinheiro">
                    </div>
                    <div class="inputform">
                    <label for="">Crédito</label>
                    <input class="texto" type="hidden" name="tipoCredito" value="Credito" id="tipoCredito">
                        <input class="texto" type="number" required name="valorCredito" id="valorCredito" >
                    </div>                   
                </div>
            </fieldset>   
            <fieldset>
                <div class="form-row">                   
                    <div class="inputform">
                        <label for="">Pix</label>
                        <input class="texto" type="hidden" name="tipoPix" value="Pix" id="tipoPix">
                        <input class="texto" type="number" required name="valorPix" id="valorPix">
                    </div>

                    <div class="inputform">
                    <label for="">Débito</label>      
                    <input class="texto" type="hidden" name="tipoDebito" value="Debito" id="tipoDebito">
                        <input class="texto" type="number" required name="valorDebito" id="valorDebito" >
                    </div>
                   
                </div>
            </fieldset>   
            
                 

        </form>
    </div>
    <hr>
    <div class="modal-footer">
             <div class="form-row right">
                <button type="submit" id="btn_addPagamento" class="myButton success">Adicionar</button>
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
echo is_null($array);
   
    if(!is_null($array)){
        if (count($array)!=0) {
            # code...
        
        require_once ("historicoBico.php");
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
        limpa();
        $('#idCaixaPagamento').val(id);
        
        $.ajax({
                url:'<?=ROTA_GERAL?>/Movimento/buscaPagamento/'+id,
                method:'POST',
                dataType:'JSON',               
                success:function(resposta){
                   
                   if(resposta.length>0)
                   {$("#btn_addPagamento").text("Atualizar");
                    $("#acao").val("Atualizar");
                   }else{$("#btn_addPagamento").text("Adicionar");
                    $("#acao").val('Cadastrar');
                   }
                    resposta.forEach(element => {
                        switch (element['tipoPagamento']) {
                        case 'Dinheiro':
                            $("#valorDinheiro").val(element['valorPagamento']);
                            break;
                            case 'Credito':
                                $("#valorCredito").val(element['valorPagamento']);
                            break;
                            case 'Debito':
                                $("#valorDebito").val(element['valorPagamento']);
                            break;
                            case 'Pix':
                                $("#valorPix").val(element['valorPagamento']);
                            break;
                        default:
                            break;
                    }
                  
                    });
                    
                  
                    openModal('myPagamento');
                 
                }
            });
        
    }
    $('#btn_addPagamento').click(function(e){
        e.preventDefault();
        let acao = $("#acao").val();
        if(acao=='Cadastrar'){          
        $.ajax({
                url:'<?=ROTA_GERAL?>/Movimento/addPagamento',
                method:'POST',
                dataType:'JSON',
                data:$('#myFormPagamento').serialize(),
                success:function(resposta){
                    alertaTempo(resposta, '2000');
                }
            });
        }else
        {
            $.ajax({
                url:'<?=ROTA_GERAL?>/Movimento/upPagamento',
                method:'POST',
                dataType:'JSON',
                data:$('#myFormPagamento').serialize(),
                success:function(resposta){
                    alertaTempo(resposta, '2000');
                }
            });
        }
               
    });

    function limpa()
    {
        $("#valorDinheiro").val("");
        $("#valorCredito").val("");
        $("#valorDebito").val("");
        $("#valorPix").val("");
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
        total=0;
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
        html+='<td>'+(element['valorProduto']*element['totalBico']).toLocaleString('pt-BR')+'</td>';
        total+=element['valorProduto']*(element['totalBico']);
        html+='</tr>';
        
        
        });
        html+='<tr>';
        html+='<td colspan="5"><center><b>Soma da Venda de todos os Bicos</b></center></td>';
        html+='<td colspan="2"><center><b> R$ '+(total).toLocaleString('pt-BR')+'</b></center></td>';
        html+='</tr>';
        html+='</tbody>';
        html+='</table>';

        $('#lista').html(html);
    }
  

  
</script>





<script>
    $(document).ready(function(){
        let session = "<?=$this->historico?>";
        if(session=='SIM'){
        openModal("modalHistorico");        
        }
    });
    
</script>


<script src="<?=ROTA_JS?>/datatable.js"></script>
<script src="<?=ROTA_JS?>/modal.js"></script>