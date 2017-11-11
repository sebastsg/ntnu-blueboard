<?php

function get_course($course_code) {
    return call_sql('get_course', [
        $course_code
    ], true);
}

function get_course_room($room_id) {
    return call_sql('get_course_room', [
        $room_id
    ], true);
}

function get_participants_for_room($room_id, $role){
    return call_sql('get_participants_for_room', [
        $room_id, $role
    ]);
}

function get_rooms_for_person($username) {
    return call_sql('get_rooms_for_person', [
        $username
    ]);
}

function get_recent_posts_for_room($room_id) {
    return call_sql('get_recent_posts_for_room', [
        $room_id
    ]);
}

function get_assignments_for_room($room_id) {
    return call_sql('get_assignments_for_room', [
        $room_id
    ]);
}

function get_evaluations($username) {
    return call_sql('get_evaluations', [
        $username
    ]);
}

function get_programs_with_course($course_code) {
    return call_sql('get_programs_with_course', [
        $course_code
    ]);
}

function get_teaching_courses_for_person($username) {
    return call_sql('get_teaching_courses_for_person', [
        $username
    ]);
}

function create_assignment_submission($assignment_id, $username, $message) {
    $id = call_sql('create_assignment_submission', [
        $assignment_id,
        $username,
        $message
    ], true);
    if (!$id) {
        return 0;
    }
    return intval($id['id']);
}

function create_assignment_submission_file($assignment_submission_id, $username, $file_name, $file_path) {
    call_sql('create_assignment_submission_file', [
        $assignment_submission_id,
        $username,
        $file_name,
        $file_path
    ]);
}

function create_assignment_submission_and_files($assignment_id, $username, $message, $files) {
    $submission_id = create_assignment_submission($assignment_id, $username, $message);
    foreach ($files as $file_name => $file_path) {
        create_assignment_submission_file($submission_id, $username, $file_name, $file_path);
    }
    return $submission_id;
}

function create_assignment_evaluation($assignment_submission_id, $username, $score, $message) {
    call_sql('create_assignment_evaluation', [
        $assignment_submission_id,
        $username,
        $score,
        $message
    ]);
}

function create_course_in_semester($semester_code, $course_code) {
    call_sql('create_course_in_semester', [
        $semester_code,
        $course_code
    ]);
}

function set_course_description($course_code, $description) {
    call_sql('set_course_description', [
        $course_code,
        $description
    ]);
}

function create_faculty($faculty_code, $faculty_name) {
    call_sql('create_faculty', [
        $faculty_code,
        $faculty_name
    ]);
}

function create_department($faculty_code, $department_code, $department_name) {
    call_sql('create_department', [
        $faculty_code,
        $department_code,
        $department_name
    ]);
}

function create_course($department_code, $course_code, $course_name, $description, $exam, $credits) {
    call_sql('create_course', [
        $department_code,
        $course_code,
        $course_name,
        $description,
        $exam,
        $credits
    ]);
}

function create_program($department_code, $program_code, $program_name) {
    call_sql('create_program', [
        $department_code,
        $program_code,
        $program_name
    ]);
}

function create_course_in_program($program_code, $course_code, $is_mandatory) {
    call_sql('create_course_in_program', [
        $program_code,
        $course_code,
        $is_mandatory
    ]);
}

function create_teaching_course($username, $semester_code, $course_code) {
    call_sql('create_teaching_course', [
        $username,
        $semester_code,
        $course_code
    ]);
}

function create_employment($username, $department_code) {
    call_sql('create_employment', [
        $username,
        $department_code
    ]);
}

function create_post($room_id, $username, $title, $body) {
    call_sql('create_post', [
        $room_id,
        $username,
        $title,
        $body
    ]);
}

function create_assignment($room_id, $username, $title, $body, $started_at, $ended_at, $groups, $individual) {
    call_sql('create_assignment', [
        $room_id,
        $username,
        $title,
        $body,
        $started_at,
        $ended_at,
        // Booleans must be converted to integers, because PHP.
        intval($groups),
        intval($individual)
    ]);
}

function create_person($username, $first_name, $last_name) {
    $email = $username . '@blueboard.sgundersen.com';
    call_sql('create_person', [
        $username,
        $first_name,
        $last_name,
        $email,
        make_random_password()
    ]);
}

