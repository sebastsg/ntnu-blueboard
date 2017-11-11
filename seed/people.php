<?php

function add_enrollment_semester($username, $semester_code, $course_codes) {
    create_enrollment_semester($username, $semester_code);
	foreach ($course_codes as $course_code) {
        create_enrollment_course($username, $semester_code, $course_code);
        $room_id = find_course_room_id($semester_code, $course_code);
        create_participant($username, 'student', $room_id);
	}
}

echo 'Adding people...<br>';
create_person('sebastsg', 'Sebastian', 'Gundersen');
create_person('hawa', 'Hao', 'Wang');
create_person('gist', 'Girts', 'Strazdins');
create_person('hasc', 'Hans Georg', 'Schaathun');
create_person('asty', 'Arne', 'Styve');
create_person('mathsa', 'Mathias ', 'Sandulescu');

echo 'Adding semesters...<br>';
create_semester('004DA', '004DA-2016-S', 'Spring 2016', '2016-01-09', '2016-06-16');
create_semester('004DA', '004DA-2016-A', 'Autumn 2016', '2016-08-19', '2016-12-15');
create_semester('004DA', '004DA-2017-S', 'Spring 2017', '2017-01-08', '2017-06-19');
create_semester('004DA', '004DA-2017-A', 'Autumn 2017', '2017-08-21', '2017-12-14');
create_semester('004DA', '004DA-2018-S', 'Spring 2018', '2018-01-09', '2018-06-20');

echo 'Adding courses for semesters...<br>';
create_course_in_semester('004DA-2017-S', 'ID101912');
create_course_in_semester('004DA-2017-S', 'IE100212');
create_course_in_semester('004DA-2017-S', 'ID102012');
create_course_in_semester('004DA-2017-A', 'ID202912');
create_course_in_semester('004DA-2017-A', 'ID202812');
create_course_in_semester('004DA-2017-A', 'ID203012');
create_course_in_semester('004DA-2018-S', 'ID202712');
create_course_in_semester('004DA-2018-S', 'IR201812');
create_course_in_semester('004DA-2018-S', 'IR102512');

echo 'Enrolling students...<br>';
create_enrollment('sebastsg', '004DA', 5202);

echo 'Signing up for courses...<br>';
add_enrollment_semester('sebastsg', '004DA-2017-S', [
	'ID101912',
	'IE100212',
	'ID102012',
]);

add_enrollment_semester('sebastsg', '004DA-2017-A', [
	'ID202912',
	'ID202812',
	'ID203012',
]);

add_enrollment_semester('sebastsg', '004DA-2018-S', [
	'ID202712',
	'IR201812',
	'IR102512',
]);

echo 'Adding employees...<br>';
create_employment('hawa', 'IIR');
create_employment('gist', 'IIR');
create_employment('hasc', 'IIR');
create_employment('asty', 'IIR');
create_employment('mathsa', 'IIR');

echo 'Adding teaching courses...<br>';
create_teaching_course('hawa', '004DA-2017-S', 'ID101912');
create_teaching_course('hawa', '004DA-2017-S', 'IE100212');
create_teaching_course('hawa', '004DA-2017-S', 'ID102012');
create_teaching_course('hawa', '004DA-2017-A', 'ID202912');
create_teaching_course('hawa', '004DA-2017-A', 'ID202812');
create_teaching_course('hawa', '004DA-2017-A', 'ID203012');

echo 'Adding posts...<br>';
create_post(
    find_course_room_id('004DA-2017-A', 'ID202912'),
    'hawa',
	'Send me your preference of the group members',
	'As I said in today\'s lecture, the 3rd (and it is a combination of the last two assignments, so it will be the last assignment) assignment will be in groups of up to 3 persons. Please send me who you prefer to collaborate with in an email before 8am next Monday (16.10). I will try to accommodate these preferences and then I will define the groups. Note that group presentation and discussion on the last assignment will be part of the final oral exam.'
);

echo 'Adding assignments...<br>';
create_assignment(
    find_course_room_id('004DA-2017-A', 'ID202912'),
	'hawa',
	'Assignment 1',
	'[Details here...]',
	'2017-10-20 10:00:00',
	'2017-11-16 23:00:00',
	true,
    false
);

echo 'Adding submissions...<br>';
$submission_id = create_assignment_submission_and_files(1, 'sebastsg', 'I did my very best!', [
    'Assignment 1 Answers' => 'submissions/1/Assignment 1 Answers.pdf'
]);

echo 'Adding evaluations...<br>';
create_assignment_evaluation($submission_id, 'hawa', 100, 'Good work!');

echo 'Adding grades...<br>';
create_grade('sebastsg', 'hawa', '004DA-2017-S', 'ID101912', 'A');
create_grade('sebastsg', 'hawa', '004DA-2017-S', 'IE100212', 'B');
create_grade('sebastsg', 'hawa', '004DA-2017-S', 'ID102012', 'C');
create_grade('sebastsg', 'hawa', '004DA-2017-A', 'ID202912', 'D');
create_grade('sebastsg', 'hawa', '004DA-2017-A', 'ID202812', 'E');
create_grade('sebastsg', 'hawa', '004DA-2017-A', 'ID203012', 'F');


echo 'Setting passwords...<br>';
set_person_password('sebastsg', 'test');
set_person_password('hawa', 'test');
set_person_password('gist', 'test');
set_person_password('hasc', 'test');


echo 'Done!';
