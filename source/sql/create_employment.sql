CREATE PROCEDURE create_employment (
    IN in_username        VARCHAR(32),
    IN in_department_code VARCHAR(16)
)

BEGIN

    INSERT INTO employment (id, department_code, person_id)
         VALUES (0,
                 in_department_code,
                 (SELECT id
                    FROM person
                   WHERE username = in_username
                 )
                );
	
END
