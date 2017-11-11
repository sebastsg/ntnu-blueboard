<table class="person-semester">

	<tr>
		<th>Code</th>
		<th>Name</th>
		<th>Credits</th>
		<th>Grade</th>
	</tr>

	<?php

	$enrollment_courses = get_enrollment_courses_for_person($args['username']);
	$semester_credits = 0;

	foreach ($enrollment_courses as $enrollment_course) {

		$course = get_course($enrollment_course['course_code']);
		$grade = '';
		if ($enrollment_course['grade']) {
			$grade = $enrollment_course['grade'];
		}
		$course_failed = ($grade === 'F');

		if ($course_failed) {
			echo '<tr class="course-failed">';
		} else {
			echo '<tr>';
		}

		echo '
		<td><b>' . $enrollment_course['course_code'] . '</b></td>
		<td><a href="/course/' . $enrollment_course['course_code']  . '">' . $course['course_name'] . '</a></td>
		<td>' . $course['credits'] . '</td>
		<td>' . $grade . '</td>
		
		</tr>';

		if ($grade !== 'F' && $grade !== '') {
			$semester_credits += intval($course['credits']);
		}

	}

	echo '
	<tr>
		<td></td>
		<td></td>
		<td>' . $semester_credits . '</td>
		<td></td>
	</tr>';

	?>

</table>
