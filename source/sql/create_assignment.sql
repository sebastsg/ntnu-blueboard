CREATE PROCEDURE create_assignment (
    IN in_room_id          INT UNSIGNED,
    IN in_username         VARCHAR(32),
    IN in_title            VARCHAR(160),
    IN in_body             TEXT,
    IN in_started_at       DATETIME,
    IN in_ended_at         DATETIME,
    IN in_allow_groups     BOOLEAN,
    IN in_allow_individual BOOLEAN
)

BEGIN

    INSERT INTO assignment
                (id,
                 room_id,
                 participant_id,
                 title,
                 body,
                 started_at,
                 ended_at,
                 allow_groups,
                 allow_individual
                )
         VALUES (0,
                 in_room_id,
                 (SELECT participant.id
                    FROM person
                    JOIN participant
                      ON participant.person_id = person.id
                     AND participant.room_id = in_room_id
                   WHERE person.username = in_username
                 ),
                 in_title,
                 in_body,
                 in_started_at,
                 in_ended_at,
                 in_allow_groups,
                 in_allow_individual
                );

END