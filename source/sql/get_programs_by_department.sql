CREATE PROCEDURE get_programs_by_department (
    IN in_department_code VARCHAR(32)
)

BEGIN

    SELECT program.program_code AS program_code,
           program.program_name AS program_name
      FROM department
      JOIN program
        ON program.department_id = department.id
     WHERE department.department_code = in_department_code;

END 
