$(function() {
    $('#tbl_consulta_direcciones tbody').on('click', '.context-menu-one', function () {
        let iddireccion = $(this).attr("id");
        var items = {        
          "EDITAR": {
              name: "EDITAR",
              icon: "bi bi-pencil-square",
                callback: function(itemKey, opt, e) {
                  Storage_direcciones.set_datos_direcciones();
                location.href=base_url + "Direccion/editar_direccion/"+iddireccion;
              }
          },
          "ELIMINAR": {
            name: "ELIMINAR",
            icon: "bi bi-pencil-square",
              callback: function(itemKey, opt, e) {
                Buscador.confirmar_eliminar(iddireccion);
            }
        },
        //   "OPERACION": operacion
        }
        Helpers.contextMenu2('tbl_consulta_direcciones', items);
      });
});

window.addEventListener("DOMContentLoaded", function() {
  if (typeof(Storage) !== "undefined") {
      if (localStorage.history_consultaDirecciones) {                     
        Storage_direcciones.get_datos_direcciones(Storage_direcciones.get_datos_extra);
      }
  }
});


$("#slc_estado").change(function(e) {
    e.preventDefault();
    Buscador.get_municipiosxestado($(this).val());
});

$("#btn_limpiar_filtros").click(function(ev){
    ev.preventDefault();
    $('#form_buscar_direccion')[0].reset();
    localStorage.clear();
  });
  
  $("#btn_buscar_direcciones").click(function (ev){
      ev.preventDefault();
      Buscador.buscar_direcciones();
  });

  var Buscador = {
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

    buscar_direcciones: () =>{
      let form = $("#form_buscar_direccion").serialize();
      $.ajax({
        url:base_url+"direccion/buscar_direcciones",
        method:"POST",
        data:form,
        beforeSend: function(xhr) {
        //   $("#wait").modal("show");
        },
      })
      .done(function(data){
        $('#tbl_consulta_direcciones tbody').empty();
        var table = document.getElementById("tbl_consulta_direcciones");
        var tr = "";
        if(data.direcciones.length > 0){
          data.direcciones.forEach(function( index ) {
              tr = "<tr id="+index['id']+">"+
                      "<td class='align-middle'>"+index['id']+"</td>"+
                      "<td class='align-middle'>"+index['nestado']+"</td>"+
                      "<td class='align-middle'>"+index['nmunicipio']+"</td>"+
                      "<td class='align-middle'><span class='context-menu-one btn btn-sm btn-primary' id="+index['id']+"><i class='bi bi-menu-down'>SELECCIONE</i></span></td>"+
                      
                  "</tr>";
                  $(table).append(tr);
          });
        }else{
          tr = "<tr>"+
          "<td colspan='4'><center>Sin datos para mostrar</center></td>"+
          "</tr>";
                  $(table).append(tr);
        }
      })
      .fail(function(jqXHR, textStatus, errorThrown){
          Helpers.error_ajax(jqXHR, textStatus, errorThrown);
      })
      .always(function(){
        // $("#wait").modal("hide");
      });
    },

    confirmar_eliminar : (iddireccion) =>{
              bootbox.confirm({
              title:'Confirmación',
              message: "<div class='dialog-row'><div class='dialog-icon'><i class='feather-info text-primary fa-3x'></i></div><div class='dialog-msg'>¿Eliminar esta dirección?</div></div>",
              buttons: {
                  confirm: {
                      label: 'Aceptar',
                      className: 'btn-outline-primary'
                  },
                  cancel: {
                      label: 'Cancelar',
                      className: 'btn-outline-warning btn-cancelar-bbox'
                  }
              },
              callback: function (result) {
                  if(result){
                    Buscador.eliminar_direccion(iddireccion);
                  }
              }
          });
    },

    eliminar_direccion : (iddireccion)=> {
      $.ajax({
          url: base_url + "Direccion/delete_direccion",     
          type:"POST",
          data:{iddireccion:iddireccion},
          beforeSend: function(xhr) {
            // $("#wait").modal("show");
          },

      })
      .done(function(data) {          
       if (data.respuesta) {
          Helpers.alert("Se elimino correctamente", "success");
          Buscador.buscar_direcciones();
      }else{
        Helpers.alert("Error al eliminar","error")
      }
      })
      .fail(function(jqXHR, textStatus, errorThrown) {
          Helpers.error_ajax(jqXHR, textStatus, errorThrown);
      })
      .always(function(data) {
        // $("#wait").modal("hide");
      });
  },

 
    
  };

  var Storage_direcciones = {
    set_datos_direcciones : () => {
      if (typeof(Storage) !== "undefined") {
        // LocalStorage disponible
        var history_set = {}
        history_set['idestado'] = $("#slc_estado").val();
        history_set['idmunicipio'] = $("#slc_municipio").val();
        history_set['localidad'] = $("#txt_localidad").val();
        history_set['direccion'] = $("#txt_direccion").val();
        localStorage.setItem("history_consultaDirecciones", JSON.stringify(history_set));
      }
  
    },
  
    get_datos_direcciones : (callback) => {
      if (typeof(Storage) !== "undefined") {
        // LocalStorage disponible
        var history_get = JSON.parse(localStorage.getItem("history_consultaDirecciones"));
        $("#slc_estado").val(history_get['idestado']);
        $("#slc_estado").trigger("change");
        setTimeout(function(){ callback(); }, 200);
      }
    },

    get_datos_extra : () => {
      var history_get = JSON.parse(localStorage.getItem("history_consultaDirecciones"));
        $("#slc_municipio").val(history_get['idmunicipio']); 
        $("#txt_localidad").val(history_get['localidad']); 
        $("#txt_direccion").val(history_get['direccion']); 
        Buscador.buscar_direcciones();
        localStorage.removeItem("history_consultaDirecciones");
    }

  }