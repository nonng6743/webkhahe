<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" type="text/css" href="./components/googlemap/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATSEBp-3BMGJh4j5Cpdk1XrP1Q_kcoOkk&callback=initMap&libraries=&v=weekly" async></script>
  <script language="JavaScript">
    function initMap() {
      var myOptions = {
        zoom: 20,
        center: new google.maps.LatLng(14.0284929, 100.7295797),
      };
      var map = new google.maps.Map(document.getElementById('map_canvas'),
        myOptions);
      var marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(14.0284929, 100.7295797),
        draggalbe: true
      });
      var infowindow = new google.maps.InfoWindow({
        map: map,
        content: "ตลาดเคหะคลอง 6",
        position: new google.maps.LatLng(14.0284929, 100.7295797),
      });
      google.maps.event.addListener(map, 'click', function(event) {
        infowindow.open(map, marker);
        infowindow.setContent("LatLng = " + event.latLng);
        infowindow.setPosition(event.latLng);
        marker.setPosition(event.latLng);
        $("#lat").val(event.latLng.lat());
        $("#lng").val(event.latLng.lng());
      });
    }
  </script>
</head>
<body>
  <div class="card card-cascade narrower">
    <div class="alert alert-primary" role="alert">
      ระบุตำเเหน่งร้านค้าของคุณ
    </div>
    <div class="card-body card-body-cascade text-center">
      <div id="map_canvas" class="z-depth-1-half map-container-5" style="height: 300px">
      </div>
    </div>
  </div>
</body>
</html>