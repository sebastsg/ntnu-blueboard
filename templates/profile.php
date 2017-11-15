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

    <h2>Reports</h2>
    <ul>
        <li><a href="/report/organization">Organizational structure report</a></li>
    </ul>

</section>

<h1>Semesters</h1>
<section>

	<?php

	echo template_execute('item/enrollment_semester', [
		'username' => session_username()
	]);

	?>

</section>
