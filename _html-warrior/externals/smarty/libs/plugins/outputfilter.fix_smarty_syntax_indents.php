<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     outputfilter.fix_smarty_syntax_indents.php
 * Type:     outputfilter
 * Name:     Fix smarty syntax indents
 * Purpose:  Removes plugin line if it doesn't contain anything
 * -------------------------------------------------------------
 */

function smarty_outputfilter_fix_smarty_syntax_indents($source, &$smarty) {
    global $htmlwarrior;
    $a_source = explode("\n", $source);

    foreach ($a_source as $key => $var) {
        if (strpos($var, "__" . $htmlwarrior->config["htmlwarrior_prefix"] . "_remove_line__") !== false) {
            unset($a_source[$key]);
        }
    }
    return implode("\n", $a_source);
}

?>