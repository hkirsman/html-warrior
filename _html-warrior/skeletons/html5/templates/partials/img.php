<?php

/**
 * Calculate dimensions for image.
 */
if (array_key_exists('src', $params)) {
    $src = $params['src'];
}

if (!isset($params['width']) && !isset($params['height'])) {
    $full_image_path = $htmlwarrior->config['basepath'] . '/' .
            $htmlwarrior->runtime['site_dir'] .
            $htmlwarrior->config['path_images'] . '/' .
            $params['src'];
    list($width, $height) = getimagesize($full_image_path);
    $params['width'] = $width;
    $params['height'] = $height;
}