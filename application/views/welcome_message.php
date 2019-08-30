<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
//ipinfo grabs the ip of the person requesting

$getloc = json_decode(file_get_contents("http://ipinfo.io/"));

echo $getloc->city; //to get city

$coordinates = explode(",", $getloc->loc); // -> '32,-72' becomes'32','-72'
echo $coordinates[0]; // latitude
echo $coordinates[1]; // longitude

$longlat = $coordinates[1] . ', ' . $coordinates[0];
?>

<h1>Welcome to CodeIgniter!</h1>

<div id="body">
    <p>your IP - <?= $_SERVER['REMOTE_ADDR'] ?></p>
    <p>your City - <?= $getloc->city ?></p>
    <p>your Longitude/Latitude   - <?= $longlat?></p>
    <p><div id="map" class="map"></div></p>
    
    <p>If you would like to edit this page you'll find it located at:</p>
    <code>application/views/welcome_message.php</code>

    <p>The corresponding controller for this page is found at:</p>
    <code>application/controllers/Welcome.php</code>

    <p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
</div>

<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
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
          zoom: 4
        })
      });
    </script>