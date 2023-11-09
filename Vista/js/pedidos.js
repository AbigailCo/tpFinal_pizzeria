var url;

/**
 * Plantilla para mostrar un cartel de error
 * @param string $contenidoError
 * @return string
 */
function mostrarError(contenidoError) {
    return (
        '<div class="col-12 alert alert-danger m-3 p-3 mx-auto alert-dismissible fade show" role="alert">' +
        contenidoError +
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
    );
}

$(document).ready(function() {
    var table = $("#tabla").DataTable({
        responsive: true,
        ajax: {
            url: "accion/listarPedidos.php",
            dataSrc: "",
        },
        columns: [
            {
                data: "productos",
            },
            {
                data: "fecha",
            },
            {
                data: "estado",
            },
            {
                data: "accion",
            },
        ]
    });
});

$("#form-abm").validate({
    submitHandler: function(e) {
        $.ajax({
            url: url,
            type: "POST",
            data: $("#form-abm").serialize(),
            beforeSend: function() {
                $("#btn-submit").html(
                    '<span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span>Cargando...'
                );
            },
            complete: function() {
                $("#btn-submit").html("Reintentar");
            },
            success: function(result) {
                result = JSON.parse(result);

                if (result.respuesta) {
                    $("#dlg").modal("hide");
                    $("#form-abm").trigger("reset");
                    recargar();
                } else {
                    $("#errores").html(mostrarError(result.errorMsg));
                }
            },
        });
    },
});

function recargar() {
    $("#tabla").DataTable().ajax.reload();
}


function destroyMenu() {
    $("#tabla tbody").on("click", "button", function() {
        var data = $("#tabla").DataTable().row($(this).parents("tr")).data();

        if (data != null) {
            $("#title").html("Cancelar Pedido");
            $("#dlg").modal("show");

            $("#btn-submit").html("Cancelar");
            $("#btn-submit").removeClass("btn-primary").addClass("btn-danger");

            $("#id").val(data["id"]);

            url = "accion/cancelarPedido.php";
        }
    });
}