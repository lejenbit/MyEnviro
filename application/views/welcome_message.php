<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
//ipinfo grabs the ip of the person requesting

$getloc = json_decode(file_get_contents("http://ipinfo.io/"));

//echo $getloc->city; //to get city

$coordinates = explode(",", $getloc->loc); // -> '32,-72' becomes'32','-72'
//echo $coordinates[0]; // latitude
//echo $coordinates[1]; // longitude

$longlat = $coordinates[1] . ', ' . $coordinates[0];
?>

<!-- <h1>PORTAL INFORMASI ALAM SEKITAR</h1> -->

<div id="body">

    <!-- <p>your IP - <?= $getloc->ip ?></p>
    <p>your City - <?= $getloc->city ?></p>
    <p>your Longitude/Latitude   - <?= $longlat?></p> -->
    <!-- <div id="map" class="map"></div> -->
    <p id="details">
        
    </p>
    <div id="popup" class="ol-popup">
     <a href="#" id="popup-closer" class="ol-popup-closer"></a>
     <div id="popup-content"></div>
    </div>

    <p>
    <iframe src="http://localhost/viewer1" style="border:none;" width="100%" height="500px"></iframe>
    </p>
    <!-- <p>If you would like to edit this page you'll find it located at:</p>
    <code>application/views/welcome_message.php</code>

    <p>The corresponding controller for this page is found at:</p>
    <code>application/controllers/Welcome.php</code>

    <p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p> -->
</div>

<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. </p>
<script type="text/javascript">
    
    
      var map = new ol.Map({
        target: 'map',
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          })
        ],
        view: new ol.View({
          //center: ol.proj.fromLonLat([37.41, 8.82]),
          center: ol.proj.fromLonLat([<?= $longlat?>]),
          zoom: 10
        })
      });
      
      var layer = new ol.layer.Vector({
     source: new ol.source.Vector({
         features: [
             new ol.Feature({
                 geometry: new ol.geom.Point(ol.proj.fromLonLat([4.35247, 50.84673]))   
             }),
             new ol.Feature({
                 geometry: new ol.geom.Point(ol.proj.fromLonLat([101.7340499, 3.1478947]))   
             }),
             new ol.Feature({
                 geometry: new ol.geom.Point(ol.proj.fromLonLat([101.569126, 3.268596]))   
             }),
         ]
     })
 });

 map.addLayer(layer);
 
 
 var container = document.getElementById('popup');
 var content = document.getElementById('popup-content');
 var closer = document.getElementById('popup-closer');

 var overlay = new ol.Overlay({
     element: container,
     autoPan: true,
     autoPanAnimation: {
         duration: 250
     }
 });
 

 closer.onclick = function() {
     overlay.setPosition(undefined);
     closer.blur();
     return false;
 };
 
 map.on('singleclick', function (event) {
     if (map.hasFeatureAtPixel(event.pixel) === true) {
         var coordinate = event.coordinate;

         content.innerHTML = '<b>Hello world!</b><br />I am a popup.';
         overlay.setPosition(coordinate);
     } else {
         overlay.setPosition(undefined);
         closer.blur();
     }
 });
 
  content.innerHTML = '<b>Hello world!</b><br />I am a popup.';
 overlay.setPosition(ol.proj.fromLonLat([101.7340499, 3.1478947]));
 
 map.addOverlay(overlay);

 function updateDisplay($html)
 {

    return document.getElementById('details').html($html);
 }
 
 $(document).ready(function () {
        $.ajax({
                    url: '<?= base_url('index.php/welcome/return_gap')?>', type: "GET", dataType: "json",
                    success: function (data) {

                        $.each(data, function(index){
                            console.log(data[index].company_name);
                            console.log(data[index].type_operation);
                        });
                        console.log(data);
                        // content = "<h3>Company Details</h3>";
                        // content += "<dl class=\"dl-horizontal\">";
                        // content += "<dt>Company Name</dt><dd>" + data.company_name + "</dd>";
                        // content += "<dt>Type</dt><dd>" + data.LastName + "</dd>";
                        // content += "<dt>Address1</dt><dd>" + data.Address1 + "</dd>";
                        // content += "<dt>Address2</dt><dd>" + data.Address2 + "</dd>";
                        // content += "<dt>City</dt><dd>" + data.City + "</dd>";
                        // content += "<dt>State</dt><dd>" + data.State + "</dd>";
                        // content += "<dt>Country </dt><dd>" + data.Country + "</dd>";
                        // content += "<dt>PostalCode</dt><dd>" + data.PostalCode + "</dd>";
                        // content += "<dt>Email </dt><dd>" + data.Email + "</dd>";
                        // content += "<dt>DOB </dt><dd>" + data.DOB + "</dd>";
                        // content += "<dt>Gender </dt><dd>" + data.Gender + "</dd>";
                        // content += "<dt>IsPermanent </dt><dd>" + data.IsPermanent + "</dd>";
                        // content += "<dt>Salary </dt><dd>" + data.Salary + "</dd>";
                        // content += " </dl>";
                        //$('#details').html(content);
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                        alert(status);
                        alert(error);                        
                    }
                });
        
    });
    </script>