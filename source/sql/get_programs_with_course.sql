CREATE PROCEDURE get_programs_with_course (
    IN in_course_code VARCHAR(32)
)

BEGIN

    SELECT program.program_code AS program_code,
           program.program_name AS program_name
      FROM program
      JOIN course_in_program
        ON course_in_program.program_id = program.id
      JOIN course
        ON course.id = course_in_program.course_id
       AND course.course_code = in_course_code;

END 
