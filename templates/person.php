<?php

$person = get_person($args['username']);

if (!$person) {
    echo '<h1>Person not found</h1>';
    return;
}

$teaching_semesters = get_teaching_courses_for_person($args['username']);

$name = $person['first_name'] . ' ' . $person['last_name'];
$email = $person['email'];

echo '<h1>' . $name . '</h1>';

?>
<section class="person">
	
	<div>
		<img style="background:#ddd;width:128px;height:128px;">
        <p>
		    <b>Email: </b><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
        </p>
	</div>

    <?php
    if ($teaching_semesters) {
        echo '
        <div>
	        <h2>Teaches</h2>';
		foreach ($teaching_semesters as $teaching_courses) {
            $semester_name = $teaching_courses[0]['semester_name'];
            echo "<h3>$semester_name</h3>";
		    echo '<ul>';
		    foreach ($teaching_courses as $teaching_course) {
                $course_code = $teaching_course['course_code'];
                $course_name = $teaching_course['course_name'];
                $course_title = "<b>$course_code</b> $course_name";
                echo "<li><a href=\"/course/$course_code\">$course_title</a></li>";
            }
            echo '</ul>';
		}
		echo '</div>';
	}
    ?>

</section>
