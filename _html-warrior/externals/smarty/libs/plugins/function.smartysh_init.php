<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.smartysh_init.php
 * Type:     function
 * Name:     smartysh_init
 * Purpose:  include Smartysh init code to site templates
 * which was hardcoded to templates before.
 * Every time something radical changed in code, all templates where
 * broken. Not anymore.
 * -------------------------------------------------------------
 */

function smarty_function_smartysh_init($params, &$smarty) {
    global $smartysh, $smarty, $debug;

    if ($smartysh->config["live"] || $smarty->getTemplateVars("debug") != 1) {
        return "__smartysh_remove_line__";
    }

    if (!isset($params["position"])) {
        $params["position"] = "top";
    }

    $output = "";

    if ($params["position"] == "top") {
        $output .= html_javascript($smartysh->config["path_code"] . "/scripts/smartysh_helpers", false) . "\n";
        $output .= html_javascript($smartysh->config["path_code"] . "/scripts/smartysh_init.php", false) . "\n";
        $output .= '<link rel="stylesheet" type="text/css" href="' . $smartysh->config["path_code"] . '/admin/style/_style_site.css" media="screen, projection, print" title="" />';
    } elseif ($params["position"] == "bottom") {
        require_once("includes/pagelist.php");
        require_once("includes/actionlist.php");
        $output .= pagelist($_GET["template_list_opened"]);
        $output .= actionlist();
        // load our scripts at the very end so we have overview of the page
        $output .= html_javascript($smartysh->config["path_code"] . "/admin/scripts/externals/jquery", false) . "\n";
        $output .= html_javascript($smartysh->config["path_code"] . "/admin/scripts/externals/jquery-ui", false) . "\n";
        $output .= html_javascript($smartysh->config["path_code"] . "/admin/scripts/externals/jquery.cookie", false) . "\n";
        $output .= html_javascript($smartysh->config["path_code"] . "/scripts/psdOverlay", false) . "\n";
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