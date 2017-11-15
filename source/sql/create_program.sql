CREATE PROCEDURE create_program (
    IN in_department_code  VARCHAR(16),
    IN in_program_code     VARCHAR(16),
    IN in_program_name     VARCHAR(128),
    IN in_required_credits INT UNSIGNED
)

BEGIN

    INSERT INTO program (code, department_code, name, required_credits)
         VALUES (in_program_code,  in_department_code, in_program_name, in_required_credits);

END