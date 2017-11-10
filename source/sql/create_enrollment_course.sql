CREATE PROCEDURE create_enrollment_course (
    IN in_username      VARCHAR(32),
    IN in_semester_code VARCHAR(32),
    IN in_course_code   VARCHAR(32)
)

BEGIN

    INSERT INTO enrollment_course (id, course_in_program_id, enrollment_semester_id)
         VALUES (0,
                 (SELECT course_in_program.id
                    FROM course_in_program
                    JOIN course
                      ON course.id = course_in_program.course_id
                     AND course.course_code = in_course_code
                    JOIN course_in_semester
                      ON course_in_semester.course_id = course.id
                    JOIN semester
                      ON semester.id = course_in_semester.semester_id
                     AND semester.program_id = course_in_program.program_id
                     AND semester.semester_code = in_semester_code
                 ),
                 (SELECT enrollment_semester.id
                    FROM enrollment_semester
                    JOIN enrollment
                      ON enrollment.id = enrollment_semester.enrollment_id
                    JOIN person
                      ON person.id = enrollment.person_id
                     AND person.username = in_username
                    JOIN semester
                      ON semester.id = enrollment_semester.semester_id
                     AND semester.semester_code = in_semester_code
                 )
                );
	
END
