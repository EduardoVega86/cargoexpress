<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Prueba de Servicio Web</title>
<script>
function enviarDatos() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    // Preparar los datos en formato JSON
    var datos = JSON.stringify({ usuario: email, contrasena: password });

    // Crear una solicitud XMLHttpRequest
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login_app.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parsear y mostrar la respuesta
            var respuesta = JSON.parse(xhr.responseText);
            alert("Respuesta: " + respuesta.message);
        }
    };

    // Enviar los datos
    xhr.send(datos);
}
</script>
</head>
<body>

<h2>Formulario de Prueba para Servicio Web</h2>

<label for="email">Email:</label><br>
<input type="text" id="email" name="email"><br>

<label for="password">Contrase単a:</label><br>
<input type="password" id="password" name="password"><br><br>

<button onclick="enviarDatos()">Enviar</button>

</body>
</html>
