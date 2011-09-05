<?php

/**
 * Smarty plugin to execute PHP code
 * 
 * @package Smarty
 * @subpackage PluginsBlock
 */

/**
 * Smarty {markdown}{/markdown} block plugin
 * 
 * @param string $content contents of the block
 * @param object $template template object
 * @param boolean &$repeat repeat flag
 * @return string content re-formatted
 */
function smarty_block_markdown($params, $content, $template, &$repeat) {
    global $htmlwarrior;

    $code_path = $htmlwarrior->config['code_path'];
    require_once($code_path . '/externals/php_markdown/php_markdown.php');

    return Markdown($content);
}