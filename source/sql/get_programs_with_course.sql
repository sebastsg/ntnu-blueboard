CREATE PROCEDURE get_programs_with_course (
    IN in_course_code VARCHAR(16)
)

BEGIN

    SELECT program.code AS program_code,
           program.name AS program_name
      FROM program
      JOIN course_in_program
        ON course_in_program.program_code = program.code
      JOIN course
        ON course.code = course_in_program.course_code
       AND course.code = in_course_code;

END 
