CREATE PROCEDURE create_faculty (
    IN in_faculty_code VARCHAR(16),
    IN in_faculty_name VARCHAR(128)
)

BEGIN

    INSERT INTO faculty (code, name)
         VALUES (in_faculty_code, in_faculty_name);

END