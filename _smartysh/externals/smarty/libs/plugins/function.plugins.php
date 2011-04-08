<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.plugins.php
 * Type:     function
 * Name:     partial
 * Purpose:  include partial and assing parameters
 * -------------------------------------------------------------
 */
function smarty_function_plugins($params, &$smarty)
{
		global $smarty, $config_q, $plugin, $site_header, $site_footer;

		$site_dir = explode("/", $smarty->template_dir);
		$site_dir = $site_dir[0];

		if (!isset($params["position"]) ) { 
			$params["position"] = "top";
		}

		$output = "";

		foreach($plugin as $key=>$var) {
			$site_header == $site_footer = ""; // reset variables in next to be included index.php
			require($config_q["code_path"]."/plugins/$var/index.php");
			$site_header = trim($site_header);
			$site_footer = trim($site_footer);
			if ( $params["position"] == "top" && strlen($site_header)) {
				$output .= $site_header."\n";
			} elseif ( $params["position"] == "bottom" && strlen($site_footer) ) { 
				$output .= $site_footer."\n";
			}
		}

		$a_output = explode("\n", $output);
		$first_line = true;
		foreach($a_output as $key=>$var) { 
			if(!$first_line) {
				$a_output[$key] = $params["indent"].$var;
			} else { 
				$first_line = false;
				$a_output[$key] = $var;
			}
		}

		// fix: remove lines with only spaces
		$a_outputFinal = array();
		foreach($a_output as $key=>$var) { 
			if ( trim($var) != "" ) { 
				$a_outputFinal[$key] = $var;
			}
		}

		return implode("\n", $a_outputFinal);
}
?>