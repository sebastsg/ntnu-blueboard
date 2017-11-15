CREATE PROCEDURE create_course (
    IN in_department_code       VARCHAR(16),
    IN in_course_code           VARCHAR(16),
    IN in_course_name           VARCHAR(128),
    IN in_description           TEXT,
    IN in_examination_type_code VARCHAR(16),
    IN in_credits               INT UNSIGNED
)

BEGIN

    INSERT INTO course
                (code,
                 department_code,
                 name,
                 description,
                 examination_type_code,
                 credits
                )
         VALUES (in_course_code,
                 in_department_code,
                 in_course_name,
                 in_description,
                 in_examination_type_code,
                 in_credits
                );

END