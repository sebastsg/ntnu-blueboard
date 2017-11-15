CREATE PROCEDURE set_course_description (
	IN in_course_code VARCHAR(16),
	IN in_description TEXT
)

BEGIN

    UPDATE course
       SET description = in_description
     WHERE code = in_course_code;

END 
