CREATE PROCEDURE create_course_coordinator (
    IN in_course_code VARCHAR(32),
    IN in_username    VARCHAR(32)
)

BEGIN

    DECLARE var_course_id INT UNSIGNED;

    SET var_course_id =
        (SELECT id
           FROM course
          WHERE course_code = in_course_code
        );

    INSERT INTO course_coordinator (course_id, employment_id)
         VALUES (var_course_id,
                 (SELECT employment.id
                    FROM person
                    JOIN employment
                      ON employment.person_id = person.id
                    JOIN course
                      ON course.id = var_course_id
                     AND employment.department_id = course.department_id
                   WHERE person.username = in_username
                 )
                );

END