<?php 
if(isset($_POST["autourdemoi"])){

$lieu=$_POST['lieu'];
}
?> 






<!DOCTYPE html>

<html>
  <head>
    <title>Place searches</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        
        width:100%;height:400px;
      }
      /* Optional: Makes the sample page fill the window. */
     
    </style>
    

 
</script>
    
    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    var nom = '<?php echo $lieu; ?>';
      var map;
      var infowindow;

       function initMap() {
        var pyrmont = {lat: 48.866667, lng: 2.333333};

        map = new google.maps.Map(document.getElementById('map'), {
          center: pyrmont,
          zoom: 13
        });


        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: pyrmont,
          radius:10000,
          type: ['nom']
        }, callback);
      }

      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
    </script>
  </head>
  <body>

  
  
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE&libraries=places&callback=initMap" async defer></script>








<div id="autourdemoi">

<h1> Voir des lieux dans Paris </h1>




<form action = "autourdemoi3.php" method="post">
    <select name="lieu">
   <option value="cafe">Café</option>
    <option value="food">Restaurant</option>
    <option value="bar">Bar</option> 
     <option value="movie_threater">Cinema</option>
    <option value="bowling_alley">Bowling</option>
    <option value="night_club">Boite de nuit</option> 
     <option value="casino">Casino</option>
    <option value="park">Parc</option>
      </select> <br/>

<input type="submit" name="autourdemoi" value="Voir ce type de lieu dans Paris"> 

</form>
</div>










  </body>
</html>