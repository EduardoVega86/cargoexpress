<!DOCTYPE html>
<html>
<head>
  <title>Mapa con Autocompletado y Coordenadas</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&libraries=places"></script>
</head>
<body>
  <input id="direccion" type="text" placeholder="Ingresa una dirección">
  <div id="mapa" style="height: 400px;"></div>

  <script>
    // Inicializar el mapa
    function initMap() {
      var map = new google.maps.Map(document.getElementById('mapa'), {
        center: {lat: 0, lng: 0},
        zoom: 12
      });

      // Autocompletado de direcciones
      var input = document.getElementById('direccion');
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);

      // Al seleccionar una dirección, centrar el mapa en esa ubicación
      autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
          window.alert("No se encontraron detalles de la dirección: '" + place.name + "'");
          return;
        }

        map.setCenter(place.geometry.location);
        map.setZoom(15);
      });

      // Obtener latitud y longitud al hacer clic en el mapa
      map.addListener('click', function(event) {
        var latitud = event.latLng.lat();
        var longitud = event.latLng.lng();
        console.log("Latitud: " + latitud + ", Longitud: " + longitud);
        // Aquí puedes hacer lo que necesites con las coordenadas
        // Por ejemplo, podrías mostrarlas en un elemento HTML
      });
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGulcdBtz_Mydtmu432GtzJz82J_yb-rs&libraries=places&callback=initMap"></script>
</body>
</html>
