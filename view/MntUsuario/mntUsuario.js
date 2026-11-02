var tabla;

function init(){
    $("#usuario_form").on("submit", function(e){
        guardaryeditar(e);
    });

    // Control para mostrar u ocultar contraseña
    $("#btnToggleClave").on("click", function(){
        var inputClave = $("#usu_clave");
        var icon = $("#iconToggleClave");

        if (inputClave.attr("type") === "password") {
            inputClave.attr("type", "text");
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            inputClave.attr("type", "password");
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
}

$(document).ready(function(){

    tabla = $('#usuario_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "ajax": {
            url: '../../controller/usuario.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "order": [[ 0, "asc" ]],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando un total de 0 registros",
            "sInfoFiltered": "(Filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "initComplete": function() {
            // Placeholder de búsqueda según el diseño de referencia
            $('.dataTables_filter input').attr("placeholder", "Ingrese nombre o sesión...");
        }
    }).DataTable();

});

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#usuario_form")[0]);

    $.ajax({
        url: "../../controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            $('#usuario_form')[0].reset();
            $("#modalmantenimiento").modal('hide');
            $('#usuario_data').DataTable().ajax.reload();

            Swal.fire({
                title: '¡Registro!',
                text: 'El usuario se guardó correctamente.',
                icon: 'success'
            });
        },
        error: function(e){
            Swal.fire({
                title: 'Error',
                text: 'Ocurrió un error al procesar la solicitud.',
                icon: 'error'
            });
        }
    });
}

function editar(usu_id){
    $.post("../../controller/usuario.php?op=mostrar", {usu_id: usu_id}, function (data) {
        data = JSON.parse(data);
        $('#usu_id').val(data.usu_id);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_sesion').val(data.usu_sesion);

        // Configuración de contraseña para edición
        $('#usu_clave').val('');
        $('#usu_clave').attr('type', 'password');
        $('#iconToggleClave').removeClass('fa-eye-slash').addClass('fa-eye');
        $('#usu_clave').removeAttr('required');
        $('#usu_clave').attr('placeholder', 'Deje en blanco si no desea cambiar');
        $('#lbl_usu_clave').html('Nueva Contraseña');
        $('#span_clave_required').hide();

        $('#mdltitulo').html('Editar Usuario');
        $('#btnGuardar').html('Actualizar');
        $('#modalmantenimiento').modal('show');
    });
}

function eliminar(usu_id){
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, elimínalo!",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../../controller/usuario.php?op=eliminar", {usu_id: usu_id}, function(data){
                $("#usuario_data").DataTable().ajax.reload();
            });

            Swal.fire({
                title: "¡Eliminado!",
                text: "El registro ha sido eliminado.",
                icon: "success"
            });
        }
    });
}

$(document).on("click", "#btnNuevo", function(){
    $("#usuario_form")[0].reset();
    $("#usu_id").val("");
    $("#usu_clave").val("");
    $("#usu_clave").attr("type", "password");
    $("#iconToggleClave").removeClass("fa-eye-slash").addClass("fa-eye");
    $("#usu_clave").attr("required", "required");
    $("#usu_clave").attr("placeholder", "Ingrese Contraseña");
    $("#lbl_usu_clave").html('Contraseña <span class="tx-danger" id="span_clave_required">*</span>');
    $("#span_clave_required").show();

    $("#mdltitulo").text("Nuevo Registro");
    $("#btnGuardar").text("Guardar");
    $("#modalmantenimiento").modal("show");
});

init();
