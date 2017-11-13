<?php

$course = get_course($args['course_code']);

if (!$course) {
	echo '<h1>Course not found.</h1>';
	return;
}

$teachers = get_teachers_for_course($args['course_code']);
$programs = get_programs_with_course($args['course_code']);
$coordinators = get_course_coordinators($args['course_code']);
$requirements = get_course_requirements($args['course_code']);

$course_name = $course['course_name'];
$course_code = $args['course_code'];

$title = "<b>$course_code</b> $course_name";

echo "<h1>$title</h1>";

?>
<section class="course">

	<aside>

		<div>
			<h2>Department</h2>
			<p><?php echo $course['department_name']; ?></p>
		</div>

        <div>
            <?php
            print_right_plurality('h2', 'Course coordinator', count($coordinators));
            foreach ($coordinators as $coordinator) {
                $name = $coordinator['first_name'] . ' ' . $coordinator['last_name'];
                $username = $coordinator['username'];
                $email = $coordinator['email'];
                echo "<h3><a href=\"/person/$username\">$name</a></h3><p><a href=\"mailto:$email\">$email</a></p>";
            }
            ?>
        </div>

		<div>
            <?php
            echo template_execute('item/teacher', [
                'teachers' => $teachers
            ]);
            ?>
		</div>

		<div>
			<?php
			print_right_plurality('h2', 'Required programme of study', count($programs), 'Required programmes of study');
			if ($programs) {
				echo '<ul class="program-list">';
			}
			foreach ($programs as $program) {
				$program_code = $program['program_code'];
				$program_name = $program['program_name'];
				echo "
				<li>
					<a href=\"/program/$program_code\">
						<b>$program_code</b> $program_name
					</a>
				</li>";
			}
			if ($programs) {
				echo '</ul>';
			}
			?>
		</div>

		<div>
			<h2>Required previous knowledge</h2>
			<ul>
                <?php
                foreach ($requirements as $requirement) {
                    $course_code = $requirement['course_code'];
                    $course_name = $requirement['course_name'];
                    echo "<li><a href=\"/course/$course_code\"><b>$course_code</b> $course_name</a></li>";
                }
                if (!$requirements) {
                    echo '<li>None specified.</li>';
                }
                ?>
			</ul>
		</div>

		<div>
			<h2>Examination arrangement</h2>
			<?php echo '<p>' . $course['examination'] . '.</p>'; ?>
		</div>

	</aside>

	<article>
		<?php echo $course['description']; ?>
	</article>

</section>
