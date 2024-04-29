<!DOCTYPE html>
<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once "vistas/libraries/password_compatibility_library.php";
}

// include the configs / constants for the database connection
require_once "vistas/db.php";

// load the login class
require_once "classes/Login.php";

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
 //   echo 'asd';
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    if ($_SESSION['cargo_users']==1){
        
    
    header("location: vistas/html/principal.php");
    }else{
      header("location: vistas/html/principal.php");  
    }
        

} else {
    // echo 'asd';
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    ?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cargo Express</title>
    <link href="assets/css/fonts/material-icon/css/material-design-iconic-font.min.css" rel="stylesheet" type="text/css"/>
    
    <link href="assets/css/style_1.css" rel="stylesheet" type="text/css"/>
    
    <meta name="robots" content="noindex, follow">

  <style>
    .main {
  background-image: url('images/fondo.jpg'); /* Reemplaza 'ruta/a/la/imagen.jpg' con la ubicación de tu imagen de fondo */
  background-size: cover; /* Ajusta el tamaño de la imagen para que cubra todo el fondo */
  background-repeat: no-repeat; /* Evita que la imagen se repita */
  background-attachment: fixed; /* Mantiene la imagen fija en su lugar mientras se desplaza la página */
}
.invalid-feedback{
    color:red;
}
.container {
  opacity: 0.9;
}
  </style> 
</head>

<body>


    <div class="main">

        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Ingreso al sistema</h2>
                        
                        <form method="post" accept-charset="utf-8" action="login.php" name="loginform" class="form-signin">
                           <?php
// show potential errors / feedback (from login object)
    if (isset($login)) {
        if ($login->errors) {
            ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>Error!</strong>

                            <?php
foreach ($login->errors as $error) {
                echo $error;
            }
            ?>
                        </div>
                        <?php
}
        if ($login->messages) {
            ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong>Aviso!</strong>
                            <?php
foreach ($login->messages as $message) {
                echo $message;
            }
            ?>
                        </div>
                        <?php
}
    }
    ?>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="usuario_users" class="form-control" 
                                      
                                value="" placeholder="Usuario" autofocus>
                        

                            </div>
                           
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                     
                            <div class="form-group">
                                <label for="apellido"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="password" name="con_users" class="form-control"
                                placeholder="Password">
                        

                            </div>
                           
                          
                        
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>Recordar</a></label>
                            </div>
                            <div class="form-group form-button">
                                <button type="submit" name="login" id="submit"  class="form-submit btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}""
                                    value="Register" > INGRESAR </button>
                                
                            </div>
                        </form> 
                    </div>
                    <div class="signup-image">
                    
                        <figure><img src="images/cargo.jpg" alt="sing up image"></figure>
                        <a href="register" class="signup-image-link">Registrarme</a>
                    </div>
                </div>
            </div>
        </section>


    </div>
    <script src="js/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery/main.js" type="text/javascript"></script>
    

</body>

</html>
    <?php
}