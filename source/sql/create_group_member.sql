CREATE PROCEDURE create_group_member (
    IN in_username             VARCHAR(32),
    IN in_room_id              INT UNSIGNED,
    IN in_role_name            VARCHAR(16),
    IN in_participant_group_id INT UNSIGNED
)

BEGIN

    START TRANSACTION;

    INSERT INTO participant_group_member (id, participant_group_id, participant_id)
         VALUES (0,
                 in_participant_group_id,
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
