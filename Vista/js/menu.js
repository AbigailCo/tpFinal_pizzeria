var url;

$(document).ready(function () {
	var table = $("#tabla").DataTable({
		responsive: true,
		ajax: {
			url: "accion/listarMenu.php",
			dataSrc: "",
		},
		columns: [
			{
				data: "id",
			},
			{
				data: "nombre",
			},
			{
				data: "descripcion",
			},
			{
				data: "padre",
			},
			{
				data: "accion",
			},
		],
	});
});

$("#form-abm").validate({
	rules: {
		nombre: {
			required: true,
		},
		descripcion: {
			required: true,
		},
	},
	messages: {
		nombre: {
			required: "Obligatorio",
		},
		descripcion: {
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
			url: url,
			type: "POST",
			data: $("#form-abm").serialize(),
			beforeSend: function(){
                $("#btn-submit").html('<span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span>Cargando...');
                },
			complete: function(){
				$("#btn-submit").html("Reintentar")
			},
			success: function (result) {
				$("#dlg").modal("hide");
				$("#form-abm").trigger("reset");
				recargar();
			},
		});
	},
});

function cargarSelectPadre() {
	var ids = $("#tabla").DataTable().column(0).data();
	var nombres = $("#tabla").DataTable().column(1).data();
	var html = '<option value="" selected>Seleccione uno</option>';

	for (var i = 0; i < ids.length; i++) {
		html += '<option value="' + ids[i] + '">' + nombres[i] + "</option>";
	}
	$("#idpadre").html(html);
}

function recargar() {
	$("#tabla").DataTable().ajax.reload();
}

function limpiar() {
	$("#form-abm").trigger("reset");
	$("#nombre").removeClass("is-invalid").removeClass("is-valid");
	$("#descripcion").removeClass("is-invalid").removeClass("is-valid");
}

function newMenu() {
	cargarSelectPadre();
	$("#title").html("Nuevo");
	$("#dlg").modal("show");

	limpiar();

	$("#delete-form").hide();
	$("#edit-form").show();

	$("#btn-submit").val("Agregar");
	$("#btn-submit").removeClass("btn-danger").addClass("btn-primary");

	url = "accion/altaMenu.php";
}

function editMenu() {
	cargarSelectPadre();
	$("#tabla tbody").on("click", "button", function () {
		var data = $("#tabla").DataTable().row($(this).parents("tr")).data();

		if (data != null) {
			$("#title").html("Editar");
			$("#dlg").modal("show");

			limpiar();

			$("#delete-form").hide();
			$("#edit-form").show();

			$("#btn-submit").val("Editar");
			$("#btn-submit").removeClass("btn-danger").addClass("btn-primary");

			$("#id").val(data["id"]);
			$("#nombre").val(data["nombre"]);
			$("#descripcion").val(data["descripcion"]);

			url = "accion/modificarMenu.php";
		}
	});
}

function destroyMenu() {
	$("#tabla tbody").on("click", "button", function () {
		var data = $("#tabla").DataTable().row($(this).parents("tr")).data();

		if (data != null) {
			$("#title").html("Eliminar");
			$("#dlg").modal("show");

			limpiar();

			$("#edit-form").hide();
			$("#delete-form").show();
			$("#menu-name").text(data.nombre);
			$("#btn-submit").val("Eliminar");
			$("#btn-submit").removeClass("btn-primary").addClass("btn-danger");

			$("#id").val(data["id"]);
			$("#nombre").val(data["nombre"]);
			$("#descripcion").val(data["descripcion"]);

			url = "accion/eliminarMenu.php";
		}
	});
}
