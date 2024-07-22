		$(document).ready(function() {
		    load_tarifas(1);
		});

		function load_tarifas(page) {
                     var id = $('#id_usuario').val();

    $.ajax({
        type: 'POST',
        url: '../ajax/buscar_tarifas.php', // Reemplaza con la URL de tu archivo PHP que procesará la solicitud
        data: { id: id },
        success: function(response) {
            // Maneja la respuesta del servidor aquí
           // alert(response)
             $("#tarifas").html(response);
          
           
        },
        error: function(xhr, status, error) {
            // Maneja los errores aquí
            console.error(xhr.responseText);
        }
    });
		}
                
                
                // Función para actualizar la tarifa
    $(document).on('blur', '.tarifa-input', function() {
        var id = $(this).data('id');
        var field = $(this).data('field');
        var value = $(this).val();

        $.ajax({
            type: 'POST',
            url: '../ajax/actualizar_tarifa.php',
            data: { id: id, field: field, value: value },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
    
		$("#guardar_usuario").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/nuevo_usuario.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax").html(datos);
		            $('#guardar_datos').attr("disabled", false);
		            load(1);
		            //resetea el formulario
		            $("#guardar_usuario")[0].reset();
		            $("#firstname").focus();
		            //desaparecer la alerta
		            window.setTimeout(function() {
		                $(".alert").fadeTo(200, 0).slideUp(200, function() {
		                    $(this).remove();
		                });
		            }, 2000);
		        }
		    });
		    event.preventDefault();
		})
		$("#editar_usuario").submit(function(event) {
		    $('#actualizar_datos2').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/editar_usuario.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax2").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax2").html(datos);
		            $('#actualizar_datos2').attr("disabled", false);
		            load(1);
		            //desaparecer la alerta
		            window.setTimeout(function() {
		                $(".alert").fadeTo(200, 0).slideUp(200, function() {
		                    $(this).remove();
		                });
		            }, 2000);
		        }
		    });
		    event.preventDefault();
		})
		$("#editar_password").submit(function(event) {
		    $('#actualizar_datos3').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/editar_password.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax3").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax3").html(datos);
		            $('#actualizar_datos3').attr("disabled", false);
		            load(1);
		            //resetea el formulario
		            $("#editar_password")[0].reset();
		            //desaparecer la alerta
		            window.setTimeout(function() {
		                $(".alert").fadeTo(200, 0).slideUp(200, function() {
		                    $(this).remove();
		                });
		            }, 2000);
		        }
		    });
		    event.preventDefault();
		})
		$('#dataDelete').on('show.bs.modal', function(event) {
		    var button = $(event.relatedTarget) // Botón que activó el modal
		    var id = button.data('id') // Extraer la información de atributos de datos
		    var modal = $(this)
		    modal.find('#id_usuario').val(id)
		})
		$("#eliminarDatos").submit(function(event) {
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/eliminar_usuario.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $(".datos_ajax_delete").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $(".datos_ajax_delete").html(datos);
		            $('#dataDelete').modal('hide');
		            load(1);
		            window.setTimeout(function() {
		                $(".alert").fadeTo(200, 0).slideUp(200, function() {
		                    $(this).remove();
		                });
		            }, 2000);
		        }
		    });
		    event.preventDefault();
		});

		function get_user_id(id) {
		    $("#user_id_mod").val(id);
		}

		function obtener_datos(id) {
		    var nombres = $("#nombres" + id).val();
		    var apellidos = $("#apellidos" + id).val();
		    var usuario = $("#usuario" + id).val();
		    var email = $("#email" + id).val();
		    var cargo = $("#cargo" + id).val();
		    var sucursal = $("#sucursal" + id).val();
		    $("#mod_id").val(id);
		    $("#firstname2").val(nombres);
		    $("#lastname2").val(apellidos);
		    $("#user_name2").val(usuario);
		    $("#user_email2").val(email);
		    $("#user_group_id2").val(cargo);
		    $("#sucursal2").val(sucursal);
		}
		