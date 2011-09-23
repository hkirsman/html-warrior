<?php
/**
 * Smarty plugin to execute WIKI code
 * 
 * @package Smarty
 * @subpackage PluginsBlock
 * @author Hannes Kirsman
 */

/**
 * Smarty {wiki}{/wiki} block plugin
 * 
 * @param string $content contents of the block
 * @param object $template template object
 * @param boolean $ &$repeat repeat flag
 * @return string content re-formatted
 */
function smarty_block_wiki2($params, $content, $template, &$repeat)
{ 
	global $smarty, $config_q;

        define('MEDIAWIKI', true);
        require_once($config_q["code_path"]."/externals/mediawiki/includes/Exception.php");
        require_once($config_q["code_path"]."/externals/mediawiki/includes/User.php");
        //require_once($config_q["code_path"]."/externals/mediawiki/includes/StubUserLang.php");
        require_once($config_q["code_path"]."/externals/mediawiki/includes/StubObject.php");
        require_once($config_q["code_path"]."/externals/mediawiki/includes/WebRequest.php");

        require_once($config_q["code_path"]."/externals/mediawiki/includes/GlobalFunctions.php");
        require_once($config_q["code_path"]."/externals/mediawiki/includes/ObjectCache.php");
        require_once($config_q["code_path"]."/externals/mediawiki/maintenance/tests/testHelpers.inc");
        require_once($config_q["code_path"]."/externals/mediawiki/maintenance/tests/parser/parserTest.inc");


        $test = new ParserTest();
        $parser = $test->fuzzTest('foo.php');

        /*$parser->setupGlobals();
	$p = $parser->getParser();
         * 
         */
        

        /*define('MEDIAWIKI', true);
        require_once($config_q["code_path"]."/externals/mediawiki/includes/Exception.php");
        require_once($config_q["code_path"]."/externals/mediawiki/includes/User.php");
        require_once($config_q["code_path"]."/externals/mediawiki/includes/StubUserLang.php");
        

        require_once($config_q["code_path"]."/externals/mediawiki/includes/GlobalFunctions.php");
        require_once($config_q["code_path"]."/externals/mediawiki/includes/ProfilerStub.php");
	require_once($config_q["code_path"]."/externals/mediawiki/includes/parser/Parser.php");

arr('f');
        $wgUser = new User;
        $wgLang = new StubUserLang;
        $wgOut = new StubObject( 'wgOut', 'OutputPage' );
        $wgParser = new StubObject( 'wgParser', $wgParserConf['class'], array( $wgParserConf ) );

        arr('f');

        /*$parser = new Parser();
	return $parser->recursiveTagParse( $content );
         *
         */

}

?>