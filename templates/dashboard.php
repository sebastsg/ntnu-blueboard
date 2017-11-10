<h1>Dashboard</h1>
<section class="dashboard">

	<h2>Recent notices</h2>
	<section class="dashboard-notices">

		<?php

		$posts = get_recent_posts(session_username());

		foreach ($posts as $post) {
			echo template_execute('item/post', $post);
		}

		?>

	</section>

	<h2>Assignments due soon</h2>
	<section class="dashboard-assignments">

		<?php

		$assignments = get_due_assignments(session_username());

		foreach ($assignments as $assignment) {
			echo template_execute('item/assignment', $assignment);
		}

		?>

	</section>

</section>
