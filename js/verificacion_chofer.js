		$(document).ready(function() {
		    load(1);
		});

		function load(page) {
		    var q = $("#q").val();
		    $("#loader").fadeIn('slow');
		    $.ajax({
		        url: '../ajax/buscar_verificar_chofer.php?action=ajax&page=' + page + '&q=' + q,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $(".outer_div").html(data).fadeIn('slow');
		            $('#loader').html('');
		        }
		    })
		}
                
                function documentos(id){
                        alert();
                        fila='#camion'+id
                        page=1;
                        $("#camionseleccionado").val(id);
                        id_camion= $("#camionseleccionado").val();
                        id_usuario= $("#usuarioseleccionado").val();
                       // alert(id_camion)
                        // var q = $("#q2").val();
                        $('#camiones tr').css('background-color', '');
                        $(fila).css('background-color', 'lightblue');
                        
                         $.ajax({
		        url: '../ajax/buscar_documentos.php?action=ajax&page=' + page + '&id_camion=' + id_camion+ '&id_usuario=' + id_usuario,
		        beforeSend: function(objeto) {
		          $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            //$(".outer_div3").html(data).fadeIn('slow');
		            $('#loader').html('');
		        }
		    })
                   
                }
                
                 function activacion(id){
                       // alert();
                        fila='#camion'+id
                        page=1;
                        $("#camionseleccionado").val(id);
                        id_camion= $("#camionseleccionado").val();
                        id_usuario= $("#usuarioseleccionado").val();
                       // alert(id_camion)
                        // var q = $("#q2").val();
                        $('#camiones tr').css('background-color', '');
                        $(fila).css('background-color', 'lightblue');
                        
                         $.ajax({
		        url: '../ajax/buscar_activacion_chofer.php?action=ajax&page=' + page + '&id_camion=' + id_camion+ '&id_usuario=' + id_usuario,
		        beforeSend: function(objeto) {
		          $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $(".outer_div3").html(data).fadeIn('slow');
		            $('#loader').html('');
		        }
		    })
                   
                }
                function cargarDocumento(id,id_usuario){
                        //aalert();
                      
                        
                         $.ajax({
		        url: '../ajax/cargar_documento_socio.php?action=ajax&id=' + id + '&id_usuario=' + id_usuario,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		       camion(id_usuario)                         
		           
		        }
		    })
                   
                }
                    function chofer(id){
                       // alert();
                        fila='#solicitud'+id
                        page=1;
                        $("#usuarioseleccionado").val(id);
                        $("#usuariocamion").val(id);
                        
                        id= $("#usuarioseleccionado").val();
                        
                         var q = $("#q2").val();
                        $('#solicitudes tr').css('background-color', '');
                        $(fila).css('background-color', 'lightblue');
                        
                         $.ajax({
		        url: '../ajax/buscar_documentos_chofer.php?action=ajax&page=' + page + '&id_usuario=' + id,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $(".outer_div2").html(data).fadeIn('slow');
                              $(".outer_div3").html('').fadeIn('slow');
		            $('#loader').html('');
		        }
		    })
                   
                }
                function camionq(){
                        
                       
                        
                        id= $("#usuarioseleccionado").val();
                        
                         var q = $("#q2").val();
                        $('#camiones tr').css('background-color', '');
                        $(fila).css('background-color', 'lightblue');
                        
                         $.ajax({
		        url: '../ajax/buscar_documentos_socio.php?action=ajax&page=' + page + '&q=' + q+ '&id=' + id,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $(".outer_div2").html(data).fadeIn('slow');
		            $('#loader').html('');
		        }
		    })
                   
                }
                
                $("#guardar_camion").submit(function(event) {
		    $('#guardar_datos_camion').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/nuevo_chofer.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax2").html(datos);
		            $('#guardar_datos_camion').attr("disabled", false);
		            camion(1);
		            //resetea el formulario
		            //$("#guardar_usuario")[0].reset();
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
                
		$("#guardar_usuario").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/nuevo_chofer.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax").html(datos);
		            $('#guardar_datos').attr("disabled", false);
		            load(1);
		            //resetea el formulario
		            //$("#guardar_usuario")[0].reset();
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
                $("#editar_camion").submit(function(event) {
		    $('#editar_datos_camion').attr("disabled", true);
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
		    //var cargo = $("#cargo" + id).val();
		    //var sucursal = $("#sucursal" + id).val();
                    var genero = $("#genero" + id).val();
                    var estado_civil = $("#estado_civil" + id).val();
                    var identificacion = $("#identificacion" + id).val();
                    var telefono = $("#telefono" + id).val();
                    var id_vendedor = $("#id_vendedor" + id).val();
                     var direccion = $("#direccion" + id).val();
                   // alert(identificacion)
		    $("#mod_id").val(id);
		    $("#firstname2").val(nombres);
		    $("#lastname2").val(apellidos);
		    $("#user_name2").val(usuario);
		    $("#user_email2").val(email);
                    $("#genero2").val(genero);
                    $("#identificacion2").val(identificacion);
                    $("#estadocivil2").val(estado_civil);
                    $("#telefono2").val(telefono);
                    $("#asesor2").val(id_vendedor);
                     $("#direccion2").val(direccion);
		    
		    //$("#sucursal2").val(sucursal);
		}
                
                function obtener_datos_camion(id) {
		    var placa = $("#placa" + id).val();
                   // alert(placa)
		    var brand_id = $("#brand_id" + id).val();
		    var vantype_id = $("#vantype_id" + id).val();
		    var weight_id = $("#weight_id" + id).val();
		    //var cargo = $("#cargo" + id).val();
		    //var sucursal = $("#sucursal" + id).val();
                    var anio = $("#anio" + id).val();
                    var estado = $("#estado" + id).val();
                   
                   // alert(identificacion)
		    $("#mod_camion_id").val(id);
		    $("#placa2").val(placa);
		    $("#brand2").val(brand_id);
		    $("#vantype2").val(vantype_id);
		    $("#weight2").val(weight_id);
                    $("#anio2").val(anio);
                    $("#estadocamion2").val(estado);
                   
		    
		    //$("#sucursal2").val(sucursal);
		}
                
                function activarchofer2() {
                    //alert()
                    id_usuario=$("#usuarioseleccionado").val();
                   // alert(id_usuario)
                      var parametros = $(this).serialize();
		$.ajax({
    url: "../ajax/activar_usuario.php",
    type: "POST",
    data: { id_usuario: id_usuario },
    success: function(response) {
           if (response === "ok") {
              // alert();
                  Swal.fire({
                    title: "¡Activación de usuario exitosa!",
                    icon: "success",
                    confirmButtonText: "¡Aceptar!",
                  }).then(() => {
                    window.location.reload();
                  });
                }
    },
    error: function(xhr, status, error) {
        console.error("Error en la solicitud: " + error);
    }
});
                }
		