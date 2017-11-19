<?php

$enrollment_courses = get_enrollment_courses_for_person($args['username']);
$semester_credits = 0;
$last_semester_name = '';

foreach ($enrollment_courses as $enrollment_course) {

	$course = get_course($enrollment_course['course_code']);
	$grade = '';
	if ($enrollment_course['grade']) {
		$grade = $enrollment_course['grade'];
	}
    $course_code = $enrollment_course['course_code'];
    $course_name = $course['course_name'];
    $credits = $course['credits'];
    $semester_name = $enrollment_course['semester_name'];
    $course_failed = ($enrollment_course['is_passed'] === 0);
    $course_passed = ($enrollment_course['is_passed'] === 1);

    if ($last_semester_name !== $semester_name) {
        if ($last_semester_name !== '') {
            echo "
                <tr>
                    <td></td>
                    <td>$semester_credits</td>
                    <td></td>
                </tr>
            </table>";
            $semester_credits = 0;
        }
        $last_semester_name = $semester_name;
        echo '
        <h2>' . $semester_name . '</h2>
        <table class="enrollment-semester">
        <tr>
            <th>Course</th>
            <th>Credits</th>
            <th>Grade</th>
        </tr>';
    }

    if ($course_passed) {
        $semester_credits += intval($credits);
    }

	if ($course_failed) {
		echo '<tr class="course-failed">';
	} else {
		echo '<tr>';
	}

	echo "
        <td>
            <a href=\"/course/$course_code\">
                <b>$course_code</b> 
                $course_name
            </a>
        </td>
        <td>$credits</td>
        <td>$grade</td>
	</tr>";

}

if ($last_semester_name !== '') {
    echo "
        <tr>
            <td></td>
            <td>$semester_credits</td>
            <td></td>
        </tr>
    </table>";
}

