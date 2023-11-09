$("#busqueda").validate({
    rules: {
        q:{
            required: true,
        },
    },
    messages:{
        q: {
            required: "",
        },
    },
    errorPlacement: function(error, element){
        $("#error").html(error[0].innerText);
    }
});