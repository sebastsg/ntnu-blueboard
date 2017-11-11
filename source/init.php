<?php

require_once('../config.php');

if (FORCE_SSL) {
    if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off') {
        header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], true, 301);
        exit;
    }
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
}

header('Content-Type: text/html; charset=utf-8');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');

session_start();

require_once('database.php');
require_once('database_queries.php');
require_once('router.php');
require_once('template.php');
require_once('session.php');
require_once('files.php');

// TODO: The functions below should eventually be moved out of this file.

function format_datetime($datetime) {
	// Convert from YYYY-MM-DD to YYYY.MM.DD
	$datetime = str_replace('-', '.', $datetime);
	// Remove seconds - H:i:s to H:i
	return substr($datetime, 0, -3);
}

function array_keys_exist($arr, $keys) {
    foreach ($keys as $key) {
        if (!array_key_exists($key, $arr)) {
            return false;
        }
    }
    return true;
}

function make_random_password() {
    // TODO: This should be made more secure. At the moment, there are no recurring characters.
    $password = str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
    return password_hash($password, PASSWORD_DEFAULT);
}

function verify_person_login($username, $password) {
    $password_hash = get_person_password_hash($username);
    return password_verify($password, $password_hash);
}
