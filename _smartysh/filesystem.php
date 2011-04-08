<?php

function dir_list($dir) {
		if ($dir[strlen($dir)-1] != '/') $dir .= '/';

		if (!is_dir($dir)) return array();

		$dir_handle  = opendir($dir);
		$dir_objects = array();
		while (false !== ($object = readdir($dir_handle))) {
				if (!in_array($object, array('.','..'))) {
						$filename    = $dir . $object;
						$file_object = array(
									'name' => $object,
									'size' => filesize($filename),
									'type' => filetype($filename),
									'time' => date("d F Y H:i:s", filemtime($filename)),
									'timestamp' => filemtime($filename)
							);
						$dir_objects[] = $file_object;
				}
		}
		return $dir_objects;
}

?>