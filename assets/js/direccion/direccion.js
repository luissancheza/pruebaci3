$("#slc_estado").change(function(e) {
    e.preventDefault();
    Direccion.get_municipiosxestado($(this).val());
});

$('#slc_asig_uescolar').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
    let tipoasignatura = $('#slc_asig_uescolar option').eq(clickedIndex).data('tipoasig')
    // 4 corresponde a tipo asignatura paraescolar en catalogo de tipoasignaturas ajustar si es necesrio
    if(tipoasignatura == 4 && isSelected == true){
        $("#contenedor_paraescolares_uescolar").show();
    }else if(tipoasignatura == 4 && isSelected == false){
        $("#contenedor_paraescolares_uescolar").hide();
    }
  });

  $("#btn_agregar_permiso_uescolar").click(function(){
      Direccion.asigna_permisoG_g();
  });

  $.validator.addMethod("requiredselect", function(value, element, arg){
    return arg != element.value; 
 }, "El valor no debe ser igual a 0");

  $("#form_direccion").validate({
    onclick: false,
    onfocusout: false,
    onkeypress: false,
    onkeydown: false,
    onkeyup: false,
    rules: {
        slc_estado: { requiredselect: "0" },
        slc_municipio: { requiredselect: "0" },
        txt_localidad: { required: true},
        txt_latitud:{ required: true},
        txt_longitud :{ required: true},
        txt_direccion:{ required: true},
    },
    messages: {
        slc_estado: {requiredselect: "Seleccione un estado"},
        slc_municipio: {requiredselect: "Seleccione un municipio" },
        txt_localidad:{ required:"Ingrese localidad"},
        txt_latitud:{ required:"Debe capturar latitud"},
        txt_longitud: { required:"Debe capturar longitud"},
        txt_direccion: {required: "Ingrese direccion"},
    },	
    invalidHandler: function(form, validator) {
        // Helpers.mostrar_notificaciones_form(form="form_crear_usuario_escolar", validator);
    },
    submitHandler: function(form) {       
        Direccion.grabar_direccion();            
    }

})
  


let Direccion = {

    get_municipiosxestado: (idestado) => {
        $.ajax({
            url: base_url + "Direccion/get_municipiosxestado",
            method: "POST",
            data: {"idestado": idestado},
            beforeSend: function(xhr) {
                // $("#wait").modal("show");
            },
        })
        .done(function(data) {
            $("#slc_municipio").empty();
            $("#slc_municipio").append("<option data='0' value='-1'>SELECCIONAR</option>");
                data.municipios.forEach(function( index ) {
                $("#slc_municipio").append("<option value="+index['id']+">"+index['nombre']+"</option>");
                });
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            Helpers.error_ajax(jqXHR, textStatus, errorThrown);
        })
        .always(function() {
            // $("#wait").modal("hide");
        });

    },

    grabar_direccion : () => {
        let form = $("#form_direccion").serialize();
        $.ajax({
            url:base_url+"Direccion/insert_update",
            method:"POST",
            data:form,
            beforeSend: function(xhr) {
            // $("#wait").modal("show");
            },
        })
        .done(function(data){
            if(data.respuesta == 1 || data.respuesta == "1"){
                Helpers.alert("Se grabo correctamente","success");
            }else{
                Helpers.alert("No se pudo grabar la información","error");
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            Helpers.error_ajax(jqXHR, textStatus, errorThrown);
        })
        .always(function(){
            // $("#wait").modal("hide");
        });
    }

};
