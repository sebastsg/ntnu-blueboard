CREATE PROCEDURE get_courses_in_program (
    IN in_program_code VARCHAR(16)
)

BEGIN

    SELECT course.code                    AS course_code,
           course.name                    AS course_name,
           course.credits                 AS credits,
           course_in_program.is_mandatory AS is_mandatory
      FROM program
      JOIN course_in_program
        ON course_in_program.program_code = program.code
      JOIN course
        ON course.code = course_in_program.course_code
     WHERE program.code = in_program_code
     ORDER BY course_in_program.is_mandatory DESC;

END 
