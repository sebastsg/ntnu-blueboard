<?php

$db = false;

function connect_database() {
	global $db;
	if ($db === false) {
		try {
			// Set the data source name.
			$dsn = 'mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME . ';charset=utf8';

			// Attempt to establish the connection.
			$db = new PDO($dsn, DATABASE_USER, DATABASE_PASS);

			// Disable emulation of prepared statements.
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			// We want to catch PDOExceptions.
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (PDOException $e) {
			return false;
		} catch (Exception $e) {
			return false;
		}
	}
	return $db;
}

function create_database() {
	// Note: Intentionally not setting the global db.
	try {
		// Set the data source name.
		$dsn = 'mysql:host=' . DATABASE_HOST . ';charset=utf8';
		
		// Attempt to establish the connection.
		$db = new PDO($dsn, DATABASE_USER, DATABASE_PASS);

		// We want to catch PDOExceptions.
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Does the database already exist?
		$statement = $db->prepare('SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?');
		$statement->execute([ DATABASE_NAME ]);

		if ($statement->rowCount() > 0) {
			// Drop it, because we want to reinstall.
			$db->query('DROP DATABASE ' . DATABASE_NAME);
		}

		// Create the database.
		$db->query('CREATE DATABASE ' . DATABASE_NAME);
	
		// Set UTF8 as the default character set.
		$db->query('ALTER DATABASE ' . DATABASE_NAME . ' CHARACTER SET utf8 COLLATE utf8_general_ci');

        return true;

	} catch (PDOException $e) {
		echo '<pre>';
		print_r($e);
		echo '</pre>';
		return false;

	} catch (Exception $e) {
		return false;
	}
}

function execute_sql($query, $parameters = [], $single_row = false) {

	$db = connect_database();
	if (!$db) {
		return false;
	}

	try {
		$statement = $db->prepare($query);
		$statement->execute($parameters);
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		if (!$result) {
			return [];
		}
		if ($single_row) {
			return $result[0];
		}
		return $result;

	} catch (PDOException $e) {
		echo '<pre>';
		print_r($e);
		echo '</pre>';
		return false;

	} catch (Exception $e) {
		return false;
	}
}

function group_sql_result($rows, $group_by) {
    $result = [];
    foreach ($rows as $row) {
        $result[$row[$group_by]][] = $row;
    }
    return $result;
}

function make_question_marks($count) {
	$questions = '';
	for ($i = 0; $i < $count; $i++) {
		$questions .= '?,';
	}
	if (count($questions) > 0) {
		$questions = substr($questions, 0, -1);
	}
	return $questions;
}

function call_sql($procedure, $parameters, $single_row = false) {
	$questions = make_question_marks(count($parameters));
	$result = execute_sql("CALL $procedure ($questions)", $parameters, $single_row);
	if (!$result) {
		return [];
	}
	return $result;
}

function execute_sql_file($path) {

	if (!file_exists($path)) {
		return false;
	}

	$db = connect_database();
	if (!$db) {
		return false;
	}

	$query = file_get_contents($path);
	if (!$query) {
		return false;
	}

	try {
		// Temporarily emulate prepares to allow multiple queries.
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

		// Execute the SQL file.
		$statement = $db->prepare($query);
		$statement->execute();

		// Disable emulation again. Not an issue if this line is not reached because of an exception.
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return true;

	} catch (PDOException $e) {
		echo '<pre>';
		print_r($e);
		echo '</pre>';
		return false;

	} catch (Exception $e) {
		return false;
	}
}

function get_row_id_on_equals($table, $column, $value) {
	$result = execute_sql("SELECT id FROM $table WHERE $column = ?", [
		$value
	], true);
	if (!$result) {
		return 0;
	}
	return intval($result['id']);
}

// id = 0 	Auto increment used if enabled. 0 if not.
// id = -1  No id is added.
// id = ?   Any other value will be used as is.
function insert_into_table($table, $parameters, $id = 0) {
	$questions = make_question_marks(count($parameters));
	if ($id !== -1) {
		$id = intval($id);
		if (strlen($questions) > 0) {
			$questions = ',' . $questions;
		}
		return execute_sql("INSERT INTO $table VALUES ($id $questions)", $parameters);
	}
	return execute_sql("INSERT INTO $table VALUES ($questions)", $parameters);
}
