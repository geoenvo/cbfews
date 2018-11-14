<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<style>
    #map_container{
        position: relative;
    }
    #map{
    height: 0;
    overflow: hidden;
    padding-bottom: 22.25%;
    padding-top: 30px;
    position: relative;
    }
    body{
        background: #ebeff1;
    }
</style>
<body>
    <?php
        include 'content/navbar.php';

        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center" style="font-size:12px;font-weight:bold;">
                    Last Updated : <span id="last_updated"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="padding:0px">
                    <div id="map" class="map-responsive"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php
                        $page = $_GET['page'];
                        include 'content'.'/'.$page.'.php';
                    ?>
                </div>
            </div>
        </div>




<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="../js/chartjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl52LEeNPETLGigXLHZbLQNfI_8VgVVNk"></script>
<script type="text/javascript">
var map;
var color_awlr;
var marker;
var myLatLng;

$(function(){
    var height_screen = $(window).height();
    var width_screen = $(window).width();
    console.log(height_screen+", "+width_screen);

    $("#map").css("height","300px");
    $("#map").css("width",width_screen);

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -7.6552317, lng: 112.4736113},
        animation: google.maps.Animation.DROP,
        zoom: 14
    });

   // map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true});

   //marker
   $.get( "../ajax/data_sites.php",{type:"maps"}, function( data ) {
       $.each(JSON.parse(data), function(key, value) {


           $( ".dropdown-menu" ).append('<a class="dropdown-item" href="main.php?page=sites&type=arg_mobile&site_id='+value.site_id+'">Sensor '+value.site_name+'</a>');
           //create marker gmaps
           var contentString =
           '<div id="content">'+value.site_name+'</div>';

             var infowindow = new google.maps.InfoWindow({
               content: contentString
             });


           myLatLng = {lat: value.lat, lng: value.lng};
           marker = new google.maps.Marker({
             position: myLatLng,
             map: map,
             title: value.site_name
           });

           marker['infowindow'] = new google.maps.InfoWindow({
               pixelOffset: new google.maps.Size(0,0),
               content: contentString
           });

           var markerevent = google.maps.event.addListener(marker, 'click', function() {
               this['infowindow'].open(map, this);
             });

           google.maps.event.trigger(marker, 'click');

           //create KML
           var src_sungai = 'https://monitoringku.com/kalikatir/kml/sungai.kml';
           var src_sensor = 'https://monitoringku.com/kalikatir/kml/sensor.kml';

           var kmlLayerSungai = new google.maps.KmlLayer(src_sungai, {
              suppressInfoWindows: true,
              preserveViewport: false,
              map: map
            });

            var kmlLayerSensor = new google.maps.KmlLayer(src_sensor, {
               suppressInfoWindows: true,
               preserveViewport: false,
               map: map
             });


           /*
           google.maps.event.addListener(map, "click", function (e) {
                var latLng = e.latLng;
                console.log(latLng.lat()+","+latLng.lng());
            });
            */
       });
   });

   //get last updated
   $.get( "../ajax/data_sites.php",{type:"last_updated"}, function( data ) {
     $.each(JSON.parse(data), function(key, value) {
         $("#last_updated").text(value.client_date+" UTC");
     });
   });
});
</script>
</body>
