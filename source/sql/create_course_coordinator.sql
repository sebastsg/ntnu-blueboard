CREATE PROCEDURE create_course_coordinator (
    IN in_course_code VARCHAR(16),
    IN in_username    VARCHAR(32)
)

BEGIN

    INSERT INTO course_coordinator (course_code, employment_id)
         VALUES (in_course_code,
                 (SELECT employment.id
                    FROM person
                    JOIN employment
                      ON employment.person_id = person.id
                    JOIN course
                      ON course.code = in_course_code
                     AND employment.department_code = course.department_code
                   WHERE person.username = in_username
                 )
                );

END