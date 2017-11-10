<?php

function get_files_in_directory($directory) {
	
	if (!is_dir("$directory")) {
		return false;
	}
	
	$files = scandir("$directory");
	if (!$files) {
		return false;
	}
	
	$result = [];
	foreach ($files as $file) {
		if ($file != '.' && $file != '..' && !is_dir("$directory/$file")) {
			$result[] = $file;
		}
	}
	
	return $result;

}
