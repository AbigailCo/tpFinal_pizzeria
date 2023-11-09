$(document).ready(function () {
    $.validator.addMethod("formatoVencimiento", function (value) {
        return /^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/.test(value);
    }, "Formato MM/AA (ejemplo: 03/23)");


    $.validator.addMethod("formatoTarjeta", function (value) {
        return /^\d{16}$/.test(value);
    }, "Formato: 0000000000000000");
})
$("#form-abm").validate({
    rules: {
        nombre: {
            required: true,
        },
        apellido: {
            required: true,
        },
        direccion: {
            required: true,
        },
        titular: {
            required: true,
        },
        numero: {
            required: true,
            formatoTarjeta: true,
        },
        vencimiento: {
            required: true,
            formatoVencimiento: true,
        },
        cvv: {
            required: true,
        },
    },
    messages: {
        nombre: {
            required: "Obligatorio",
        },
        apellido: {
            required: "Obligatorio",
        },
        direccion: {
            required: "Obligatorio",
        },
        titular: {
            required: "Obligatorio",
        },
        numero: {
            required: "Obligatorio",
            pattern: "",
        },
        vencimiento: {
            required: "Obligatorio",
        },
        cvv: {
            required: "Obligatorio",
        },
    },
    errorPlacement: function (error, element) {
        let id = "#feedback-" + element.attr("id");
        element.addClass("is-invalid");

        $(id).text(error[0].innerText);
    },
    highlight: function (element) {
        $(element).removeClass("is-valid").addClass("is-invalid");
    },
    unhighlight: function (element) {
        $(element).removeClass("is-invalid").addClass("is-valid");
    },
    success: function (element) {
        $(element).addClass("is-valid");
    },
    submitHandler: function (e) {
        $.ajax({
            url: "accion/accionPago.php",
            type: "POST",
            data: $("#form-abm").serialize(),
            beforeSend: function () {
                $("#btn-submit").html(
                    '<span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span>Cargando...'
                );
            },
            complete: function () {
                $("#btn-submit").html("Realizar Pago");
            },
            success: function (result) {
                result = JSON.parse(result);

                if (result.resultado) {
                    window.location.replace("../Pedidos/index.php");
                } else {
                    $("#errores").html(mostrarError(result.errorMsg));
                }
            },
        });
    },
});