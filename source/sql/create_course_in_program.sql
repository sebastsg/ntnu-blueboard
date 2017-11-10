CREATE PROCEDURE create_course_in_program (
    IN in_program_code    VARCHAR(32),
    IN in_course_code     VARCHAR(32),
    IN in_is_mandatory    BOOLEAN
)

BEGIN

    INSERT INTO course_in_program (id, program_id, course_id, is_mandatory)
         VALUES (0,
                 (SELECT id
                    FROM program
                   WHERE program_code = in_program_code
                 ),
                 (SELECT id
                    FROM course
                   WHERE course_code = in_course_code
                 ),
                 in_is_mandatory
                );

END