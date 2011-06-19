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
    global $htmlwarrior, $smarty, $debug;

    if ($htmlwarrior->config["live"] || $smarty->getTemplateVars("debug") != 1) {
        return "__htmlwarrior_remove_line__";
    }

    if (!isset($params["position"])) {
        $params["position"] = "top";
    }

    $output = "";

    if ($params["position"] == "top") {
        $output .= html_javascript($htmlwarrior->config["path_code"] . "/scripts/htmlwarrior_helpers", false) . "\n";
        $output .= html_javascript($htmlwarrior->config["path_code"] . "/scripts/htmlwarrior_init.php", false) . "\n";
        $output .= '<link rel="stylesheet" type="text/css" href="' . $htmlwarrior->config["path_code"] . '/admin/style/_style_site.css" media="screen, projection, print" title="" />';
    } elseif ($params["position"] == "bottom") {
        require_once("includes/pagelist.php");
        require_once("includes/imageoverlay.php");
        require_once("includes/actionlist.php");
        $output .= pagelist($_GET["template_list_opened"]);
        $output .= imageoverlay();
        $output .= actionlist();
        // load our scripts at the very end so we have overview of the page
        $output .= html_javascript($htmlwarrior->config["path_code"] . "/admin/scripts/externals/jquery", false) . "\n";
        $output .= html_javascript($htmlwarrior->config["path_code"] . "/admin/scripts/externals/jquery-ui", false) . "\n";
        $output .= html_javascript($htmlwarrior->config["path_code"] . "/admin/scripts/externals/jquery.cookie", false) . "\n";
        $output .= html_javascript($htmlwarrior->config["path_code"] . "/scripts/htmlwarrior", false) . "\n";
    }

    $a_output = explode("\n", $output);
    $first_line = true;
    foreach ($a_output as $key => $var) {
        if (!$first_line) {
            $a_output[$key] = $params["indent"] . $var;
        } else {
            $first_line = false;
            $a_output[$key] = $var;
        }
    }

    // fix: remove lines with only spaces
    $a_outputFinal = array();
    foreach ($a_output as $key => $var) {
        if (trim($var) != "") {
            $a_outputFinal[$key] = $var;
        }
    }

    return implode("\n", $a_outputFinal);
}

?>