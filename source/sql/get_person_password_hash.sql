CREATE PROCEDURE get_person_password_hash (
    IN in_username VARCHAR(32)
)

BEGIN

    SELECT password_hash
      FROM person
     WHERE username = in_username;

END 
