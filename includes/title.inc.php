<?php

$title = basename($_SERVER['SCRIPT_FILENAME'], '.php');
$title = str_replace('-', ' ', $title);
if ($title == 'index') {
	$title = 'home';
}
$title = ucwords($title);

?>