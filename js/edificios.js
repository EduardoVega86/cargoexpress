		$(document).ready(function() {
		  //  $("#cod_resultado").load("../ajax/incrementa_cod_prod.php");
		    load(1);
		});

		function load(page) {
		    var q = $("#q").val();
		    var categoria=$("#categoria").val();
		    $("#loader").fadeIn('slow');
		    $.ajax({
		        url: '../ajax/buscar_edificio.php?action=ajax&page=' + page + '&q=' + q + '&categoria=' + categoria,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $(".outer_div").html(data).fadeIn('slow');
		            $('#loader').html('');
		        }
		    })
		}
		$("#guardar_producto").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/nuevo_edificio.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax").html(datos);
		            $('#guardar_datos').attr("disabled", false);
		            $("#cod_resultado").load("../ajax/incrementa_cod_prod.php");
		            load(1);
		            //resetea el formulario
		            $("#guardar_producto")[0].reset();
		            //desaparecer la alerta
		            window.setTimeout(function() {
		                $(".alert").fadeTo(500, 0).slideUp(500, function() {
		                    $(this).remove();
		                });
		            }, 5000);
		        }
		    });
		    event.preventDefault();
		})
		$("#editar_producto").submit(function(event) {
                    //alert();
		    $('#actualizar_datos').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/editar_edificio.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax2").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax2").html(datos);
		            $('#actualizar_datos').attr("disabled", false);
		            load(1);
		            //desaparecer la alerta
		            window.setTimeout(function() {
		                $(".alert").fadeTo(500, 0).slideUp(500, function() {
		                    $(this).remove();
		                });
		            }, 5000);
		        }
		    });
		    event.preventDefault();
		})
		$('#dataDelete').on('show.bs.modal', function(event) {
		    var button = $(event.relatedTarget) // Botón que activó el modal
		    var id = button.data('id') // Extraer la información de atributos de datos
		    var modal = $(this)
		    modal.find('#id_producto').val(id)
		})
		$("#eliminarDatos").submit(function(event) {
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/eliminar_producto.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $(".datos_ajax_delete").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $(".datos_ajax_delete").html(datos);
		            $('#dataDelete').modal('hide');
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
		});

		function obtener_datos(id) {
		  //alert(id)
		    var nombre = $("#nombre" + id).val();
		    var direccion = $("#direccion" + id).val();
		    var telefono = $("#telefono" + id).val();
		    var fecha = $("#fecha" + id).val();
		    //var med_producto = $("#med_producto" + id).val();
		   
		    $("#mod_id").val(id);
		   
		    $("#mod_nombre").val(nombre);
		    $("#mod_direccion").val(direccion);
		    $("#mod_fecha").val(fecha);
		    $("#mod_telefono").val(telefono);
		    //$("#mod_medida").val(med_producto);
		   
		}