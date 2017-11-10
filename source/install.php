<?php

// Just for easy testing with dummy data.

function install_database() {

	echo '<table>';
	echo '<tr><td>Creating database</td><td>';

	$database_created = create_database();

	if (!$database_created) {
		echo 'Failed!</td></tr></table>';
		return;
	}

	echo 'Done.</td></tr>';

	$files = get_files_in_directory('../source/sql');

	foreach ($files as $file) {

		echo "<tr><td>$file</td><td>";

		$success = execute_sql_file('../source/sql/' . $file);

		echo ($success ? 'Done.' : 'Failed!') . '</td></tr>';

	}

	echo '</table>';

	include('../seed/core.php');
	include('../seed/organization.php');
	include('../seed/people.php');

}
