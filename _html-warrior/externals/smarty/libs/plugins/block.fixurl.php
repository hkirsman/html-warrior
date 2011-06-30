<?php

/**
 * Smarty plugin to change & to &amp;
 * 
 * @package Smarty
 * @subpackage PluginsBlock
 * @author Hannes Kirsman
 */

/**
 * Smarty {fixurl}{/fixurl} block plugin
 * 
 * @param string $content contents of the block
 * @param object $template template object
 * @param boolean $ &$repeat repeat flag
 * @return string content re-formatted
 */
function smarty_block_fixurl($params, $content, $template, &$repeat) {
    $content = str_replace("&amp;", "&", $content);
    $content = str_replace("&", "&amp;", $content);
    return $content;
}