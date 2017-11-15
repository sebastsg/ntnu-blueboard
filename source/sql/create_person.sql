CREATE PROCEDURE create_person (
    IN in_username      VARCHAR(32),
    IN in_first_name    VARCHAR(128),
    IN in_last_name     VARCHAR(128),
    IN in_email         VARCHAR(128),
    IN in_password_hash VARCHAR(255)
)

BEGIN

    INSERT INTO person (id, username, first_name, last_name, email, password_hash)
         VALUES (0, in_username, in_first_name, in_last_name, in_email, in_password_hash);

END