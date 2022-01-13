<?php require_once PATH_TOPO."cabecalho.php"
?>
<link rel="stylesheet" href="<?=ROTA_CSS?>/table.css">
<link rel="stylesheet" href="<?=ROTA_CSS?>/modal.css">
<link rel="stylesheet" href="<?=ROTA_TABLE?>/datatables.min.css">
<script type="text/javascript" src="<?=ROTA_TABLE?>/datatables.min.js"></script>


<small> <div align="center" class="mt-1" id="mensagem"></div></small>


<h1>Cadastro de Produto</h1>
<button id="myBtn" class="myButton">Adiconar Produto</button>

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
                        <th>Produto</th>
                        <th>Valor</th>
                        <th>Categoria</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>
                <tbody>
              <?php  foreach ($this->produtos as $key => $value) {
              ?>
                        <tr>
                            <td><?=$value->getIdProduto()?></td>
                            <td><?=$value->getNomeProduto()?></td>   
                            <td><?=$value->getValorProduto()?></td>    
                            <td><?=$this->IdCategoria($value->getidCategoria())?></td>                       
                            <td><button class="myButton primary" onclick="editar('<?=$value->getIdProduto()?>')">!</button></td>
                            <td><button class="myButton danger" onclick="deletar('<?=$value->getIdProduto()?>')">X</button></td>

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
    <p>Cadastro de Produto</p>
    <div class="modal-body">
        <form action="" name="myForm" id="myForm">
            <fieldset>
                <div class="form-row">
                   
                    <div class="inputform">
                        <label for="">Nome da Produto</label>
                        <input class="texto" type="text" name="nomeProduto" id="nomeProduto">
                    </div>
                    <div class="inputform">
                    <label for="">Codigo</label>
                        <input class="texto" type="hidden" name="idProduto" id="idProduto"  >
                        <input class="texto" type="text" name="idProdutos" id="idProdutos" disabled >
                    </div>
                   
                </div>
            </fieldset>   
            <fieldset>
                <div class="form-row">
                    <div class="inputform">
                        <label for="">Categoria</label>
                        <select class="texto" name="idCategoria" id="idCategoria">
                           <?php foreach($this->CategoriaAll() as $key=>$value){
                               echo '<option value="'.$value->getId().'">'.$value->getNome()."</option>";
                           }?>
                        </select>
                    </div>
                    <div class="inputform">
                    <label for="">Valor</label>
                        <input class="texto" type="text" name="valorProduto" id="valorProduto" >
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
        let id=document.getElementById('idProduto').value;
       
        if(id!='')
        {
            $.ajax({
                url:'<?=ROTA_GERAL?>/Cadastro/updateProduto',
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
                url:'<?=ROTA_GERAL?>/Cadastro/addProduto',
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
           url:"<?=ROTA_GERAL?>/Cadastro/findProduto/"+id,
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
                    url:"<?=ROTA_GERAL?>/Cadastro/deletarProduto/"+id,
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






