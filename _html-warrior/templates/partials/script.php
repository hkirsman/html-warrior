<?php

/**
 * Get script
 * @param array $params Smarty plugin parameter
 */
function partial_helper_script(&$params) {
    $params['out'] = html_javascript($params['file']);
}