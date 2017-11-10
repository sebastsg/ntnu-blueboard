CREATE PROCEDURE create_faculty (
    IN in_faculty_code VARCHAR(32),
    IN in_faculty_name VARCHAR(128)
)

BEGIN

    INSERT INTO faculty (id, faculty_code, faculty_name)
         VALUES (0,
                 in_faculty_code,
                 in_faculty_name
                );

END