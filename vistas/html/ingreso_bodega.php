<!DOCTYPE html>
<html>
<head>
  <title>Buscar dirección en Google Maps</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGulcdBtz_Mydtmu432GtzJz82J_yb-rs"></script>
  <script>
    let map;
    let geocoder;

    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 0, lng: 0}, // Centrado en el océano (coordenadas iniciales)
        zoom: 12
      });

      geocoder = new google.maps.Geocoder();
    }

    function codeAddress() {
      const address = document.getElementById('address').value;

      geocoder.geocode({ 'address': address }, function(results, status) {
        if (status === 'OK') {
          map.setCenter(results[0].geometry.location);

          const marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
          });
        } else {
          alert('La geocodificación no tuvo éxito debido a: ' + status);
        }
      });
    }
  </script>
</head>
<body>
  <input id="address" type="text" placeholder="Ingresa una dirección">
  <button onclick="codeAddress()">Buscar dirección</button>
  <div id="map" style="height: 400px; width: 100%;"></div>

  <script>
    // Cargar el mapa una vez que la página esté lista
    google.maps.event.addDomListener(window, 'load', initMap);
  </script>
</body>
</html>