<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     prefilter.fix_smarty_syntax_indents.php
 * Type:     prefilter
 * Name:     Fix smarty syntax indents
 * Purpose:  Nicifies {if, {else etc for output
 * -------------------------------------------------------------
 */

function smarty_prefilter_fix_smarty_syntax_indents($source, &$smarty) {
    $a_source = explode("\n", $source);
    $trimmable_smarty_tags = array('if', 'for', 'foreach', 'capture');
    $trimmable_smarty_tags_other = array('else');
    $indent_level = 0;
    $indent_level_as_string = '';

    $search = '';
    $i = 0;
    while ($i < count($trimmable_smarty_tags)) {
        $search.='^\s*{(' . $trimmable_smarty_tags[$i] . ')|^\s*{(\/)' . $trimmable_smarty_tags[$i] . '}|';
        $i++;
    }
    $i = 0;
    while ($i < count($trimmable_smarty_tags_other)) {
        $search.='^\s*{' . $trimmable_smarty_tags_other[$i] . '|';
        $i++;
    }
    $search = trim($search, '|');

    foreach ($a_source as $key => $var) {
        if (preg_match('/' . $search . '/U', $var, $mt)) {
            $found_smarty_tag = end($mt);
            if ($found_smarty_tag == '/') {
                $indent_level--;
            } else if (in_array($found_smarty_tag, $trimmable_smarty_tags)) {
                $indent_level++;
            }
            $a_source[$key] = trim($var);
        } else {
            $indent_level_as_string = '';
            $i = 0;
            while ($i < $indent_level) {
                $indent_level_as_string.='  ';
                $i++;
            }
            $a_source[$key] = preg_replace('/' . $indent_level_as_string . '/', '', $var, 1);
        }
    }
    return implode("\n", $a_source);
}