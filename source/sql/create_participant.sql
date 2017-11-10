CREATE PROCEDURE create_participant (
    IN in_username  VARCHAR(32),
    IN in_role_name VARCHAR(32),
    IN in_room_id   INT
)

BEGIN

    INSERT INTO participant (id, role_id, person_id, room_id)
         VALUES (0,
                 (SELECT id
                    FROM role
                   WHERE role_name = in_role_name
                 ),
                 (SELECT id
                    FROM person
                   WHERE username = in_username
                 ),
                 in_room_id
                );
	
END
