{php}
/*
  Show google maps.
  New latitude ang longitude can be aquired by clicking on map, dragging the marker to correct position and double-clicking it.
  @param integer $lat optional
  @param integer $lng optional
  @param integer zoom optional
  @param integer|string $width optional; These are some examples how dimensions are converted: 100 = 100px; 100% = 100%; 100px = 100px;
  @param integer|string $height optional; These are some examples how dimensions are converted: 100 = 100px; 100% = 100%; 100px = 100px;

  Example:
    minimal parameters:
      partial tpl='gmap' indent=''
    all parameters:
      partial tpl="gmap" lat=58.84 lng=25.30 width="100%" height="100" zoom=10 indent=""
*/
global $smarty;

$lat = $smarty->getTemplateVars("lat");
$lng = $smarty->getTemplateVars("lng");
$zoom = $smarty->getTemplateVars("zoom");
$width = $smarty->getTemplateVars("width");
$height = $smarty->getTemplateVars("height");
$current_gmap_id = $smarty->getTemplateVars("current_gmap_id");

if (isset($current_gmap_id)) {
  $current_gmap_id++;
} else {
  $current_gmap_id = 1;
}

if (!isset($lat)) {
    $lat = 59.428629;
}
if (!isset($lng)) {
    $lng = 24.705626;
}

if (!isset($zoom)) {
    $zoom = 14;
}

if (!isset($width)) {
    $width = "200px";
}
if (!isset($height)) {
    $height = "200px";
}
if (strpos($width, "%") === false && strpos($width, "px") === false) {
    $width .= "px";
}
if (strpos($height, "%") === false && strpos($height, "px") === false) {
    $height .= "px";
}
$smarty->assign("width", $width);
$smarty->assign("height", $height);
$smarty->assign("zoom", $zoom);
$smarty->assign("lat", $lat);
$smarty->assign("lng", $lng);
$smarty->assign("current_gmap_id", $current_gmap_id);
{/php}<div id="{if isset($id)}{$id}{else}map_canvas_{$current_gmap_id}{/if}" style="width:{$width};height:{$height}" {if $class} class="{$class}"{/if}></div>
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
          alert('lat='+event.latLng.Ea+' lng='+event.latLng.Fa+' zoom='+this.map.zoom);
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
</script>{php}
global $smarty;
$smarty->clearAssign("width");
$smarty->clearAssign("height");
$smarty->clearAssign("zoom");
$smarty->clearAssign("lat", $lat);
$smarty->clearAssign("lng", $lng);
$smarty->clearAssign("id");
{/php}