function create_grade($student_username, $teacher_username, $semester_code, $course_code, $grade) {
    call_sql('create_grade', [
        $student_username,
        $teacher_username,
        $semester_code,
        $course_code,
        $grade
    ]);
}

function create_enrollment($username, $program_code, $student_number) {
    call_sql('create_enrollment', [
        $username,
        $program_code,
        $student_number
    ]);
}

function create_participant($username, $role, $room_id) {
    call_sql('create_participant', [
        $username,
        $role,
        $room_id
    ]);
}

function create_enrollment_semester($username, $semester_code) {
    call_sql('create_enrollment_semester', [
        $username,
        $semester_code
    ]);
}

function create_enrollment_course($username, $semester_code, $course_code) {
    call_sql('create_enrollment_course', [
        $username,
        $semester_code,
        $course_code
    ]);
}

function create_semester($program_code, $semester_code, $semester_name, $started_at, $ended_at) {
    call_sql('create_semester', [
        $program_code,
        $semester_code,
        $semester_name,
        $started_at,
        $ended_at
    ]);
}

function get_enrollment_courses_for_person($username) {
    return call_sql('get_enrollment_courses_for_person', [
        $username
    ]);
}

function get_credits_for_person($username) {
    $result = call_sql('get_credits_for_person', [
        $username
    ], true);
    if (!$result) {
        return 0;
    }
    return intval($result['total_credits']);
}

function is_person_in_room($username, $room_id) {
    $result = call_sql('is_person_in_room', [
        $username,
        $room_id
    ]);
    return count($result) > 0;
}

function get_room_name($room_id) {
	$result = execute_sql('SELECT room_name FROM room WHERE id = ?', [
		$room_id
	], true);
	if (!$result) {
		return 'Invalid room';
	}
	return $result['room_name'];
}

function get_programs_by_department($department_code) {
	return execute_sql('SELECT program_code, program_name FROM program WHERE department_code = ?', [
		$department_code
	]);
}

function get_person($username) {
	return execute_sql('SELECT first_name, last_name, email FROM person WHERE username = ?', [
        $username
	], true);
}

function get_due_assignments($username) {
    return call_sql('get_due_assignments', [
        $username
    ]);
}

function get_recent_posts($username) {
    return call_sql('get_recent_posts', [
        $username
    ]);
}

function get_person_password_hash($username) {
	$result = execute_sql('SELECT password_hash FROM person WHERE username = ?', [
	    $username
    ], true);
	if (!$result) {
		return '';
	}
	return $result['password_hash'];
}

function set_person_password($username, $new_password) {
	$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
	return execute_sql('UPDATE person SET password_hash = ? WHERE username = ?', [
		$password_hash, $username
	]);
}

function find_course_room_id($semester_code, $course_code) {
    $room_id = execute_sql('
		SELECT id
		  FROM room
		 WHERE room_name LIKE ?
		 LIMIT 1
	', [
        '%' . $course_code . '%'
    ], true);
    if (!$room_id) {
        return 0;
    }
    return intval($room_id['id']);
}
/*
function get_course_room_id($semester_id, $course_id) {
    $room = execute_sql('
		SELECT course_room.room_id AS id
		  FROM course_in_semester
		  JOIN course_room
		    ON course_room.course_in_semester_id = course_in_semester.id
		 WHERE course_in_semester.semester_id = ?
		   AND course_in_semester.course_id = ?
	', [
        $semester_id, $course_id
    ], true);
    if (!$room) {
        return 0;
    }
    return intval($room['id']);
}

function get_current_semester_id_for_course($course_id) {
	$result = execute_sql('
		SELECT semester.id AS id
		  FROM semester
		  JOIN course_in_program
		    ON course_in_program.program_id = semester.program_id
		   AND course_in_program.course_id = ?
		 WHERE semester.start_date <= CURDATE()
		   AND semester.end_date >= CURDATE()
      ORDER BY semester.start_date DESC
		 LIMIT 1
	', [
		$course_id
	], true);
	if (!$result) {
		return 0;
	}
	return intval($result['id']);
}*/
