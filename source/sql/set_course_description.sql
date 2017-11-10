CREATE PROCEDURE set_course_description (
	IN in_course_code VARCHAR(32),
	IN in_description TEXT
)

BEGIN

    UPDATE course
       SET description = in_description
     WHERE course_code = in_course_code;

END 
