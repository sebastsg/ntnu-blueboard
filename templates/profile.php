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
	
	$program_credits = get_credits_for_person(session_username());
    foreach ($program_credits as $credits) {
        $acquired = $credits['credits'];
        $required = $credits['required_credits'];
        $code = $credits['program_code'];
        $name = "<b>$code</b> " . $credits['program_name'];
        echo "<div class=\"credits\"><p><a href=\"$code\">$name</a></p><p>You currently have $acquired / $required credits.</p></div>";
    }

	?>

    <h2>Controls</h2>
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
