CREATE PROCEDURE create_participant (
    IN in_username  VARCHAR(32),
    IN in_role_name VARCHAR(32),
    IN in_room_id   INT UNSIGNED
)

BEGIN

    INSERT INTO participant (id, role_name, person_id, room_id)
         VALUES (0,
                 in_role_name,
                 (SELECT id
                    FROM person
                   WHERE username = in_username
                 ),
                 in_room_id
                );
	
END
