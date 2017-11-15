<?php

$program_code = $args['program_code'];

$program = get_program($program_code);
if (!$program) {
    echo '<h1>Program not found</h1>';
    return;
}

$courses = get_courses_in_program($program_code);

$program_name = $program['program_name'];

echo "<h1>$program_name ($program_code)</h1>";

?>
<section>

    <div>
        <h2>Information</h2>
        <p>Study points required: <b><?php echo $program['required_credits']; ?></b></p>
    </div>

    <div>
        <h2>Courses</h2>
        <?php

        if (!$courses) {
            echo '<p>None found.</p>';
        } else {

            echo '
            <table>
                <tr>
                    <th>Course</th>
                    <th>Credits</th>
                    <th>Mandatory</th>
                </tr>';

            foreach ($courses as $course) {
                $course_code = $course['course_code'];
                $course_name = $course['course_name'];
                $credits = $course['credits'];
                echo "<tr><td><a href=\"/course/$course_code\"><b>$course_code</b> $course_name</a></td>";
                echo "<td>$credits</td>";
                if ($course['is_mandatory']) {
                    echo '<td><b>Yes</b></td>';
                } else {
                    echo '<td>No</td>';
                }
                echo '</tr>';
            }

            echo '</table>';

        }

        ?>
    </div>

</section>
