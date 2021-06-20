
let Helpers = {

    alert: (mensaje, tipo) => {
        let icono = "";
        if (tipo == "error") {
            icono = "<i class='bi bi-x-circle'></i>";
        } else if (tipo == "success") {
            icono = "<i class='bi bi-check-circle'></i><br>";
        } else if (tipo == "warning") {
            icono = "<i class='bi bi-exclamation-circle'></i><br>"
        }
        bootbox.alert({
            title: 'Alerta',
            message: "<div class='dialog-row'><div class='dialog-icon'>" + icono + "</div><div class='dialog-msg'>" + mensaje + "</div></div>",
            size: 'medium',
            buttons: {
                ok: {
                    label: 'Aceptar',
                    className: 'btn btn-sm btn-outline-primary'
                }
            }
        });
    },

    error_ajax: function(jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 0) {
            Helpers.alert("Not connect: Verify Network", "error");
        } else if (jqXHR.status == 404) {
            Helpers.alert("Requested page not found [404]", "error");
        } else if (jqXHR.status == 500) {
            Helpers.alert("Internal Server Error [500]", "error");
        } else if (textStatus === "parsererror") {
            Helpers.alert("Requested JSON parse failed", "error");
        } else if (textStatus === "timeout") {
            Helpers.alert("Time out error", "error");
        } else if (textStatus === "abort") {
            Helpers.alert("Ajax request aborted", "error");
        } else {
            Helpers.alert("Uncaught Error: " + qXHR.responseText, "error");
        }

    },

    dataTables2: (id_tabla, paginador, ordenar, inform, buscar, data, colums = null) => {
        return $('#' + id_tabla).DataTable({
            paging: paginador,
            ordering: ordenar,
            info: inform,
            searching: buscar,
            language: {
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "lengthMenu": "Mostrar _MENU_ registros",
                "info": "Mostrando registros del _START_ al _END_ de un total de  _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de  _MAX_ registros)",
                "search": "Buscar:",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                }

            },
            pagingType: "simple_numbers",
            data: data,
            "columns": colums
        });
    },

    contextMenu2: function(tabla,items) {
        $ .contextMenu ('destroy');
        $('#' + tabla).contextMenu({
            selector: '.context-menu-one',
            trigger: 'left',
            items: items,
            autoHide: true
        });
    },

};