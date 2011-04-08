<?php
/*
build.php - build the whole site
*/

$files = array();
if ($handle = opendir("$site_dir/templates/pages")) {
	while (false !== ($file = readdir($handle))) {
		if($file!="." && $file!="..") { 
			$tpl_files[] = $file;
		}
	}
	closedir($handle);

	foreach($tpl_files as $tpl_file) {
		file_get_contents($config["baseurl"]."/".$site_dir."/".str_replace(".tpl", ".html", $tpl_file)."?debug=0");
	}
}

// copy dirs
full_copy($config_q["basepath"]."/$site_dir/images",  $config_q["basepath"]."/$site_dir/".$config["build_dir"]."/images");
full_copy($config_q["basepath"]."/$site_dir/scripts", $config_q["basepath"]."/$site_dir/".$config["build_dir"]."/scripts");
full_copy($config_q["basepath"]."/$site_dir/style",   $config_q["basepath"]."/$site_dir/".$config["build_dir"]."/style");


function full_copy( $source, $target ) {
	if ( is_dir( $source ) ) {
		@mkdir( $target );
		$d = dir( $source );
		while ( FALSE !== ( $entry = $d->read() ) ) {
			if ( $entry == '.' || $entry == '..' ) {
				continue;
			}
			$Entry = $source . '/' . $entry; 
			if ( is_dir( $Entry ) ) {
				full_copy( $Entry, $target . '/' . $entry );
				continue;
			}
			copy( $Entry, $target . '/' . $entry );
			touch ( $target . '/' . $entry, filemtime($Entry) ); // set time
		}
		$d->close();
	}else {
		copy( $source, $target );
		touch ( $target, filemtime($source) ); // set time
	}
}

?>