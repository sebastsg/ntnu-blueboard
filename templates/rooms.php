<?php

$rooms = call_sql('get_rooms_for_person', [
	session_username()
]);

echo template_execute('item/room_list', [
	'rooms' => $rooms
]);
