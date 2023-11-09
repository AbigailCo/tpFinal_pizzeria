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



$(document).ready(function() {
    $.validator.addMethod("iguales", function(value) {
        resp = false;

        if ($("#pass").val() === $("#validarPass").val()) {
            resp = true;
        }

        return resp;
    }, "Las contraseñas no coinciden.");

    $.validator.addMethod("diferentes", function(value) {
        resp = false;

        if ($("#pass").val() != $("#nombre").val() && $("#passActual").val() != $("#nombre").val() ) {
            resp = true;
        }

        return resp;
    }, "La contraseña no puede ser igual al nombre de usuario.");

    $.validator.addMethod("actualDiferenteNueva", function(value) {
        resp = true;

        if ($("#pass").val() != "" && $("#pass").val() == $("#passActual").val()) {
            resp = false;
        }

        return resp;
    }, "La contraseña actual y la nueva no pueden ser iguales.");

    $.validator.addMethod("formatoPass", function(value) {
        var resp = true;

        if(value != "" && !/^(?=.*\d).{8,16}$/.test(value)){
            resp = false;
        }

        return resp;
    }, "La contraseña debe incluir entre 8 y 16 caracteres y al menos un número.");
})

$("#form-abm").validate({
    rules: {
        nombre: {
            required: true,
        },
        mail: {
            required: true,
        },
        pass: {
            formatoPass: true,
            diferentes: true,
            actualDiferenteNueva: true,
        },
        validarPass:{
            formatoPass: true,
            iguales: true,
        },
        passActual:{
            required: true,
            formatoPass: true,
            diferentes: true,
            actualDiferenteNueva: true,
        }
    },
    messages: {
        nombre: {
            required: "Obligatorio",
        },
        mail: {
            required: "Obligatorio",
            email: "Debe ingresar un correo electrónico válido",
        },
        pass: {
            required: "Obligatorio",
        },
        validarPass:{
            required: "Obligatorio",
        },
        passActual:{
            required: "Obligatorio",
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
        if ($("#pass").val() != null && $("#pass").val() != "") {
            $("#pass").val(md5($("#pass").val()))
        }
        if ($("#passActual").val() != null && $("#passActual").val() != "") {
            $("#passActual").val(md5($("#passActual").val()))
        }
        $.ajax({
            url: "accion/modificarPerfil.php",
            type: "POST",
            data: $("#form-abm").serialize(),
            beforeSend: function() {
                $("#btn-submit").html('<span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span>Cargando...');
            },
            complete: function() {
                $("#btn-submit").html("Reintentar")
            },
            success: function(result) {
                result = JSON.parse(result);

                if (result.respuesta) {
                    location.reload();
                } else {
                    $(".passwords").val("");
                    $("#errores").html(mostrarError(result.errorMsg));
                }
            },
        });
    },
});