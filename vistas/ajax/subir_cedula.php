<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conectar a la base de datos
   require_once "../db.php";
    require_once "../php_conexion.php";
   
$id_usuario= $_POST['id_usuario'];
    // Verificar si se ha subido un archivo
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $uploadFileDir = '../../documentos/';
        $dest_path = $uploadFileDir . $fileName;

        // Comprobar si el directorio existe, sino crear
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        // Mover el archivo a la ubicación deseada
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Actualizar la base de datos
          $sql = "UPDATE users SET  url_cedula_ruc='" . $dest_path . "'
                            WHERE id_users='" . $id_usuario . "'";
    echo $sql;
    $query_update = mysqli_query($conexion, $sql);
    
        } else {
            echo "Hubo un error al mover el archivo a la ubicación deseada.";
        }
    } else {
        echo "No se subió ningún archivo o hubo un error al subir.";
    }

  //  $conn->close();
}
?>
