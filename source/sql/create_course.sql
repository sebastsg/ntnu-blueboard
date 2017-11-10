CREATE PROCEDURE create_course (
    IN in_department_code  VARCHAR(32),
    IN in_course_code      VARCHAR(32),
    IN in_course_name      VARCHAR(128),
    IN in_description      TEXT,
    IN in_examination_code VARCHAR(32),
    IN in_credits          INT
)

BEGIN

    INSERT INTO course
                (id,
                 department_id,
                 course_code,
                 course_name,
                 description,
                 examination_type_id,
                 credits
                )
         VALUES (0,
                 (SELECT id
                    FROM department
                   WHERE department_code = in_department_code
                 ),
                 in_course_code,
                 in_course_name,
                 in_description,
                 (SELECT id
                    FROM examination_type
                   WHERE type_code = in_examination_code
                 ),
                 in_credits
                );

END