<?php

$person = execute_sql('SELECT first_name, last_name, email FROM person WHERE username = ?', [
	$args['username' ]
], true);

// TODO: Write in reverse order?
$teach_courses = execute_sql('
	SELECT course.course_code AS course_code,
		   course.course_name AS course_name
	  FROM course
	  JOIN course_in_semester
	    ON course_in_semester.course_id = course.id
	  JOIN semester
	    ON semester.id = course_in_semester.semester_id
	   AND semester.started_at <= CURDATE()
	   AND semester.ended_at >= CURDATE()
	  JOIN teaching_course
	    ON teaching_course.course_in_semester_id = course_in_semester.id
	  JOIN employment
	    ON employment.id = teaching_course.employment_id
	  JOIN person
	    ON person.id = employment.person_id
	   AND person.username = ?
', [
	$args['username']
]);

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
		foreach ($teach_courses as $teach_course) {
			$course_title = '<b>' . $teach_course['course_code'] . '</b> ' . $teach_course['course_name'];
			echo '<li><a href="/course/' . $teach_course['course_code'] . '">' . $course_title . '</a></li>';
		}
		echo '</ul>';
		?>
	</div>

</section>
