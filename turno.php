<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formTurnos">    
            <div class="modal-body">
                <div class="row">
                    <!-- paciente -->
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="" class="col-form-label">paciente</label>
                        <input type="text" class="form-control" id="paciente">
                      </div> 
                    </div>    
                </div>

                <div class="row">
                    <!-- profesional -->
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="" class="col-form-label">profesional</label>
                        <input type="text" class="form-control" id="profesional">
                      </div> 
                    </div>    
                </div>

                <div class="row">
                    <!-- fecha inicio -->
                    <div class="col-lg-06">
                      <div class="form-group">
                        <label for="">fecha de inicio:</label>   
                        <input type="date" class="form-control" id="fechaInicio">
                      </div> 
                    </div>   
                    
                    <!-- hora inicio -->
                    <div class="col-lg-06">
                      <div class="form-group">
                        <label for="">hora de inicio</label>
                        <input type="text" id="horaInicio" class="form-control" autocomplete="off">
                      </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  