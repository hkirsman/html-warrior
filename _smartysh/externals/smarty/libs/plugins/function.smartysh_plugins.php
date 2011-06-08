<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.smartysh_plugins.php
 * Type:     function
 * Name:     smartysh_plugins
 * Purpose:  include Smartysh plugins. Currently it only adds
 * include code to html but does not incude files.
 * -------------------------------------------------------------
 */

function smarty_function_smartysh_plugins($params, &$smarty) {
    global $smarty, $smartysh, $config, $plugin, $site_header, $site_footer;

    if (!isset($params["position"])) {
        $params["position"] = "top";
    }

    $output = "";

    if (is_array($plugin)) {
        foreach ($plugin as $key => $var) {
            $site_header == $site_footer = ""; // reset variables in next to be included index.php
            require($config["code_path"] . "/plugins/$var/index.php");
            $site_header = trim($site_header);
            $site_footer = trim($site_footer);
            if ($params["position"] == "top" && strlen($site_header)) {
                $output .= $site_header . "\n";
            } elseif ($params["position"] == "bottom" && strlen($site_footer)) {
                $output .= $site_footer . "\n";
            }
        }
    }

    if (strlen($output)===0) {
        $output = "__" . $config["smartysh_prefix"] . "_remove_line__";
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