<?php foreach ($list as $record): ?>
     <?php if (strcmp($record->district, $current_district) == 0): ?>
      <?php $x = explode(',', $record->coord); ?>
         <tr>
           <td> <?php echo $record->address; ?> </td>
           <td> <?php echo $record->work_range; ?> </td>
           <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mapid">Show on map</button>
           <?php $coords = explode(',', $record->coord);?>
           </td>
        </tr>

     <?php endif; ?>
    <?php endforeach; ?>


<script type="text/javascript">
    jQuery(function($) {
        var script = document.createElement('script');
        script.src = "//maps.googleapis.com/maps/api/js?key=AIzaSyD6V6wudIvorrqnLMPPxoHv8hnM0BDFkcg&callback=initialize";
        document.body.appendChild(script);
    });

    function initialize() {
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap'
        };

        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        map.setTilt(45);

        var markers = [
            ['<?php echo $record->address;?>', <?php echo $coords[0];?>, <?php echo $coords[1];?>]
        ];