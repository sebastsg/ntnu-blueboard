CREATE PROCEDURE create_enrollment_semester (
    IN in_username      VARCHAR(32),
    IN in_semester_code VARCHAR(32)
)

BEGIN

    INSERT INTO enrollment_semester (id, semester_code, enrollment_id)
         VALUES (0,
                 in_semester_code,
                 (SELECT enrollment.id
                    FROM enrollment
                    JOIN person
                      ON person.id = enrollment.person_id
                     AND person.username = in_username
                    JOIN semester
                      ON semester.program_code = enrollment.program_code
                     AND semester.code = in_semester_code
                 )
                );
	
END
