CREATE PROCEDURE create_employment (
    IN in_username        VARCHAR(64),
    IN in_department_code VARCHAR(64)
)

BEGIN

    INSERT INTO employment (id, department_id, person_id)
         VALUES (0,
                 (SELECT id
                    FROM department
                   WHERE department_code = in_department_code
                 ),
                 (SELECT id
                 	  FROM person
                   WHERE username = in_username
                 )
                );
	
END
