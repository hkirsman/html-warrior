<?php

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
  {partial tpl="gmap"}
  all parameters:
  {partial tpl="gmap" lat="58.84" lng="25.30" width="100%" height="100" zoom="10"}
 */
$lat = $params['lat'];
$lng = $params['lng'];
$zoom = $params['zoom'];
$width = $params['width'];
$height = $params['height'];
$current_gmap_id = $params['current_gmap_id'];

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
    $width = '200px';
}
if (!isset($height)) {
    $height = '200px';
}
if (strpos($width, '%') === false && strpos($width, 'px') === false) {
    $width .= 'px';
}
if (strpos($height, '%') === false && strpos($height, 'px') === false) {
    $height .= 'px';
}

$params['width'] = $width;
$params['height'] = $height;
$params['zoom'] = $zoom;
$params['lat'] = $lat;
$params['lng'] = $lng;
$params['current_gmap_id'] = $current_gmap_id;