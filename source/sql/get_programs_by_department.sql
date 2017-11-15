CREATE PROCEDURE get_programs_by_department (
    IN in_department_code VARCHAR(16)
)

BEGIN

    SELECT program.code AS program_code,
           program.name AS program_name
      FROM department
      JOIN program
        ON program.department_code = department.code
     WHERE department.code = in_department_code;

END 
