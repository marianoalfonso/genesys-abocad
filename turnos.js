//para limpiar los campos antes de dar de Alta una Persona
$("#btnNuevoTurno").click(function(){
    opcion = 1; //alta           
    user_id=null;
    $("#formTurnos").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("alta de paciente");
    $('#modalCRUD').modal('show');	    
});