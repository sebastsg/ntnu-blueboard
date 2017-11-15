<?php

$rooms = get_rooms_for_person(session_username());
if (count($rooms) < 1) {
    echo '<h1>You are not a participant in any room.</h1>';
    return;
}

?>
<h1>Rooms</h1>
<section>
	<?php
    $last_semester_name = '';
	foreach ($rooms as $room) {
	    if ($room['semester_name'] !== $last_semester_name) {
            $last_semester_name = $room['semester_name'];
	        if ($last_semester_name != '') {
                echo '<h2>' . $room['semester_name'] . '</h2>';
            } else {
	            echo '<h2>Info</h2>';
            }
        }
        echo template_execute('item/room', $room);
    }
	?>
</section>
