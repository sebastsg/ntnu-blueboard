CREATE PROCEDURE create_course (
    IN in_department_code       VARCHAR(16),
    IN in_course_code           VARCHAR(16),
    IN in_course_name           VARCHAR(128),
    IN in_description           TEXT,
    IN in_examination_type_code VARCHAR(16),
    IN in_credits               INT UNSIGNED,
    IN in_grade_system_name     VARCHAR(32)
)

BEGIN

    INSERT INTO course
                (code,
                 grade_system_name,
                 examination_type_code,
                 department_code,
                 name,
                 description,
                 credits
                )
         VALUES (in_course_code,
                 in_grade_system_name,
                 in_examination_type_code,
                 in_department_code,
                 in_course_name,
                 in_description,
                 in_credits
                );

END