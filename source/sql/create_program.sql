CREATE PROCEDURE create_program (
    IN in_department_code VARCHAR(32),
    IN in_program_code    VARCHAR(32),
    IN in_program_name    VARCHAR(128)
)

BEGIN

    INSERT INTO program (id, department_id, program_code, program_name)
         VALUES (0,
                 (SELECT id
                    FROM department
                   WHERE department_code = in_department_code
                 ),
                 in_program_code,
                 in_program_name
                );

END