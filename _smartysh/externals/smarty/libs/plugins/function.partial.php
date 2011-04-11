<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.partial.php
 * Type:     function
 * Name:     partial
 * Purpose:  include partial and assing parameters
 * -------------------------------------------------------------
 */
function smarty_function_partial($params, &$smarty)
{
		global $smarty, $config;

		$site_dir = explode("/", $smarty->template_dir);
		$site_dir = $site_dir[0];

		if ( isset($params["tpl"]) ) { 
			$params["template"] = $params["tpl"];
		}

    foreach($params as $key=>$var) {
			if($key != "template") {
				$smarty->assign($key, $var);
			}
		}

		if ( $params["showcss"] ) { 
			echo '<script type="text/javascript" src="http://www.google.com/jsapi"></script>';
			echo '<script type="text/javascript" src="'.$config["path_code"].'/core/js/general.js"></script>';
			echo '<script type="text/javascript">var partialName = "'.$params["template"].'";</script>';
			echo '<script type="text/javascript" src="'.$config["path_code"].'/core/js/showcss.js"></script>';
		}

		// copy template from code to site if template does not exist
		if(!file_exists($config["basepath"]."/".$smarty->template_dir."partials/".$params["template"].".tpl")) { 
			echo '<div style="background: red">Templatet ei ole olemas. Kopeerin uue?. <a href="?copy=yes">jah</a></div>';
			if(@$_GET["copy"]=="yes") { 
				if ( copy ( $config["code_path"]."/templates/partials/".$params["template"].".tpl" , $config["basepath"]."/".$smarty->template_dir."partials/".$params["template"].".tpl" ) ) {
					echo "done";
				} else { 
					echo  $config["code_path"]."/templates/partials/".$params["template"].".tpl does not exist!";
				}
			}
		}
		$output = $smarty->fetch("partials/".$params["template"].".tpl");

		$page_variables = parse_variables($output);
		$output = remove_variables($output);

		// copy files if these are listed in template
		if(@$_GET["copy"]=="yes") {
			if ( $page_variables["_files"] ) {
				foreach($page_variables["_files"] as $key=>$var ) { 
					if(file_exists($config["code_path"]."/".$var) && !file_exists($config["basepath"]."/".$site_dir ."/".$var) ) { 
						if ( copy ( $config["code_path"]."/".$var , $config["basepath"]."/".$site_dir ."/".$var ) ) {
							echo "done copying $var";
						}
					}
				}
			}
			if ( $page_variables["stylefile"] ) {
				// todo?
			}
			// get help if exists? todo
		}

		// reset vars
		foreach($params as $key=>$var) {
			if($key != "template" && $key != "indent") {
				$smarty->clearAssign($key);
			}
		}
		$a_output = explode("\n", $output);
		$first_line = true;
		foreach($a_output as $key=>$var) { 
			if(!$first_line || $params["fullindent"] ) {
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
    $outputFinal = implode("\n", $a_outputFinal);

    // generate unique ids to placeholder divs
    if (isset($smarty->page_placeholder_div_ids)) {
      $smarty->page_placeholder_div_ids = $smarty->page_placeholder_div_ids+1;
    } else {
      $smarty->page_placeholder_div_ids = 1;
    }

    if ($config["show_partial_edit_links"] ) {
      $outputFinal = ''.
        '<script type="text/javascript">document.write(\'<div id="'.$config["smartysh_prefix"].'_begin page_placeholder_div_'.$smarty->page_placeholder_div_ids.'" tpl="'.$params["template"].'.tpl" style="display:none"></div>\');</script>'.
        $outputFinal.
        '<script type="text/javascript">document.write(\'<div id="'.$config["smartysh_prefix"].'_end_page_placeholder_div_'.$smarty->page_placeholder_div_ids.'" style="display:none"></div>\');</script>';
    }
		return $outputFinal;
}
?>