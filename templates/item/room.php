<?php

$room_id = $args['room_id'];
$room_name = $args['room_name'];

// TODO: Figure out which are course_room, and get the semester name.
$semester_name = '';

?>
<div class="room-item">

	<a href="/room/<?php echo $room_id; ?>">
		<?php echo $room_name; ?>
		<!--<p>$semester_name</p>-->
	</a>

</div>
