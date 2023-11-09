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
            url: "accion/listarRol.php",
            dataSrc: "",
        },
        columns: [{
                data: "id",
            },
            {
                data: "roldescripcion",
            },
            {
                data: "permisos",
            },
            {
                data: "accion",
            },
        ],
    });
});

$("#form-abm").validate({
    rules: {
        roldescripcion: {
            required: true,
        },
    },
    messages: {
        roldescripcion: {
            required: "Obligatorio",
        },
    },
    errorPlacement: function(error, element) {
        let id = "#feedback-" + element.attr("id");
        element.addClass("is-invalid");

        $(id).text(error[0].innerText);
    },
    highlight: function(element) {
        $(element).removeClass("is-valid").addClass("is-invalid");
    },
    unhighlight: function(element) {
        $(element).removeClass("is-invalid").addClass("is-valid");
    },
    success: function(element) {
        $(element).addClass("is-valid");
    },
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
    $("#roldescripcion").removeClass("is-invalid").removeClass("is-valid");
    $("#permisos").removeClass("is-invalid").removeClass("is-valid");
    var arreglo = $(".permisos");
    for (var i = 0; i < arreglo.length; i++) {
        arreglo[i].removeAttribute("checked");
    }
}

function newMenu() {
    $("#title").html("Nuevo");
    $("#dlg").modal("show");

    limpiar();

    $("#btn-submit").html("Agregar");
    $("#btn-submit").removeClass("btn-danger").addClass("btn-primary");

    url = "accion/altaRol.php";
}

function editMenu() {
    $("#tabla tbody").on("click", "button", function() {
        var data = $("#tabla").DataTable().row($(this).parents("tr")).data();

        if (data != null) {
            $("#title").html("Editar");
            $("#dlg").modal("show");
            limpiar();

            var arreglo = $(".permisos");
            for (var i = 0; i < arreglo.length; i++) {
                if ($("#" + data["id"] + "-" + arreglo[i].value).length != 0) {
                    arreglo[i].setAttribute("checked", "true");
                }
            }

            $("#btn-submit").html("Editar");
            $("#btn-submit").removeClass("btn-danger").addClass("btn-primary");

            $("#id").val(data["id"]);
            $("#roldescripcion").val(data["roldescripcion"]);

            url = "accion/modificarRol.php";
        }
    });
}