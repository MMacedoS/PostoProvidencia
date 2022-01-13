<?php require_once PATH_TOPO."cabecalho.php";
ini_set('display_errors', 0 );
error_reporting(0);
?>
<link rel="stylesheet" href="<?=ROTA_CSS?>/table.css">
<link rel="stylesheet" href="<?=ROTA_CSS?>/modal.css">
<link rel="stylesheet" href="<?=ROTA_TABLE?>/datatables.min.css">
<script type="text/javascript" src="<?=ROTA_TABLE?>/datatables.min.js"></script>


<small> <div align="center" class="mt-1" id="mensagem"></div></small>


<h1>Cadastro de Funcionario</h1>
<button id="myBtn" class="myButton">Adiconar Funcionario</button>

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
                        <th>Usuario</th>
                        <th>Painel</th>
                        <th>Status</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>
                <tbody>
              <?php  foreach($this->funcionarios as $key => $value) {
              ?>
                        <tr>
                            <td><?=$value->getIdFuncionario()?></td>
                            <td><?=$value->getNomeFuncionario()?></td>   
                            <td><?=$value->getUsuario()?></td>    
                            <td><?=$value->getPainel()?></td>   
                            <td><?=$value->getStatusFuncionario()?'Ativo':'Inativo'?></td>                      
                            <td><button class="myButton primary" onclick="editar('<?=$value->getIdFuncionario()?>')">!</button></td>
                            <td><button class="myButton danger" onclick="deletar('<?=$value->getIdFuncionario()?>')">X</button></td>

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
    <p>Cadastro de Funcionario</p>
    <div class="modal-body">
        <form action="" name="myForm" id="myForm">
            <fieldset>
                <div class="form-row">
                    <div class="inputform">
                        <label for="">Nome da Funcionario</label>
                        <input type="text" name="nomeFuncionario" id="nomeFuncionario" required>
                    </div>
                    <div class="inputform">
                    <label for="">Código da Funcionario</label>
                        <input type="hidden" name="idFuncionario" id="idFuncionario" >
                        <input class="texto" type="text" name="idFuncionarios" id="idFuncionarios" disabled >
                    </div>
                   
                </div>
            </fieldset>      
            <fieldset>
                <div class="form-row">
                    <div class="inputform">
                        <label for="">Usuario</label>
                        <input type="email" name="usuario" id="usuario" required>
                    </div>
                    <div class="inputform">
                    <label for="">senha</label>
                        <input type="password" name="senha" id="senha" required>
                    </div>
                   
                </div>
            </fieldset>        
            <fieldset>
                <div class="form-row">
                    <div class="inputform">
                        <label for="">Painel</label>
                        <input type="text" name="painel" id="painel" required>
                    </div>
                    <div class="inputform">
                        <label for="">Status</label>
                        <select class="texto" name="statusFuncionario" id="statusFuncionario">
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
        let id=document.getElementById('idFuncionario').value;
       
        if(id!='')
        {
            $.ajax({
                url:'<?=ROTA_GERAL?>/Cadastro/updateFuncionario',
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
                url:'<?=ROTA_GERAL?>/Cadastro/addFuncionario',
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
           url:"<?=ROTA_GERAL?>/Cadastro/findFuncionario/"+id,
           method:'POST',
           dataType:'JSON',    
           success:function(resposta){   
            //    console.log(resposta);
            $("#nomeFuncionario").val(resposta.nomeFuncionario);
            $("#usuario").val(resposta.usuario);
            $("#senha").val('');
            $("#painel").val(resposta.painel);
            $("#statusFuncionario").val(resposta.statusFuncionario);
            $("#idFuncionario").val(resposta.idFuncionario);
            $("#idFuncionarios").val(resposta.idFuncionario);
             $("#btn_add").text("Atualizar");
            openModal();
           }      
          
       })
   }
   btnclose.onclick = function() {
            $("#nomeFuncionario").val('');
            $("#usuario").val('');
            $("#senha").val('');
            $("#painel").val('');
            $("#statusFuncionario").val('');
            $("#idFuncionario").val('');
            $("#idFuncionarios").val('');
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
                    url:"<?=ROTA_GERAL?>/Cadastro/deletarFuncionario/"+id,
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






