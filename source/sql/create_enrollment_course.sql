CREATE PROCEDURE create_enrollment_course (
    IN in_username      VARCHAR(32),
    IN in_semester_code VARCHAR(32),
    IN in_course_code   VARCHAR(16)
)

BEGIN

    INSERT INTO enrollment_course (id, course_in_program_id, enrollment_semester_id)
         VALUES (0,
                 (SELECT course_in_program.id
                    FROM course_in_program
                    JOIN course
                      ON course.code = course_in_program.course_code
                    JOIN course_in_semester
                      ON course_in_semester.course_code = course.code
                     AND course_in_semester.semester_code = in_semester_code
                    JOIN semester
                      ON semester.code = course_in_semester.semester_code
                     AND semester.program_code = course_in_program.program_code
                   WHERE course_in_program.course_code = in_course_code
                 ),
                 (SELECT enrollment_semester.id
                    FROM enrollment_semester
                    JOIN enrollment
                      ON enrollment.id = enrollment_semester.enrollment_id
                    JOIN person
                      ON person.id = enrollment.person_id
                     AND person.username = in_username
                    JOIN semester
                      ON semester.code = enrollment_semester.semester_code
                   WHERE enrollment_semester.semester_code = in_semester_code
                 )
                );
	
END
