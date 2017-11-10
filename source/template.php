<?php

function template_execute($name, $args = []) {
	ob_start();
	include("../templates/$name.php");
	return ob_get_clean();
}

function print_right_plurality($tag, $singular, $count, $plural = '') {
	if ($count > 1) {
		if ($plural === '') {
			echo "<$tag>{$singular}s</$tag>";
		} else {
			echo "<$tag>$plural</$tag>";
		}
	} else if ($count === 1) {
		echo "<$tag>$singular</$tag>";
	}
}
