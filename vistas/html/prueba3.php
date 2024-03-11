<!DOCTYPE html>
<html>
<head>
  <title>Mapa con Autocompletado, Marcador y Dirección</title>
  
</head>
<body>
  <input id="direccion" type="text" placeholder="Ingresa una dirección">
  <div id="mapa" style="height: 400px;"></div>
  <div id="infoDireccion"></div>

  <script>
    // Inicializar el mapa
    function initMap() {
      var map = new google.maps.Map(document.getElementById('mapa'), {
        center: {lat: 0, lng: -78},
        zoom: 7
      });

      var geocoder = new google.maps.Geocoder();
      var infowindow = new google.maps.InfoWindow();

      // Autocompletado de direcciones
      var input = document.getElementById('direccion');
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);

      // Crear un marcador inicial
      var marker = new google.maps.Marker({
        position: {lat: 0, lng: -78},
        map: map,
        draggable: true // Hacer el marcador arrastrable
      });

      // Al seleccionar una dirección, centrar el mapa en esa ubicación y colocar el marcador
      autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
          window.alert("No se encontraron detalles de la dirección: '" + place.name + "'");
          return;
        }

        map.setCenter(place.geometry.location);
        map.setZoom(15);

        marker.setPosition(place.geometry.location);

        // Obtener la dirección mediante geocodificación inversa
        geocoder.geocode({'location': place.geometry.location}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              infowindow.setContent('Dirección: ' + results[0].formatted_address);
              infowindow.open(map, marker);
            } else {
              window.alert('No se encontraron resultados');
            }
          } else {
            window.alert('Geocoder falló debido a: ' + status);
          }
        });
      });

      // Al mover el marcador, obtener la nueva dirección
      marker.addListener('dragend', function() {
        var latlng = marker.getPosition();

        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              infowindow.setContent('Dirección: ' + results[0].formatted_address);
              infowindow.open(map, marker);
            } else {
              window.alert('No se encontraron resultados');
            }
          } else {
            window.alert('Geocoder falló debido a: ' + status);
          }
        });
      });
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGulcdBtz_Mydtmu432GtzJz82J_yb-rs&libraries=places&callback=initMap"></script>
</body>
</html>
