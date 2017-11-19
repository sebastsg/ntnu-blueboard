CREATE PROCEDURE create_grade (
    IN in_student_username VARCHAR(32),
    IN in_teacher_username VARCHAR(32),
    IN in_semester_code    VARCHAR(32),
    IN in_course_code      VARCHAR(16),
    IN in_grade_type_name  VARCHAR(32)
)

BEGIN

    INSERT INTO grade (id, enrollment_course_id, teaching_course_id, grade_type_id)
         VALUES (0,
                 (SELECT enrollment_course.id
                    FROM semester
                    JOIN enrollment_semester
                      ON enrollment_semester.semester_code = semester.code
                    JOIN enrollment
                      ON enrollment.id = enrollment_semester.enrollment_id
                    JOIN person
                      ON person.id = enrollment.person_id
                     AND person.username = in_student_username
                    JOIN enrollment_course
                      ON enrollment_course.enrollment_semester_id = enrollment_semester.id
                    JOIN course_in_program
                      ON course_in_program.id = enrollment_course.course_in_program_id
                    JOIN course
                      ON course.code = course_in_program.course_code
                     AND course.code = in_course_code
                   WHERE semester.code = in_semester_code
                 ),
                 (SELECT teaching_course.id
                    FROM course
                    JOIN course_in_semester
                      ON course_in_semester.course_code = course.code
                    JOIN semester
                      ON semester.code = course_in_semester.semester_code
                     AND semester.code = in_semester_code
                    JOIN teaching_course
                      ON teaching_course.course_in_semester_id = course_in_semester.id
                    JOIN employment
                      ON employment.id = teaching_course.employment_id
                    JOIN person
                      ON person.id = employment.person_id
                     AND person.username = in_teacher_username
                   WHERE course.code = in_course_code
                 ),
                 (SELECT grade_type.id
                    FROM grade_type
                    JOIN course_in_semester
                      ON course_in_semester.grade_system_name = grade_type.grade_system_name
                     AND course_in_semester.semester_code = in_semester_code
                     AND course_in_semester.course_code = in_course_code
                   WHERE grade_type.name = in_grade_type_name
                 )
                );

END