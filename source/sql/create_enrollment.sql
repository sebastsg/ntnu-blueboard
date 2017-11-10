CREATE PROCEDURE create_enrollment (
    IN in_username       VARCHAR(32),
    IN in_program_code   VARCHAR(32),
    IN in_student_number VARCHAR(32)
)

BEGIN

    INSERT INTO enrollment (id, person_id, program_id, student_number)
         VALUES (0,
                 (SELECT id
                    FROM person
                   WHERE username = in_username
                 ),
                 (SELECT id
                    FROM program
                   WHERE program_code = in_program_code
                 ),
                 in_student_number
                );
	
END
