CREATE PROCEDURE create_group (
    IN in_username   VARCHAR(32),
    IN in_room_id    INT UNSIGNED,
    IN in_role_name  VARCHAR(16),
    IN in_group_name VARCHAR(128)
)

BEGIN

    START TRANSACTION;

    INSERT INTO participant_group (id, name)
         VALUES (0, in_group_name);

    INSERT INTO participant_group_member (id, participant_group_id, participant_id)
         VALUES (0,
                 LAST_INSERT_ID(),
                 (SELECT participant.id
                    FROM person
                    JOIN participant
                      ON participant.person_id = person.id
                     AND participant.room_id = in_room_id
                     AND participant.role_name = in_role_name
                   WHERE person.username = in_username
                 )
                );

    COMMIT;

END
