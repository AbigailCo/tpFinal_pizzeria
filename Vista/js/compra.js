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
    columns: [{
            data: "id",
        },
        {
            data: "usuario"
        },
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
            data: "estadofecha",
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

function limpiar() {
$("#form-abm").trigger("reset");
$("#idcompraestadotipo").removeClass("is-invalid").removeClass("is-valid");
var arreglo = $(".estadostipo");
for (var i = 0; i < arreglo.length; i++) {
    arreglo[i].removeAttribute("checked");
}
}


function destroyMenu() {
$("#tabla tbody").on("click", "button", function() {
    var data = $("#tabla").DataTable().row($(this).parents("tr")).data();

    if (data != null) {
        $("#title").html("Cancelar Pedido");
        $("#dlg").modal("show");

        $("#edit-form").hide();
        $("#delete-form").show();

        $("#btn-submit").html("Eliminar");
        $("#btn-submit").removeClass("btn-primary").addClass("btn-danger");

        $("#id").val(data["id"]);

        url = "accion/cancelarPedido.php";
    }
});
}


function editMenu() {
$("#tabla tbody").on("click", "button", function() {
    var data = $("#tabla").DataTable().row($(this).parents("tr")).data();

    if (data != null) {
        $("#title").html("Cambiar Estado");
        $("#dlg").modal("show");

        limpiar();

        $("#delete-form").hide();
        $("#edit-form").show();

        $("#btn-submit").html("Avanzar");
        $("#btn-submit").removeClass("btn-danger").addClass("btn-primary");

        $("#id").val(data["id"]);
        $("#idcompraestadotipo").val(data["estadoid"]);
        url = "accion/cambiarEstadoPedido.php";


        switch(data["estadoid"]){
            case 2:
                $("#estadoactual").html("Compra iniciada")
                $("#iniciada").show()
                break;
            case 3:
                $("#estadoactual").html("Compra aceptada")
                $("#aceptada").show()
                break;
            case 4:
                $("#estadoactual").html("Compra enviada")
                $("#enviada").show()
                break;
        }
    }
});



}