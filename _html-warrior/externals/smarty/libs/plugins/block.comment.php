<?php

/**
 * Smarty plugin for HTML Warrior to comment templates and
 * control from app if and how to show tem.
 * 
 * @package Smarty
 * @subpackage PluginsBlock
 */

/**
 * Smarty {comment}{/comment} block plugin
 * 
 * @param string $content contents of the block
 * @param object $template template object
 * @param boolean &$repeat repeat flag
 * @return string content re-formatted
 */
function smarty_block_comment($params, $content, $template, &$repeat) {
    global $htmlwarrior;

    if (!$repeat) {
        $content = '<!-- ' . $content . '-->';
    }

    return $content;
}