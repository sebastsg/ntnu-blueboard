<?php

$room_id = $args['room_id'];

if (!is_person_in_room(session_username(), $room_id)) {
	return;
}

$room_name = get_room_name($room_id);
$teachers = get_participants_for_room($room_id, 'teacher');
$posts = get_recent_posts_for_room($room_id);
$assignments = get_assignments_for_room($room_id);
$course_room = get_course_room($room_id);

echo '<h1>' . $room_name . '</h1>';

?>
<section class="room">

	<aside>

		<div>
			<?php

			echo template_execute('item/teacher', [
                'teachers' => $teachers
            ]);

			?>
		</div>

		<?php
		
		if ($course_room) {
			echo '
			<div>
				<h2>Links</h2>
				<p>
					<a href="/course/' . $course_room['course_code'] . '">View course information</a> 
				</p>
				<p>
				    <a href="/participants/' . $args['room_id'] . '">List of participants</a>
                </p>
			</div>';
		}

		?>

	</aside>

	<article>

		<h2>Announcements</h2>
		<div>
			<?php
			foreach ($posts as $post) {
				echo template_execute('item/post', $post);
			}
			?>
		</div>

		<?php
		if (count($assignments) > 1) {
			echo '<h2>Current assignments</h2>';
		} else if (count($assignments) === 1) {
			echo '<h2>Current assignment</h2>';
		}
		?>
		<div>
			<?php
			foreach ($assignments as $assignment) {
				echo template_execute('item/assignment', $assignment);
			}
			?>
		</div>

	</article>

</section>
