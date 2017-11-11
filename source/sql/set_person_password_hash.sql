CREATE PROCEDURE set_person_password_hash (
    IN in_username      VARCHAR(32),
    IN in_password_hash VARCHAR(255)
)

BEGIN

    UPDATE person
       SET password_hash = in_password_hash
     WHERE username = in_username;

END 
