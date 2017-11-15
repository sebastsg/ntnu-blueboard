<?php

$type = $args['type'];

function get_deep_value($array, $levels, $key) {
    for ($i = 0; $i < $levels; $i++) {
        $array = current($array);
    }
    return $array[$key];
}

?>

<h1>Report</h1>
<section>

<?php

switch ($type) {

case 'organization':
    $report = get_report_organization();

    echo '<table>';

    foreach ($report as $faculty) {

        $faculty_code = get_deep_value($faculty, 4, 'faculty_code');
        $faculty_name = get_deep_value($faculty, 4, 'faculty_name');

        echo '<tr>';
        echo "<td>$faculty_name ($faculty_code)</td>";
        echo '<td class="table-container" colspan="3">';
        echo '<table>';

        foreach ($faculty as $department) {

            $department_code = get_deep_value($department, 3, 'department_code');
            $department_name = get_deep_value($department, 3, 'department_name');
            $program_count = count($department);

            echo '<tr>';
            echo "<td>$department_name ($department_code)</td>";
            echo '<td class="table-container" colspan="2">';

            if ($program_count === 1 && isset($department[''])) {
                echo '</td></tr>';
                continue;
            }

            echo '<table>';

            foreach ($department as $program) {

                $program_code = get_deep_value($program, 2, 'program_code');
                $program_name = get_deep_value($program, 2, 'program_name');
                $course_count = count($program);

                echo '<tr>';
                echo "<td><a href=\"/program/$program_code\">$program_name ($program_code)</a></td>";
                echo '<td class="table-container">';

                if ($course_count === 1 && isset($program[''])) {
                    echo '</td></tr>';
                    continue;
                }

                echo '<table>';

                foreach ($program as $course) {

                    $course_code = get_deep_value($course, 1, 'course_code');
                    $course_name = get_deep_value($course, 1, 'course_name');
                    $course_is_mandatory = get_deep_value($course, 1, 'course_is_mandatory');

                    echo '<tr>';
                    echo "<td><a href=\"/course/$course_code\">";
                    if ($course_is_mandatory) {
                        echo '<i class="fa fa-lock"></i>';
                    } else {
                        echo '<i class="fa fa-unlock-alt"></i>';
                    }
                    echo " <b>$course_code</b> $course_name</a>";
                    echo '</td></tr>';

                }

                echo '</table>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</td>';
        echo '</tr>';

    }

    echo '</table>';

    break;

default:
    echo 'Invalid report type.';
    break;
}

?>
</section>
