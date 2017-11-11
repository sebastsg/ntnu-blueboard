CREATE PROCEDURE get_person (
    IN in_username VARCHAR(32)
)

BEGIN

    SELECT first_name,
           last_name,
           email
      FROM person
     WHERE username = in_username;

END 
