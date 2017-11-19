<?php

require_once('../source/init.php');

router_bind('/', function() {
	return template_execute('index', [
		'page' => template_execute('dashboard')
	]);
}, [ ROUTE_REQUIRES_SESSION ]);

router_bind('/ajax', function() {
	return template_execute('dashboard');
}, [ ROUTE_REQUIRES_SESSION ]);


router_bind('/course/{course_code}', function($course_code) {
    return template_execute('index', [
        'page' => template_execute('course', [
            'course_code' => $course_code
        ])
    ]);
}, [ ROUTE_REQUIRES_SESSION ]);

router_bind('/ajax/course/{course_code}', function($course_code) {
    return template_execute('course', [
        'course_code' => $course_code
    ]);
}, [ ROUTE_REQUIRES_SESSION ]);


router_bind('/program/{program_code}', function($program_code) {
    return template_execute('index', [
        'page' => template_execute('program', [
            'program_code' => $program_code
        ])
    ]);
}, [ ROUTE_REQUIRES_SESSION ]);

router_bind('/ajax/program/{program_code}', function($program_code) {
    return template_execute('program', [
        'program_code' => $program_code
    ]);
}, [ ROUTE_REQUIRES_SESSION ]);


router_bind('/ajax/room/{room_id}', function($room_id) {
	return template_execute('room', [
		'room_id' => $room_id
	]);
}, [ ROUTE_REQUIRES_SESSION ]);

router_bind('/room/{room_id}', function($room_id) {
	return template_execute('index', [
		'page' => template_execute('room', [
			'room_id' => $room_id
		])
	]);
}, [ ROUTE_REQUIRES_SESSION ]);


router_bind('/ajax/participants/{room_id}', function($room_id) {
    return template_execute('participants', [
        'room_id' => $room_id
    ]);
}, [ ROUTE_REQUIRES_SESSION ]);

router_bind('/participants/{room_id}', function($room_id) {
    return template_execute('index', [
        'page' => template_execute('participants', [
            'room_id' => $room_id
        ])
    ]);
}, [ ROUTE_REQUIRES_SESSION ]);



router_bind('/ajax/person/{username}', function($username) {
	return template_execute('person', [
		'username' => $username
	]);
}, [ ROUTE_REQUIRES_SESSION ]);

router_bind('/person/{username}', function($username) {
	return template_execute('index', [
		'page' => template_execute('person', [
			'username' => $username
		])
	]);
}, [ ROUTE_REQUIRES_SESSION ]);


router_bind('/ajax/report/{type}', function($type) {
    return template_execute('report', [
        'type' => $type
    ]);
}, [ ROUTE_REQUIRES_SESSION ]);

router_bind('/report/{type}', function($type) {
    return template_execute('index', [
        'page' => template_execute('report', [
            'type' => $type
        ])
    ]);
}, [ ROUTE_REQUIRES_SESSION ]);



router_bind_pages([

	'login',
	'resetpassword',

]);

router_bind_pages([

	'rooms',
    'evaluations',
    'groups',
	'profile',
	'notifications',

], [ ROUTE_REQUIRES_SESSION ]);


router_bind('/post/resetpassword', function() {

	$valid = array_keys_exist($_POST, [
		'username',
		'password'
	]);

	if (!$valid) {
		return 'Invalid data.';
	}

	set_person_password($_POST['username'], $_POST['password']);
	return 'The password has been changed.';

});

router_bind('/post/login', function() {

	$valid = array_keys_exist($_POST, [
		'username',
		'password'
	]);

	if (!$valid) {
		return 'Invalid data.';
	}

	$success = session_login($_POST['username'], $_POST['password']);
	if (!$success) {
		return 'Login failed.';
	}

	header('Location: /');
	return 'Successfully logged in.';

});


router_bind('/logout', function() {
	session_logout();
	header('Location: /');
    return 'You are now logged out.';
}, [ ROUTE_REQUIRES_SESSION ]);

router_bind('/ajax/logout', function() {
    session_logout();
    return 'You are now logged out.';
}, [ ROUTE_REQUIRES_SESSION ]);


router_bind('/install', function() {
	require_once('../source/install.php');
	install_database();
}, [ ROUTE_REQUIRES_LOCAL ]);


echo router_execute();


switch (get_router_status()) {

case ROUTER_STATUS_OKAY:
	break;

case ROUTER_STATUS_NO_SESSION:
	if ($router_root === 'ajax') {
		header('Location: /ajax/login');
	} else {
		header('Location: /login');
	}
	break;

case ROUTER_STATUS_NOT_LOCAL:
	echo 'This action can only be done locally.';
	break;

case ROUTER_STATUS_NO_ACTION:
	echo 'Invalid action.';
	break;

default:
	break;

}
