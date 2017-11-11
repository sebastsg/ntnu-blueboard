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

	$sql_files = get_files_in_directory('../source/sql');

	foreach ($sql_files as $sql_file) {
		echo "<tr><td>$sql_file</td><td>";
		$success = execute_sql_file('../source/sql/' . $sql_file);
		echo ($success ? 'Done.' : 'Failed!') . '</td></tr>';
	}

    echo '</table><table>';

	$seeds = get_files_in_directory('../seed');
	foreach ($seeds as $seed) {
	    echo "<tr><td>$seed</td><td>";
	    include('../seed/' . $seed);
	    echo 'Done.</td></tr>';
    }

    echo '</table>';

}
