<?php

$course = get_course($args['course_code']);

if (!$course) {
	echo '<h1>Course not found.</h1>';
	return;
}

$teachers = call_sql('get_teachers_for_course', [
	$args['course_code']
]);

$programs = get_programs_with_course($args['course_code']);

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
			<h2>Recommended previous knowledge</h2>
			<ul>
				<li><a href="/course/"><b>ID101912</b> Object-oriented programming</a></li>
			</ul>
		</div>

		<div>
			<h2>Examination arrangement</h2>
			<?php
			echo '<p>' . $course['examination'] . '.</p>';
			?>
		</div>

	</aside>

	<article>
		<?php echo $course['description']; ?>
	</article>

</section>
