<HTML>
<HEAD>
<TITLE>RSS Feed</TITLE>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</HEAD>
<BODY>
<?php
$rss_feed = simplexml_load_file("https://www.rotanacareers.com/live-bookmarks/all-rss.xml");
?>
<div>
<div style='width:610'>
<table class="table table-dark">
<tbody>
<th scope="col">Job Title</th>
<th scope="col">Job Location</th>
</tr>
<?php
if(!empty($rss_feed)) {
$i=0;
foreach ($rss_feed->channel->item as $feed_item) {
    $city=implode(' ', array_slice(explode(' ', $feed_item->city), 0, 14));
    echo "<script type='text/javascript'>initMap({$city});</script>"
?>  
<tr>
<td valign="top">
<div><a class="feed_title" href="<?php echo $feed_item->link; ?>"><?php echo $feed_item->title; ?></a></div>
</td>
<td>
<div><?php echo $city; ?></div>
</td>
</tr>
<?php		
$i++;}}
?>
</tbody>
</table>
</div>
<div style='width:610'>
<div id="map"> </div>
    <script>

          function initMap(city) {
            var city = <?=json_encode($city, JSON_HEX_TAG | JSON_HEX_AMP )?>;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 5,
          center: {lat:31.9539, lng: 35.9106}
        });
        var geocoder = new google.maps.Geocoder();
		// var strArr = ['amman','irbid','aqabah','daraa','doha','dubai','zarqa','haifa','sidon'];
        // var arrayLength = strArr.length;
        // for (var i = 0; i < arrayLength; i++) {
        geocodeAddress(geocoder, map,city);
      

      function geocodeAddress(geocoder, resultsMap , city) {
        geocoder.geocode({'address':city}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
      }
    </script>
    </div>
    </div>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7loklZw8LWveVGQfw7VUGu2R3Fu4-2do&callback=initMap">
    </script>
</BODY>
</HTML>