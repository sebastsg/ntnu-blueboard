<?php

$person = get_person($args['username']);
$teaching_courses = get_teaching_courses_for_person($args['username']);

$name = $person['first_name'] . ' ' . $person['last_name'];
$email = $person['email'];

echo '<h1>' . $name . '</h1>';

?>
<section class="person">
	
	<div>
		<img style="background:#ddd;width:128px;height:128px;">
		<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
	</div>

	<div>
		<h2>Teaches</h2>
		<?php
		echo '<ul>';
		foreach ($teaching_courses as $teaching_course) {
			$course_title = '<b>' . $teaching_course['course_code'] . '</b> ' . $teaching_course['course_name'];
			echo '<li><a href="/course/' . $teaching_course['course_code'] . '">' . $course_title . '</a></li>';
		}
		echo '</ul>';
		?>
	</div>

</section>
