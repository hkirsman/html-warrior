<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.htmlwarrior_init.php
 * Type:     function
 * Name:     htmlwarrior_init
 * Purpose:  include htmlwarrior init code to site templates
 * which was hardcoded to templates before.
 * Every time something radical changed in code, all templates where
 * broken. Not anymore.
 * -------------------------------------------------------------
 */

function smarty_function_htmlwarrior_init($params, &$smarty) {
    global $htmlwarrior, $smarty;
    $path_code = $htmlwarrior->config['path_code'];
    $output = '';

    if ($htmlwarrior->config['live'] || $htmlwarrior->config['devmode']) {
        if ($params['position'] == 'top') {
            $bu = $htmlwarrior->config['baseurl'] . '/';
            $output = '<base href="' . $bu . '" />' . "\n";
        }
    }

    if ($htmlwarrior->config['live'] || !$htmlwarrior->config['devmode']) {
        $output .= '__htmlwarrior_remove_line__';
        return $output;
    }

    if (!isset($params['position'])) {
        $params['position'] = 'top';
    }

    if ($params['position'] == 'top') {
        $output .= html_javascript($path_code . '/admin/scripts/htmlwarrior_site_helpers', false) . "\n";
        $output .= html_javascript($path_code . '/admin/scripts/htmlwarrior_site_init.php', false) . "\n";
        $output .= '<link rel="stylesheet" type="text/css" href="' . $path_code . '/admin/style/_style_site.css" media="all" title="" />';
    } elseif ($params['position'] == 'bottom') {
        require_once('includes/pagelist.php');
        require_once('includes/imageoverlay.php');
        require_once('includes/actionlist.php');
        $output .= pagelist($_GET['template_list_opened']);
        $output .= imageoverlay();
        $output .= actionlist();
        // load our scripts at the very end so we have overview of the page
        $output .= html_javascript($path_code . '/admin/scripts/externals/jquery', false) . "\n";
        $output .= html_javascript($path_code . '/admin/scripts/externals/jquery-ui', false) . "\n";
        $output .= html_javascript($path_code . '/admin/scripts/externals/jquery.cookie', false) . "\n";
        $output .= html_javascript($path_code . '/admin/scripts/htmlwarrior_site', false) . "\n";
    }

    $a_output = explode("\n", $output);
    $first_line = true;
    foreach ($a_output as $key => $var) {
        if (!$first_line) {
            $a_output[$key] = $params['indent'] . $var;
        } else {
            $first_line = false;
            $a_output[$key] = $var;
        }
    }

    // fix: remove lines with only spaces
    $a_outputFinal = array();
    foreach ($a_output as $key => $var) {
        if (trim($var) != '') {
            $a_outputFinal[$key] = $var;
        }
    }

    return implode("\n", $a_outputFinal);
}