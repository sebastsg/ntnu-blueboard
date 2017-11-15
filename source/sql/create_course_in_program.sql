CREATE PROCEDURE create_course_in_program (
    IN in_program_code    VARCHAR(16),
    IN in_course_code     VARCHAR(16),
    IN in_is_mandatory    BOOLEAN
)

BEGIN

    INSERT INTO course_in_program (id, program_code, course_code, is_mandatory)
         VALUES (0, in_program_code, in_course_code, in_is_mandatory);

END