CREATE PROCEDURE create_invalid_course_combo (
    IN in_course_code_1 VARCHAR(16),
    IN in_course_code_2 VARCHAR(16)
)

BEGIN

    INSERT INTO invalid_course_combo (course_code_1, course_code_2)
         VALUES (in_course_code_1, in_course_code_2);

END