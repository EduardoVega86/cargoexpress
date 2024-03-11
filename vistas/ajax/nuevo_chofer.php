<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once "../libraries/password_compatibility_library.php";
}
if (empty($_POST['empresa'])) {
    $errors[] = "Socio";
} elseif (empty($_POST['lastname'])) {
    $errors[] = "Apellidos vacíos";
} elseif (empty($_POST['user_email'])) {
    $errors[] = "El correo electrónico no puede estar vacío";
} elseif (strlen($_POST['user_email']) > 64) {
    $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
} elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
} elseif (
     !empty($_POST['empresa'])
    && !empty($_POST['lastname'])
    && !empty($_POST['user_email'])
    && strlen($_POST['user_email']) <= 64
    && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)

) {
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $firstname     = '';
    $lastname      = mysqli_real_escape_string($conexion, (strip_tags($_POST["lastname"], ENT_QUOTES)));
    //$identificacion     = mysqli_real_escape_string($conexion, (strip_tags($_POST["identificacion"], ENT_QUOTES)));
     $user_name     = mysqli_real_escape_string($conexion, (strip_tags($_POST["user_name"], ENT_QUOTES)));
    $genero    = '';
    $estadocivil     = '';
    @$identificacion     = mysqli_real_escape_string($conexion, (strip_tags($_POST["identificacion"], ENT_QUOTES)));
    $telefono     ='';
    $direccion     = '';
    $empresa     = mysqli_real_escape_string($conexion, (strip_tags($_POST["empresa"], ENT_QUOTES)));
    
    $user_email    = mysqli_real_escape_string($conexion, (strip_tags($_POST["user_email"], ENT_QUOTES)));
    $user_group_id = 8;
    $sucursal      = 1;
    $user_password = "";
    $date_added    = date("Y-m-d H:i:s");
    //$user_name=$identificacion;
    $user_password = $_POST['user_password_neww'];
    // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
    // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
    // PHP 5.3/5.4, by the password hashing compatibility library
    $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

    // check if user or email address already exists
    $sql                   = "SELECT * FROM users WHERE usuario_users='$user_name' || email_users = '" . $user_email . "';";
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == 1) {
        $errors[] = "Lo sentimos , la nombre de usuario ya está en uso.";
    } else {
        // write new user's data into database
        $sql = "INSERT INTO users (nombre_users, apellido_users, usuario_users, con_users, email_users, cargo_users, sucursal_users, date_added, genero, estado_civil, telefono, direccion, id_padre, identificacion)
        VALUES('" . $firstname . "','" . $lastname . "','" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "', '" . $user_group_id . "','" . $sucursal . "','" . $date_added . "','" . $genero . "','" . $estadocivil . "','" . $telefono . "','" . $direccion . "'," . $empresa . ",'" . $identificacion . "');";
        $query_new_user_insert = mysqli_query($conexion, $sql);
//echo $sql;
        // if user has been added successfully
        if ($query_new_user_insert) {
            $messages[] = "La cuenta ha sido creada con éxito.";
        } else {
            $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
        }
    }

} else {
    $errors[] = "Un error desconocido ocurrió.";
}

if (isset($errors)) {

    ?>
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong>
        <?php
foreach ($errors as $error) {
        echo $error;
    }
    ?>
    </div>
    <?php
}
if (isset($messages)) {

    ?>
    <div class="alert alert-success" role="alert">
        <strong>¡Bien hecho!</strong>
        <?php
foreach ($messages as $message) {
        echo $message;
    }
    ?>
    </div>
    <?php
}

?>