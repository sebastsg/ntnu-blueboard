<?php

function client_is_local() {
	// TODO: This function is not yet written.
	return true;
}

function session_is_logged_in() {
	return isset($_SESSION['username']);
}

function session_username() {
    return $_SESSION['username'];
}

function session_login($username, $password) {
	if (!verify_person_login($username, $password)) {
		return false;
	}
	// Setup the session data.
	$_SESSION['username'] = $username;
}

function session_logout() {
	if (!session_is_logged_in()) {
		return;
	}
	unset($_SESSION['username']);
}
