<div id="{if isset($id)}{$id}{else}map_canvas_{$current_gmap_id}{/if}" style="width:{$width};height:{$height}" {if $class} class="{$class}"{/if}></div>
{if $current_gmap_id===1}
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
{/if}
<script type="text/javascript">
  (function() {
    var lat = {$lat};
    var lng = {$lng};
    var zoom = {$zoom};
    var markersArray = [];
    if(lat && lng) {
      var latlng = new google.maps.LatLng(lat, lng);

      var myOptions = {
        zoom: parseInt(zoom),
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      var map = new google.maps.Map(document.getElementById("{if isset($id)}{$id}{else}map_canvas_{$current_gmap_id}{/if}"), myOptions);
      var marker = new google.maps.Marker({
        position: latlng,
        map: map
      });

      google.maps.event.addListener(map, 'click', function(event) {
        deleteOverlays();
        addMarker(event.latLng);
      });

      function addMarker(location) {
        marker = new google.maps.Marker({
          position: location,
          map: map,
          draggable: true
        });
        google.maps.event.addListener(marker, 'dblclick', function(event) {
          alert('lat='+event.latLng.Ja+' lng='+event.latLng.Ka+' zoom='+this.map.zoom);
        });
        markersArray.push(marker);
      }

      // Deletes all markers in the array by removing references to them
      function deleteOverlays() {
        if (markersArray) {
          for (i in markersArray) {
            markersArray[i].setMap(null);
          }
          markersArray.length = 0;
        }
      }

    }
  })();
</script>