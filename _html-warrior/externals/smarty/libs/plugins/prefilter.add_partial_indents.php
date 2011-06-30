<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     prefilter.add_partial_indents.php
 * Type:     prefilter
 * Name:     add_partial_indents
 * Purpose:  Add indent parameters for partial. Otherwise
 *           partial does not know how much to indent itselt.
 * -------------------------------------------------------------
 */

function smarty_prefilter_add_partial_indents($source, &$smarty) {
    $a_source = explode("\n", $source);

    foreach ($a_source as $key => $var) {
        if (preg_match("/^(\s*)({partial.*([\"|']{1})})/U", $var, $mt)) {
            $found_partial = $mt[2];
            $quote = $mt[3];
            $found_partial = str_replace($quote . '}', $quote . ' indent="' . $mt[1] . '"}', $found_partial);
            $a_source[$key] = str_replace($mt[1] . $mt[2], $mt[1] . $found_partial, $var);
        }
    }

    return implode("\n", $a_source);
}