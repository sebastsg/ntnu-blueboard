CREATE PROCEDURE create_course_requirement (
    IN in_course_code          VARCHAR(16),
    IN in_requires_course_code VARCHAR(16)
)

BEGIN

    INSERT INTO course_requirement (course_code, requires_course_code)
         VALUES (in_course_code, in_requires_course_code);

END