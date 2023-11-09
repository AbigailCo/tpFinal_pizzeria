/**
 * Plantilla para mostrar un cartel de error
 * @param string $contenidoError
 * @return string
 */
 function mostrarError(contenidoError){
    return '<div class="col-12 alert alert-danger m-3 p-3 mx-auto alert-dismissible fade show" role="alert">'+
        contenidoError +
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}

$(document).ready(function(){
    $.validator.addMethod("diferentesLog", function(value, element) {
        resp = false;

        if($("#username").val() != $("#password").val()){
            resp = true;
        }

        return resp;
        }, "El usuario y la contraseña no pueden ser iguales.");
})

$('#login').validate({
    rules:{
        username: {
            required: true,
            diferentesLog: true,
        },
        password: {
            required: true,
            diferentesLog: true,
            formatoPass: true,
        },
    },
    messages:{
        username: {
            required: "Obligatorio",
            diferentesLog: "El usuario y la contraseña no pueden ser iguales.",
        },
        password: {
            required: "Obligatorio",
            diferentesLog: "El usuario y la contraseña no pueden ser iguales.",
        },
    },
    errorPlacement: function(error, element){
        let id = "#feedback-"+element.attr("id");
        element.addClass("is-invalid");

        $(id).text(error[0].innerText);
    },
    highlight: function(element) {
        $(element).removeClass('is-valid').addClass('is-invalid');
    },
    unhighlight: function(element) {
        $(element).removeClass('is-invalid').addClass('is-valid');
    },
    success: function(element) {  
        $(element).addClass('is-valid');       
    },
    submitHandler: function(e){
        $("#password").val(md5($("#password").val()));
        $.ajax({
            url: "../login-accion/verificarLogin.php",
            type: "POST",
            data: $("#login").serialize(),
            beforeSend: function(){
                $("#login-submit").html('<span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span>Cargando...');
            },
            complete: function(){
                $("#login-submit").html("Enviar")
            },
            success: function(result) {     
                result = JSON.parse(result);
                if(result.resultado){
                    location.reload();
                }else{
                    $("#login").before(mostrarError(result.error));
                    $("#password").val("");
                    $("#password").removeClass("is-valid")
                    $("#username").removeClass("is-valid")
                }
            }
        })
    }
})