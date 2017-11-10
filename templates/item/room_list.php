<?php

$rooms = $args['rooms'];

if (count($rooms) < 1) {
	return;
}

?>
<h1>Rooms</h1>
<section>

	<?php

	foreach ($rooms as $room) {
		echo template_execute('item/room', $room);
	}

	?>

</section>
