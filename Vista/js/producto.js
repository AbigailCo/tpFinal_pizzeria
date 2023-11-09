var url;

/**
 * Plantilla para mostrar un cartel de error
 * @param string $contenidoError
 * @return string
 */
function mostrarError(contenidoError) {
    return '<div class="col-12 alert alert-danger m-3 p-3 mx-auto alert-dismissible fade show" role="alert">' +
        contenidoError +
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}



$(document).ready(function(){
    var table = $("#tabla").DataTable({
        responsive: true,
        "ajax": {
            "url": "accion/listarProducto.php",
            "dataSrc": ""
        },
        "columns": [{
                data: "id"
            },
            {
                data: "nombre"
            },
            {
                data: "detalle"
            },
            {
                data: "precio"
            },
            {
                data: "cantstock"
            },
            {
                data: "imagen"
            },
            {
                data: "accion"
            }
        ]
    });
});

$("#form-abm").validate({
    rules: {
        nombre: {
            required: true,
        },
        detalle: {
            required: true,
        },
        cantstock: {
            required: true,
        }
    },
    messages: {
        nombre: {
            required: "Obligatorio",
        },
        detalle: {
            required: "Obligatorio",
        },
        cantstock: {
            required: "Obligatorio",
            number: "Debe ingresar un número válido",
            min: "Debe igual o mayor a 0",
        },
        imagen: {
            accept: "Formato aceptado: .jpg"
        },
        precio:{
            required: "Obligatorio",
            number: "Ingrese un número válido",
            min: "Precio mínimo: 0",
        }
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
        var formData = new FormData(document.getElementById("form-abm"));
        formData.append("dato", "valor");
        $.ajax({
            url: url,
            type: "POST",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $("#btn-submit").html('<span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span>Cargando...');
            },
            complete: function(){
                $("#btn-submit").html("Reintentar")
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
    $("#nombre").removeClass("is-invalid").removeClass("is-valid");
    $("#detalle").removeClass("is-invalid").removeClass("is-valid");
    $("#cantstock").removeClass("is-invalid").removeClass("is-valid");
    $("#precio").removeClass("is-invalid").removeClass("is-valid");
}

function newMenu() {
    $("#title").html("Nuevo");
    $("#dlg").modal("show");

    limpiar();

    $("#btn-submit").html("Agregar");
    $("#btn-submit").removeClass("btn-danger").addClass("btn-primary");

    url = "accion/altaProducto.php";
}

function editMenu() {
    $("#tabla tbody").on("click", "button", function() {
        var data = $("#tabla").DataTable().row($(this).parents("tr")).data();

        if (data != null) {
            $("#title").html("Editar");
            $("#dlg").modal("show");
            limpiar();

            $("#btn-submit").html("Editar");
            $("#btn-submit").removeClass("btn-danger").addClass("btn-primary");

            $("#id").val(data["id"]);
            $("#nombre").val(data["nombre"]);
            $("#detalle").val(data["detalle"]);
            $("#cantstock").val(data["cantstock"]);
            $("#precio").val(data["precio"]);

            url = "accion/modificarProducto.php";
        }
    });
}