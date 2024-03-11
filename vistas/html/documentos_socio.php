<?php
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Documentacion Socio";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$title    = "Documentacion Socio";
$Usuarios = 1;

?>
<?php require 'includes/header_start.php';?>

<?php require 'includes/header_end.php';?>

<!-- Begin page -->
<div id="wrapper">

	<?php require 'includes/menu.php';?>

	<!-- ============================================================== -->
	<!-- Start right Content here -->
	<!-- ============================================================== -->
	<div class="content-page">
		<!-- Start content -->
		<div class="content">
			<div class="container">
				<?php if ($permisos_ver == 1) {
    ?>
					<div class="container">
    <h1>Información general del socio</h1>
    <form>
      <div class="row">
        <!-- Primera columna -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="campo1">Nombres</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo get_row('users', 'nombre_users', 'id_users', $user_id); ?>">
          </div>
          
        </div>
        <!-- Segunda columna -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="campo4">Apellidos</label>
            <input type="text" class="form-control" id="apellido" name="apellido"  value="<?php echo get_row('users', 'apellido_users', 'id_users', $user_id); ?>">
          </div>
          
        </div>
        <!-- Tercera columna -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="campo7">Cedula</label>
            <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?php echo get_row('users', 'identificacion', 'id_users', $user_id); ?>">
          </div>
          
        </div>
      </div>
        
        <div class="row">
        <!-- Primera columna -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="campo1">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo get_row('users', 'direccion', 'id_users', $user_id); ?>">
          </div>
          
        </div>
        <!-- Segunda columna -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="campo4">Telefono</label>
            <input type="text" class="form-control" id="telefono" name="telefono"  value="<?php echo get_row('users', 'telefono', 'id_users', $user_id); ?>">
          </div>
          
        </div>
        <!-- Tercera columna -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="campo7">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo get_row('users', 'email_users', 'id_users', $user_id); ?>">
          </div>
          
        </div>
      </div>
         <div class="row">
        <!-- Primera columna -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="campo1">Estado Civil</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo get_row('users', 'estado_civil', 'id_users', $user_id); ?>">
          </div>
          
        </div>
        <!-- Segunda columna -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="campo4">Genero</label>
            <input type="text" class="form-control" id="telefono" name="telefono"  value="<?php echo get_row('users', 'genero', 'id_users', $user_id); ?>">
          </div>
          
        </div>
        <!-- Tercera columna -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="campo7">Cedula</label>
            <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?php echo get_row('users', 'identificacion', 'id_users', $user_id); ?>">
          </div>
          
        </div>
      </div>
        
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>
                            
						<?php
} else {
    ?>
						<section class="content">
							<div class="alert alert-danger" align="center">
								<h3>Acceso denegado! </h3>
								<p>No cuentas con los permisos necesario para acceder a este módulo.</p>
							</div>
						</section>
						<?php
}
?>
				</div>
				<!-- end container -->
			</div>
			<!-- end content -->

			<?php require 'includes/pie.php';?>

		</div>
		<!-- ============================================================== -->
		<!-- End Right content here -->
		<!-- ============================================================== -->


	</div>
	<!-- END wrapper -->

	<?php require 'includes/footer_start.php'
?>
	<!-- ============================================================== -->
	<!-- Todo el codigo js aqui
	<!-- ============================================================== -->
	<script type="text/javascript" src="../../js/verificacion_socios.js"></script>
	<script>
                
		function editar_pw(user_id) {
			$(".outer_div3").load("../modal/password.php?user_id=" + user_id);
		}
	</script>
	<script>
		$(document).ready( function () {
			$(".UpperCase").on("keypress", function () {
				$input=$(this);
				setTimeout(function () {
					$input.val($input.val().toUpperCase());
				},50);
			})
		})
        function upload_image(id, id_usuario){
			//$("#load_img").text('Cargando...');
                        input="imagefile"+id
                        alert(input);
			var inputFileImage = document.getElementById(input);
			var file = inputFileImage.files[0];
			var data = new FormData();
			data.append('imagefile',file);
                        data.append('id',id);
                         data.append('id_usuario',id_usuario);



			$.ajax({
					url: "../ajax/cargar_docu_socio.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						
camion(id_usuario);
					}
				});

		}
	</script>
	<?php require 'includes/footer_end.php'
?>

