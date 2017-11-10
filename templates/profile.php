<?php

$person = get_person(session_username());

if (!$person) {
	return;
}

?>
<h1><?php echo $person['first_name'] . ' ' . $person['last_name']; ?></h1>
<section>

	<h2>Overview</h2>

	<?php
	
	$credits = get_credits_for_person(session_username());
	echo '<p>You currently have ' . $credits . ' credits.</p>';

	echo '<p>Email: <a href="mailto:' . $person['email'] . '">' . $person['email'] . '</a></p>';

	?>

	<p>
		<a href="/logout">
			<i class="fa fa-sign-out"></i>
			Logout
		</a>
	</p>

</section>

<h1>Semesters</h1>
<section>

	<?php

	echo template_execute('item/person_semester', [
		'person_id' => session_username()
	]);

	?>

</section>
