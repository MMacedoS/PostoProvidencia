
<div class="modal fade" tabindex="-1" id="modalHistorico" data-bs-backdrop="static">
	<!-- Modal content -->
    <div class="modal-content" style="width:40%;">
    <span class="close">&times;</span>
    <p>Cadastro de Fechamento</p>
    <div class="modal-body">
        <form action="" name="formFechamento" id="formFechamento">
            <fieldset>
                <div class="form-row">
                    <div class="inputform">
                        <label for="">Fechamento Bico</label>
                        <input class="texto" type="text" name="fechamento" id="fechamento" val>
                    </div>
                    <div class="inputform">
                    <label for="">Bico</label>                        
                        <input class="texto" type="text" name="idCaixas" id="idCaixas" value="<?=@$array[0]->getNomeBico()?>" disabled >
                        <input class="texto" type="hidden" name="idBico" id="idBico" value="<?=@$array[0]->getIdBico()?>" >
                    </div>
                   
                </div>
            </fieldset>   
            
        </form>
    </div>
    <hr>
    <div class="modal-footer">
             <div class="form-row right">
                <button type="submit" id="btn_fechamento" class="myButton success">Adicionar</button>
                <button id="btnClose" class="myButton cancelar">Cancelar</button>
             </div>
    </div>
  </div>

</div>