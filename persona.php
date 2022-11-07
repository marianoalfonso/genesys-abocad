<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersona">    
            <div class="modal-body">
                <div class="row">
                    <!-- apellido -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="" class="col-form-label">apellido</label>
                        <input type="text" class="form-control" id="apellido">
                      </div> 
                    </div>    
                    <!-- nombre -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="" class="col-form-label">nombre</label>
                        <input type="text" class="form-control" id="nombre">
                      </div>               
                    </div>
                    <!-- dni -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="" class="col-form-label">dni</label>
                        <input type="text" class="form-control" id="dni">
                      </div>               
                    </div>
                    <!-- direccion -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="" class="col-form-label">direccion</label>
                        <input type="direccion" class="form-control" id="direccion">
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