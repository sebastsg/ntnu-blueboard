CREATE PROCEDURE get_program (
    IN in_program_code VARCHAR(16)
)

BEGIN

    SELECT program.name             AS program_name,
           program.required_credits AS required_credits,
           department.code          AS department_code,
           department.name          AS department_name
	  FROM program
	  JOIN department
	    ON department.code = program.department_code
	 WHERE program.code = in_program_code;

END 
