<?php require_once PATH_TOPO."cabecalho.php";
ini_set('display_errors', 0 );
error_reporting(0);
?>
<link rel="stylesheet" href="<?=ROTA_CSS?>/table.css">
<link rel="stylesheet" href="<?=ROTA_CSS?>/modal.css">
<link rel="stylesheet" href="<?=ROTA_TABLE?>/datatables.min.css">
<script type="text/javascript" src="<?=ROTA_TABLE?>/datatables.min.js"></script>


<small> <div align="center" class="mt-1" id="mensagem"></div></small>


<h1>Cadastro de Bico</h1>
<button id="myBtn" class="myButton">Adiconar Bico</button>

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
                        <th>Nome</th>
                        <th>Produto</th>
                        <th>Fechamento</th>
                        <th>Cor</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>
                <tbody>
              <?php  
            //   var_dump($this->bicos);
              foreach($this->bicos as $key => $value) {
              ?>
                        <tr>
                            <td><?=$value->getIdBico()?></td> 
                            <td><?=$value->getNomeBico()?></td> 
                            <td><?=$this->Idproduto($value->getIdProduto())?></td> 
                            <td><?=$value->getFechado()?></td>                        
                            <td><?=$value->getCor()?></td>
                            <td><button class="myButton primary" onclick="editar('<?=$value->getIdBico()?>')">!</button></td>
                            <td><button class="myButton danger" onclick="deletar('<?=$value->getIdBico()?>')">X</button></td>

                        </tr>
                       
                        
                  <?php  }?>
                
                </tbody>
                </tr>
            </table>





<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Cadastro de Bico</p>
    <div class="modal-body">
        <form action="" name="myForm" id="myForm">
            <fieldset>
                <div class="form-row">
                    <div class="inputform">
                        <label for="">Nome da Bico</label>
                        <input type="text" class="texto" name="nomeBico" id="nomeBico" required>
                    </div>
                    <div class="inputform">
                    <label for="">Código da Bico</label>
                        <input type="hidden" name="idBico" id="idBico" >
                        <input class="texto" type="text" name="idBicos" id="idBicos" disabled >
                    </div>
                   
                </div>
            </fieldset>      
            <fieldset>
                <div class="form-row">
                    <div class="inputform">
                        <label for="">Produto</label>
                        <select class="texto" name="idProduto" id="idProduto">
                           <?php foreach($this->ProdutoAll() as $key=>$value){
                               echo '<option value="'.$value->getIdProduto().'">'.$value->getNomeProduto()."</option>";
                           }?>
                        </select>
                    </div>
                    <div class="inputform">
                    <label for="">Fechamento</label>
                        <input type="text" class="texto" name="Fechado" id="Fechado" required>
                    </div>
                   
                </div>
            </fieldset>        
            <fieldset>
                <div class="form-row">
                    <div class="inputform">
                        <label for="">Cor</label>
                        <input type="text" class="texto" name="cor" id="cor" required>
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
        let id=document.getElementById('idBico').value;
       
        if(id!='')
        {
            $.ajax({
                url:'<?=ROTA_GERAL?>/Cadastro/updateBico',
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
                url:'<?=ROTA_GERAL?>/Cadastro/addBico',
                method:'POST',
                dataType:'JSON',
                data:$('#myForm').serialize(),
                success:function(resposta){
                    alertaTempo(resposta, '1000');
                }
            });
        }
        
    });

   function editar(id){
       $.ajax({
           url:"<?=ROTA_GERAL?>/Cadastro/findBico/"+id,
           method:'POST',
           dataType:'JSON',    
           success:function(resposta){   
            //    console.log(resposta);
            $("#nomeBico").val(resposta.nomeBico);
            $("#idProduto").val(resposta.idProduto);
            $("#Fechado").val(resposta.Fechado);
            $("#cor").val(resposta.cor);         
            $("#idBico").val(resposta.idBico);
            $("#idBicos").val(resposta.idBico);
             $("#btn_add").text("Atualizar");
            openModal();
           }      
          
       })
   }
   btnclose.onclick = function() {
            $("#nomeBico").val('');       
            $("#idProduto").val('');
            $("#Fechado").val('');          
            $("#cor").val(''); 
            $("#idBico").val('');
            $("#idBicos").val('');
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
                    url:"<?=ROTA_GERAL?>/Cadastro/deletarBico/"+id,
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






