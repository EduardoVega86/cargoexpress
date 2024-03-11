
    <?php
include "is_logged.php"; //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";



//$product_id    = intval($_REQUEST['product_id']);
//$product_id    = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST["product_id"], ENT_QUOTES)));
$target_dir    = "../../documentos/";
$image_name    = time() . "_" . basename($_FILES["imagefile"]["name"]);
$target_file   = $target_dir . $image_name;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$imageFileZise = $_FILES["imagefile"]["size"];
$id_usuario = $_POST['id_usuario'];
    $id = $_POST['id'];
/* Inicio Validacion*/
// Allow certain file formats
if (($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "pdf" && $imageFileType != "jpeg" && $imageFileType != "gif") and $imageFileZise > 0) {
    $errors[] = "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PDF, PNG y GIF.</p>";
} else if ($imageFileZise > 4048576) {
//1048576 byte=1MB
    $errors[] = "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB</p>";
} else {

    /* Fin Validacion*/
    if ($imageFileZise > 0) {
        move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
        $imagen     = basename($_FILES["imagefile"]["name"]);
        $img_update = "../../documentos/$image_name ";

    } else { $img_update = "";}

     $sql                   = "SELECT * FROM docuser where user_id=$id_usuario and docrequire_id=$id ";
    //echo $sql;
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        $sql = "UPDATE `docuser` SET `estado` = '0' WHERE `docuser`.`id` = $id;  ";
               
        $query_new_insert = mysqli_query($conexion, $sql);
    } else {
        // write new user's data into database

        $sql = "INSERT INTO `docuser` (`user_id`, `docrequire_id`, `estado`, url_doc) "
                . "VALUES ( $id_usuario, $id, 1, '$img_update');";
        echo $sql;
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
           echo 'si';
        } else {
           echo 'no';
        }
    }
   

}

?>

    <?php
if (isset($errors)) {
    ?>
                                        <div class="alert alert-danger">
                                            <strong>Error! </strong>
                                            <?php
foreach ($errors as $error) {
        echo $error;
    }
    ?>
                                        </div>
                                            <?php
}
?>
                                    <?php
if (isset($messages)) {
    ?>
                                        <div class="alert alert-success">
                                            <strong>Aviso! </strong>
                                            <?php
foreach ($messages as $message) {
        echo $message;
    }
    ?>
                                        </div>
                                            <?php
}
?>