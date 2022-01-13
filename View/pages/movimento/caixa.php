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
                            <td><?=$value->getStatusCaixa()?'Ativo':'Inativo'?></td>                        
                            <td><button class="myButton primary" onclick="editar('<?=$value->getIdCaixa()?>')">!</button></td>
                            <td><button class="myButton danger" onclick="deletar('<?=$value->getIdCaixa()?>')">X</button></td>

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

<!-- The Modal Historico -->

<?php 

$array=@$_SESSION['bicos'];
var_dump($array);
if(count($array)!=0){
    require_once "historicoBico.php";
}else{
    $this->updateCaixa();
}
    ?>




<script src="<?=ROTA_JS?>/datatable.js"></script>
<script src="<?=ROTA_JS?>/modal.js"></script>
<?php require_once PATH_TOPO."rodape.php";
?>

<script>

function openModal()
    {
        var modal = document.getElementById("myModal");
        modal.style.display='block';
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

   function editar(id){
       $.ajax({
           url:"<?=ROTA_GERAL?>/Movimento/findCaixa/"+id,
           method:'POST',
           dataType:'JSON',    
           success:function(resposta){   
            //    console.log(resposta);
            $("#nomeProduto").val(resposta.nomeProduto);
            $("#valorProduto").val(resposta.valorProduto);
            $("#idCategoria").val(resposta.idCategoria);
            $("#idProduto").val(resposta.idProduto);
            $("#idProdutos").val(resposta.idProduto);
             $("#btn_add").text("Atualizar");
            openModal();
           }      
          
       })
   }
   btnclose.onclick = function() {
            $("#nomeProduto").val('');
            $("#valorProduto").val('');
            $("#idCategoria").val('');
            $("#idProduto").val('');
            $("#idProdutos").val('');
             $("#btn_add").text("Adicionar");
             modal.style.display = "none";
   }

   function deletar(id)
   {
        Swal.fire({
            title: 'Deseja Deletar?',
            text: "voce esta deletando o registro de código "+ id ,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"<?=ROTA_GERAL?>/Movimento/deletarCaixa/"+id,
                    method:"POST",
                    dataType:'json',
                    success:function(resposta){
                        if(resposta==true)
                        {
                            Swal.fire(
                            'Deletado!',
                            'dado deletado com sucesso.',
                            'success'
                            )
                            window.location.reload();
                        }else{
                            Swal.fire(
                            'Não Deletado!',
                            'dado não deletado .',
                            'danger'
                            )
                        }
                    }
                });
                
            }
            })
   }
</script>





<script>
    $(document).ready(function(){
        let session = "<?= !empty($this->verifica)?'SIM':'NAO'?>";
        if(session=='SIM'){
        var modal = document.getElementById("modalHistorico");
        modal.style.display='block';
        }
    });
</script>
