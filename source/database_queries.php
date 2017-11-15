<?php

function get_report_organization() {
    $rows = call_sql('get_report_organization');
    $faculties = group_sql_result($rows, 'faculty_code');
    foreach ($faculties as &$faculty) {
        $faculty = group_sql_result($faculty, 'department_code');
        foreach ($faculty as &$department) {
            $department = group_sql_result($department, 'program_code');
            foreach ($department as &$program) {
                $program = group_sql_result($program, 'course_code');
            }
        }
    }
    return $faculties;
}

function get_teachers_for_course($course_code) {
    return call_sql('get_teachers_for_course', [
        $course_code
    ]);
}

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
    $rows = call_sql('get_teaching_courses_for_person', [
        $username
    ]);
    return group_sql_result($rows, 'semester_code');
}

function create_course_coordinator($course_code, $username) {
    call_sql('create_course_coordinator', [
        $course_code,
        $username
    ]);
}

function get_course_coordinators($course_code) {
    return call_sql('get_course_coordinators', [
        $course_code
    ]);
}

function create_course_requirement($course_code, $requires_course_code) {
    call_sql('create_course_requirement', [
        $course_code,
        $requires_course_code
    ]);
}

function get_course_requirements($course_code) {
    return call_sql('get_course_requirements', [
        $course_code
    ]);
}

function create_invalid_course_combo($course_code_1, $course_code_2) {
    call_sql('create_invalid_course_combo', [
        $course_code_1,
        $course_code_2
    ]);
}

function get_invalid_course_combos($course_code) {
    return call_sql('get_invalid_course_combos', [
        $course_code
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

function create_program($department_code, $program_code, $program_name, $required_credits) {
    call_sql('create_program', [
        $department_code,
        $program_code,
        $program_name,
        $required_credits
    ]);
}

function create_course_in_program($program_code, $course_code, $is_mandatory) {
    call_sql('create_course_in_program', [
        $program_code,
        $course_code,
        // Booleans must be converted to integers, because PHP.
        intval($is_mandatory)
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

function find_course_room_id($semester_code, $course_code) {
    $room_id = call_sql('find_course_room', [
        $semester_code,
        $course_code
    ], true);
    if (!$room_id) {
        return 0;
    }
    return intval($room_id['room_id']);
}

function get_room_name($room_id) {
	$result = call_sql('get_room_name', [
		$room_id
	], true);
	if (!$result) {
		return 'Invalid room';
	}
	return $result['room_name'];
}

function get_programs_by_department($department_code) {
	return call_sql('get_programs_by_department', [
	    $department_code
    ]);
}

function get_person($username) {
	return call_sql('get_person', [
        $username
	], true);
}

function get_person_password_hash($username) {
	$result = call_sql('get_person_password_hash', [
	    $username
    ], true);
	if (!$result) {
		return '';
	}
	return $result['password_hash'];
}

function set_person_password($username, $new_password) {
	$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
	return call_sql('set_person_password_hash', [
		$username,
        $password_hash
	]);
}

/*
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
