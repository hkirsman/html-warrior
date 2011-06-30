<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.metadata.php
 * Type:     function
 * Name:     metadata
 * Purpose:  add metadata to html class for js to pick it up.
 * http://plugins.jquery.com/project/metadata
 * -------------------------------------------------------------
 */

function smarty_function_metadata($params, $smarty = NULL, $repeat = NULL) {
    if ($params['_type']) {
        $type = $params['_type'];
        unset($params['_type']);
    }

    switch ($type) {
        default:
        case 'class':
            return htmlspecialchars(json_encode($params), ENT_QUOTES);
            break;
    }
}